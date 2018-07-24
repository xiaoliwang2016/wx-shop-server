<?php
namespace app\admin\controller;

use \app\common\model\Banner as Model;

class Banner extends Base {
	function list() {
		$list = Model::where(true)->order('banner_type')->select()->toArray();
		return ReturnMsg('1001', $list);
	}
	/**
	 * add new banner to particular postion (banner_type)
	 */
	public function add() {
		$validate = new \app\common\validate\Banner();
		$model = new Model();
		$result = $validate->goCheck();
		if ($result === true) {
			cache('banner_' . $this->request->param('banner_type'), null);
			return $model->add();
		}
		return ReturnMsg('1004', null, $result);
	}
	/**
	 * delete one banner
	 */
	public function delete() {
		$model = new Model();
		$banner_type = $model->where('id', $this->request->param('id'))->find();
		cache('banner_' . $banner_type['banner_type'], null);
		return $model->delete();
	}

	public function upload() {
		return UploadImg('./uploads/images/banner');
	}

}
