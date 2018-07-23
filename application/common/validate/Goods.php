<?php
namespace app\common\validate;

class Goods extends BaseValidate {

	protected $rule = [
		'name' => 'require|length:1,32',
		'price' => 'float',
		'stock' => 'integer|between:0,9999',
		'category_id' => 'require|integer',
		'img' => 'require|url',
		'property_name' => 'length:0,255',
		'property_value' => 'length:0,255',
	];
}