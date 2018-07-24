<?php
namespace app\admin\controller;
use \app\common\model\Goods as GoodsModel;

class Goods extends Base {
	/**
	 * add new data for goods table
	 */
	public function add() {
		$goodsValidate = new \app\common\validate\Goods();
		$model = new GoodsModel();
		$result = $goodsValidate->goCheck();
		if ($result !== true) {
			return ReturnMsg('1004', null, $result);
		}
		//clear cache in this category goods data
		cache('category_' . $this->request->param('category_id'), null);
		cache('newest_goods', null);
		return $model->add();
	}
	/**
	 * delete data from goods table
	 */
	public function delete() {
		$model = new GoodsModel();
		$category_id = $model->where('id', $this->request->param('id'))->field('category_id')->find()->toArray();
		cache('category_' . $category_id['category_id'], null);
		cache('newest_goods', null);
		return $model->delete();
	}

	public function upload() {
		return UploadImg('./uploads/images/goods');
	}
}