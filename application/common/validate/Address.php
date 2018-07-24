<?php
namespace app\common\validate;

class Address extends BaseValidate {

	protected $rule = [
		'name' => 'require|length:1,15',
		'mobile' => 'require|mobile',
		'province' => 'require|length:1,15',
		'city' => 'require|length:1,15',
		'country' => 'require|length:1,15',
		'detail' => 'require|length:1,127',
	];

}