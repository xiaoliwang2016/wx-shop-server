<?php
namespace app\api\controller\v1;
use think\Controller;
use \app\common\model\Goods as GoodsModel;

class Goods extends Controller{
	/**
	 * get newest goods module in home page
	 */
	public function getGoodsByDate(){
		if(!cache('newest_goods')){
			$list = GoodsModel::where(true)->limit(5)->order('update_time','desc')->column('id,name,img');
			cache('newest_goods',$list);
		}
		return ReturnMsg('1001', cache('newest_goods'));
	}
	/**
	 * get one goods by id
	 */
	public function getDetailById(){
		$id = $this->request->param('goods_id');
		if(!is_numeric($id) || $id < 1){
			throw new \app\common\exception\BaseException(['errorCode'=>'10000','code'=>'400','msg'=>'参数错误']);
		}
		$data = GoodsModel::where('id',$id)->find()->toArray();
		return ReturnMsg('1001', $data);
	}

	
}