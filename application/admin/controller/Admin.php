<?php

namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Admin extends Controller {
	public function login() {
		(new \app\common\validate\Admin())->goCheck();
		$admin = Db::table('admin')->where('name', $this->request->post('name'))->find();
		if (empty($admin)) {
			throw new \app\common\exception\BaseException(['msg' => '管理员账号错误']);
		}
		if ($admin['passwd'] !== $this->request->post('passwd')) {
			throw new \app\common\exception\BaseException(['msg' => '管理员密码错误']);
		}
		session('admin', $admin);
		return ReturnMsg('1001', null, '登录成功');
	}

	public function logout() {
		session('admin', null);
		return ReturnMsg('1001', null, '退出登录成功');
	}
}
