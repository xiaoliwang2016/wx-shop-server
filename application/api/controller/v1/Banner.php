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
			$list = Model::where('banner_type', $banner_type)->limit(5)->select()->toArray();
			if (empty($list)) {
				throw new \app\common\exception\BannerException();
			}
			return ReturnMsg('1001', $list);
		}
	}

}