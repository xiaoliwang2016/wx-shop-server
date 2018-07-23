<?php

namespace app\api\controller\v1;

use app\common\validate\Token as TokenValidate;
use app\common\service\UserToken;
use think\Controller;
use think\Request;

class Token extends Controller {
    /**
     * 1. get openid according code that client passed
     * 2. search openid in database , if not exist , create new user
     * 3. generate token , and related the token with openid , and cache in local
     * 4. return taoken
     */
	public function getToken() {
		$code = $this->request->param('code');
		(new TokenValidate())->getToken($code);
		$ut = new UserToken($code);
		return json([
            'token' => $ut->get();
        ]);
	}

    public function 

}
