<?php
namespace app\common\validate;

class Category extends BaseValidate {

	protected $rule = [
		'name' => 'require|length:1,32',
		'img' => 'require|url'
	];
}