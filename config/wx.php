<?php

return [
	//  +---------------------------------
	//  微信相关配置
	//  +---------------------------------

	// 小程序app_id
	'app_id' => 'wx0a1d95f443204af2',
	// 小程序app_secret
	'app_secret' => '26abed478ed6f563eba1433ccde5aec3',

	// 微信使用code换取用户openid及session_key的url地址
	'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
	"appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

	// 微信获取access_token的url地址
	'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
	"grant_type=client_credential&appid=%s&secret=%s",

	//支付状态
	'unpaid' => 1,
	'paid' => 2,
	'shipped' => 3,

];