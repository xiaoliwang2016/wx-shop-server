<?php

namespace app\common\model;

class User extends Base {

	protected $hidden = ['openid', 'delete_time', 'create_time', 'update_time'];

	public function address() {
		return $this->hasMany('UserAddress', 'uid', 'id');
	}

}
