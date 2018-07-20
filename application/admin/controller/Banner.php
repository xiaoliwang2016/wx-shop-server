<?php
namespace app\admin\controller;
use think\Controller;
use \app\common\model\Banner as Model;

class Banner extends Controller {

	public function list() {
		$list = Model::where(true)->paginate(100, true);
		return ReturnMsg('1001', $list);
	}

	public function add() {
		$validate = new \app\common\validate\Banner();
		$model = new Model();
		$result = $validate->goCheck();
		if ($result === true) {
			if ($model->add()) {
				return ReturnMsg('1001');
			}
			return ReturnMsg('1004');
		}
		return ReturnMsg('1004', null, $result);
	}

	public function delete() {
		if (Model::destroy($this->request->param('id'))) {
			return ReturnMsg('1001');
		}
	}

	public function upload() {
		$file = request()->file('image');
		$info = $file->validate(['size' => 1024 * 1024, 'ext' => 'jpg,png,gif'])->move('./uploads/images/banner');
		if ($info) {
			$fullPath = $_SERVER['SERVER_NAME'] . '/wx_shop/public/uploads/images/banner/' . $info->getSaveName();
			return ReturnMsg('1001', $fullPath);
		} else {
			return ReturnMsg('1004');
		}
	}

}