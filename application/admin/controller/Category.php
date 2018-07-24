<?php
namespace app\admin\controller;
use \app\common\model\Category as CategoryModel;

class Category extends Base {
	/**
	 * add new category
	 */
	public function add() {
		$validate = new \app\common\validate\Category();
		$model = new CategoryModel();
		$result = $validate->goCheck();
		if ($result === true) {
			cache('categorys', null);
			$model->add();
		}
		return ReturnMsg('1004', null, $result);
	}
	/**
	 * delete new category
	 */
	public function delete() {
		if (0 != db('goods')->where('category_id', $this->request->param('id'))->count()) {
			throw new \app\common\exception\BaseException(['errorCode' => '10003', 'code' => '400', 'msg' => '该类下尚有商品存在，请先删除商品']);
		}
		cache('categorys', null);
		$model = new CategoryModel();
		return $model->delete();
	}

	public function upload() {
		return UploadImg('./uploads/images/category');
	}
}