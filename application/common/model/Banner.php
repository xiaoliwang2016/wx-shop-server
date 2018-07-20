<?php
namespace app\common\model;

class Banner extends Base {
	//添加时允许字段
	protected $addAllowField = ['banner_type', 'type', 'type_id', 'img'];
}