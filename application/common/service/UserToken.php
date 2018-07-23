<?php
namespace app\common\service;
use app\common\model\User;

class UserToken extends Token {
	protected $code;
	protected $Appid;
	protected $AppSecret;
	protected $LoginUrl;

	public function __construct($code) {
		$this->code = $code;
		$this->Appid = config('wx.app_id');
		$this->AppSecret = config('wx.app_secret');
		$this->LoginUrl = sprintf(config('wx.login_url'), $this->Appid, $this->AppSecret, $this->code);
	}
	/**
	 * get openid according to code , and generate token pass to client
	 */
	public function get() {
		$result = curl_get($this->LoginUrl);
		$wxResult = json_decode($result, true);
		if (empty($wxResult)) {
			throw new Exception("获取session_key和open_id失败，微信内部错误");
		}
		//验证获取令牌是否成功
		if (array_key_exists('errcode', $wxResult)) {
			throw new \app\common\exception\BaseException([
				'errorCode' => $wxResult['errcode'],
				'msg' => $wxResult['errmsg'],
			]);
		} else {
			return $this->grantToken($wxResult['openid']);
		}
	}
	/**
	 * grand the token and cache to local
	 */
	private function grantToken($openid) {
		//查找User表，查看该openid对应用户是否存在，如是则返回uid，否则生成新用户，返回uid
		$user = User::where('openid', $openid)->find();
		if (!$user) {
			$uid = User::create([
				'openid' => $openid,
			]);
		} else {
			$uid = $user->id;
		}
		//存入缓存 key：生成返回客户端的令牌 value：openid
		$key = $this->generateToken();
		$expire = config('token.expire');
		if (!cache($key, $openid, $expire)) {
			throw new Exception("缓存客户令牌时出现错误");
		} else {
			return $key;
		}
	}

}
