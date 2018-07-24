<?php
namespace app\common\service;
use think\Facade\Request;

class Token {
	/**
	 * generate the token according to random string
	 */
	public function generateToken() {
		$randChar = getRandChar(32);
		$timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
		return md5($randChar . $timestamp);
	}
	/**
	 * get current indentity according token client pass
	 */
	public static function getCurrentIdentity() {
		$token = Request::header('token');
		if (!$token) {
			throw new \app\common\exception\BaseException(['msg' => '请先登录']);
		}
		$identity = cache($token);
		if ($identity) {
			return $identity;
		} else {
			throw new \app\common\exception\BaseException(['msg' => '身份已过期，请重新登录']);
		}
	}

	public static function getCurrentTokenVar($var) {
		$indentity = self::getCurrentIdentity();
		if (!$indentity[$var]) {
			throw new Exception(['msg' => '尝试获取的Token变量并不存在']);
		} else {
			return $indentity[$var];
		}
	}

}
