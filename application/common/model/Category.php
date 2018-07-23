<?php
namespace app\common\model;

class Category extends Base {
	//the field that allow be insert
	protected $addAllowField = ['name', 'img', 'description'];
	//the field that be hidden when output
	protected $hidden = ['update_time','delete_time'];
	//add related model
	public function goods(){
		return $this->hasMany('Goods','category_id','id');
	}

}