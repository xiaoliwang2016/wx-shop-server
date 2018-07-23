<?php
namespace app\common\validate;

class Theme extends BaseValidate {

	protected $rule = [
		'id' => 'require|integer',
		'img' => 'require|url',
		'head_img' => 'require|url',
		'goods_ids' => 'require'
	];
}