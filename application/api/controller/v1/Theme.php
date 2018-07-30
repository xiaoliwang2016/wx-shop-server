<?php
namespace app\api\controller\v1;
use think\Controller;
use \app\common\model\Theme as ThemeModel;

class Theme extends Controller{
	/**
	 * get all themes ( Home page )
	 * @return [array]
	 */
	public function getTheme(){
		if(!cache('themes')){
			$themes = ThemeModel::where(true)->field('id,name,img')->select()->toArray();
			cache('themes',$themes);
		}
		return ReturnMsg('1001',cache('themes'));
	}

	/**
	 * get particular theme by theme id (theme page)
	 * @return [array] 
	 */
	public function getThemeById(){
		$theme_id = $this->request->param('theme_id');
		if(!is_numeric($theme_id)){
			throw new \app\common\exception\BaseException(['errorCode'=>'10000','code'=>'400','msg'=>'参数错误']);
		}
		if(!cache('theme_'.$theme_id)){
			$list = ThemeModel::where('id',$theme_id)->field('id,img,name,head_img')->find()->toArray();
			$theme_goods = db('theme_goods')->where('theme_id',$theme_id)->select();
			$list['goods'] = db('goods')->where('id','in',Array2Array($theme_goods,'goods_id'))->field('id,name,img,price')->select();
			cache('theme_'.$theme_id,$list);
		}
		return ReturnMsg('1001',cache('theme_'.$theme_id));
	}

}