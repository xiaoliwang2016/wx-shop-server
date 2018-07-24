<?php
namespace app\common\service;
use app\common\model\Goods;

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
	public function placeOrder($uid, $o_goods) {
		$this->uid = $uid;
		$this->o_goods = $o_goods;
		$this->goods = $this->getGoodsByOrder($o_goods);
		$status = $this->getOrderStatus();
		return $status;
	}

	//根据商品id数组 查找具体商品集合
	private function getGoodsByOrder($o_goods) {
		$goods_ids = [];
		foreach ($o_goods as $o_goods_item) {
			array_push($goods_ids, $o_goods_item['goods_id']);
		}
		return Goods::all($goods_ids)->visible(['id', 'name', 'stock', 'price'])->toArray();
	}
	//检测整个订单下所有项是否合法
	private function getOrderStatus() {
		$status = [
			'pass' => true,
			'amount' => 0,
			'itemInfo' => [],
		];
		foreach ($this->o_goods as $o_goods_item) {
			$singleGoogsStat = $this->checkSingleGoods($o_goods_item, $this->goods);
			if (!$singleGoogsStat['haveStock']) {
				$status['pass'] = false;
			}
			$status['amount'] += $singleGoogsStat['total'];
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
		$status['count'] = $o_goods_item['quantity'];
		$status['total'] = $o_goods_item['quantity'] * $goodsItem['price'];
		if ($goodsItem['stock'] - $o_goods_item['quantity'] < 0) {
			$status['haveStock'] = false;
		}
		return $status;
	}

}