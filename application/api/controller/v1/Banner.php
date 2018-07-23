<?php
namespace app\api\controller\v1;
use app\common\model\Banner as Model;
use think\Controller;
use think\Validate;

class Banner extends Controller {

	/**
	 * 根据 bannery_type获取轮播图列表
	 * @return [json]
	 */
	public function getBanner() {
		$banner_type = $this->request->param('id');
		$validate = Validate::make([
			'id' => 'require|integer',
		]);
		if ($validate->check(['id' => $banner_type])) {
			if(!cache('banner_'.$banner_type)){
				$list = Model::where('banner_type', $banner_type)->limit(5)->select()->toArray();
				cache('banner_'.$banner_type,$list)
			}
			return ReturnMsg('1001', cache('banner_'.$banner_type));
		}
	}

}