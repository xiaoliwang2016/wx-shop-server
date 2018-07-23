<?php
namespace app\common\validate;

class Banner extends BaseValidate {

	protected $rule = [
		'banner_type' => 'require|integer',
		'type' => 'require|integer',
		'type_id' => 'require|integer',
		'img' => 'require',
	];
}