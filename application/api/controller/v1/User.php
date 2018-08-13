<?php

namespace app\api\controller\v1;

use app\common\model\User as UserModel;
use app\common\service\Token;
use think\Controller;

class User extends Controller {
	/**
	 * get user info
	 */
	public function getUserInfo() {
		$indentity = Token::getCurrentIdentity();
		if (!$indentity['uid']) {
			throw new Exception("获取用户ID错误");
		}
		return UserModel::with('address')->where('id', $indentity['uid'])->find();
	}
}
