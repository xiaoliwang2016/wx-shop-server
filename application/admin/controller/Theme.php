<?php
namespace app\admin\controller;
use think\Controller;
use \app\common\model\Theme as ThemeModel;

class Theme extends Controller{
	/**
	 * modify the particular theme 
	 * @return [type]
	 */
	public function modifyTheme(){
		$validate = new \app\common\validate\Theme;
		$model = new ThemeModel();
		$result = $validate -> goCheck();
		if($result === true){
			return $model -> edit();
		}
	}
	/**
	 * upload theme image 
	 * @return [type] [description]
	 */
	public function upload() {
		return UploadImg('./uploads/images/theme');
	}
}