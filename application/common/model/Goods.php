<?php
namespace app\common\model;

class Goods extends Base {
	//the field that allow be insert
	protected $addAllowField = ['name', 'img', 'price','stock','category_id','summary','property_name','property_value'];
	//the field that be hidden when output
	protected $hidden = ['delete_time','category_id'];
}