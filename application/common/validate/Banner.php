<?php
namespace app\common\validate;

class Banner extends BaseValidate {
	// 为防止欺骗重写user_id外键
	// rule中严禁使用user_id
	// 获取post参数时过滤掉user_id
	// 所有数据库和user关联的外键统一使用user_id，而不要使用uid
	protected $rule = [
		'banner_type' => 'require|integer',
		'type' => 'require|integer',
		'type_id' => 'require|integer',
		'img' => 'require',
	];
}