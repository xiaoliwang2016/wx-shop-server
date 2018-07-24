<?php
namespace app\common\validate;

class Admin extends BaseValidate {

	protected $rule = [
		'name' => 'require',
		'passwd' => 'require',
	];
}