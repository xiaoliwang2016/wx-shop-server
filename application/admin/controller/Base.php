<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller {
	public function __construct() {
		if (!session('?admin')) {
			throw new \app\common\exception\BaseException(['msg' => '请使用管理员登录后再操作']);
		}
	}
}
