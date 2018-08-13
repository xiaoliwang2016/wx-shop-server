<?php
namespace app\common\service;

use app\common\model\Goods;
use app\common\model\Order as OrderModel;
use app\common\model\UserAddress;
use think\Db;

class Order {
//用户下单流程：
	//1. 用户访问下单API 传递参数 商品id：goods_id  下单数量：count
	//2. 服务器检测订单（库存检测，商品合法性检测）
	//3. 检测通过后返回给用户下单成功提示 （此时订单进入未支付状态）
	//4. 用户调用支付接口
	//5. 服务器在支付接口中再次检测订单，通过检测后调用微信支付接口
	//6. 用户支付后将结果传递到服务器，服务器作出相应操作

	//根据用户传递商品ID 从数据库中查询出真实商品，包含详细信息 array
	protected $goods;
	//用户传递的参数，保存用户下单商品的id 和 数量 array
	protected $o_goods;
	//下单用户的id
	protected $uid;

	//下单
	public function placeOrder($uid, $o_goods, $address_id) {
		$this->uid = $uid;
		$this->o_goods = $o_goods;
		$this->goods = $this->getGoodsByOrder($o_goods);
		//检测订单是否合法
		$status = $this->getOrderStatus();
		if ($status['pass'] == false) {
			//保持返回数据一致性
			$status['order_id'] = -1;
			return $status;
		}
		//生成快照信息
		$orderSnap = $this->snapOrder($status, $address_id);

		//创建订单
		return $this->createOrder($orderSnap);
	}

	//根据商品id数组 查找具体商品集合
	private function getGoodsByOrder($o_goods) {
		$goods_ids = [];
		foreach ($o_goods as $o_goods_item) {
			array_push($goods_ids, $o_goods_item['goods_id']);
		}
		return Goods::all($goods_ids)->visible(['id', 'name', 'img', 'stock', 'price'])->toArray();
	}
	//检测整个订单下所有项是否合法
	private function getOrderStatus() {
		$status = [
			'pass' => true,
			'amount' => 0,
			'count' => 0,
			'itemInfo' => [],
		];
		foreach ($this->o_goods as $o_goods_item) {
			$singleGoogsStat = $this->checkSingleGoods($o_goods_item, $this->goods);
			if (!$singleGoogsStat['haveStock']) {
				$status['pass'] = false;
			}
			$status['amount'] += $singleGoogsStat['total'];
			$status['count'] += $singleGoogsStat['count'];
			array_push($status['itemInfo'], $singleGoogsStat);
		}
		return $status;
	}
	//检测订单下单项是否合法
	private function checkSingleGoods($o_goods_item, $goods) {
		$status = [
			'id' => null,
			'haveStock' => true,
			'count' => 0,
			'name' => null,
			'img' => '',
			'total' => 0,
		];
		$index = -1;
		for ($i = 0; $i < count($goods); $i++) {
			if ($goods[$i]['id'] == $o_goods_item['goods_id']) {
				$index = $i;
			}
		}
		if ($index == -1) {
			throw new \app\common\exception\BaseException(['msg' => "商品不存在"]);
		}
		$goodsItem = $goods[$index];
		$status['id'] = $goodsItem['id'];
		$status['name'] = $goodsItem['name'];
		$status['img'] = $goodsItem['img'];
		$status['count'] = $o_goods_item['quantity'];
		$status['total'] = $o_goods_item['quantity'] * $goodsItem['price'];
		if ($goodsItem['stock'] - $o_goods_item['quantity'] < 0) {
			$status['haveStock'] = false;
		}
		return $status;
	}
	//生成订单快照
	private function snapOrder($status, $address_id) {
		$snap = [
			'total_count' => 0,
			'total_price' => 0,
			'snap_img' => '',
			'snap_name' => '',
			'snap_address' => null,
			'snap_goods' => null,
		];

		$snap['total_count'] = $status['count'];
		$snap['total_price'] = $status['amount'];
		$snap['snap_img'] = $status['itemInfo'][0]['img'];
		$snap['snap_name'] = $status['itemInfo'][0]['name'];
		$snap['snap_goods'] = json_encode($status['itemInfo']);
		$snap['snap_address'] = json_encode(UserAddress::where('id', $address_id)->find()->toArray());

		return $snap;
	}
	//生成订单号
	public static function makeOrderNo() {
		$yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
		$orderSn =
		$yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date(
			'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
			'%02d', rand(0, 99));
		return $orderSn;
	}
	//创建订单
	private function createOrder($snap) {
		//补充快照信息
		$snap['order_no'] = self::makeOrderNo();
		$snap['uid'] = $this->uid;
		$snap['status'] = config('wx.unpaid');
		try {
			//创建订单
			$order = OrderModel::create($snap);
			$goods_info = json_decode($snap['snap_goods']);
			//同时把数据保存到 商品-订单 表
			$data = [];
			foreach ($goods_info as $goods) {
				array_push($data, [
					'order_id' => $order->id,
					'goods_id' => $goods->id,
					'count' => $goods->count,
				]);
			}
			Db::name('order_goods')->insertAll($data);

			return [
				'order_id' => $order->id,
				'order_no' => $snap['order_no'],
				'create_time' => $order->create_time,
			];
		} catch (Exception $e) {
			throw $e;
		}
	}

}
