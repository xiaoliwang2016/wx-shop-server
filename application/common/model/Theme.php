<?php
namespace app\common\model;
use think\facade\Request;

class Theme extends Base {
	//the field that allow be insert
	protected $editAllowField = ['head_img', 'img','id'];
	//the field that be hidden when output
	protected $hidden = ['delete_time'];
	//add related model
	public function goods(){
		return $this->belongsToMany('Goods','theme_goods','goods_id','theme_id');
	}

	public function edit(){
		$theme_id = Request::param('id');
		cache('theme_'.$theme_id,null);
		$goods_ids = explode(',', Request::param('goods_ids'));
		$theme_goods = [];
		foreach ($goods_ids as $key => $goods_id) {
			$theme_goods[$key]['theme_id'] = $theme_id;
			$theme_goods[$key]['goods_id'] = $goods_id;
		}
		db('theme_goods')->where('theme_id',$theme_id)->delete();
		if(db('theme_goods')->insertAll($theme_goods) === false){
			throw new \app\common\exception\BaseException(['errorCode'=>'999','code'=>'400','msg'=>'插入数据失败']);		
		}
		return parent::edit();
	}
}