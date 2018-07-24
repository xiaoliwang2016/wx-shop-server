<?php

namespace app\common\model;
use think\facade\Request;

class UserAddress extends Base {
	protected $table = 'user_address';

	//the field that allow be insert
	protected $addAllowField = ['name', 'mobile', 'province', 'city', 'country', 'detail'];
	protected $editAllowField = ['id', 'name', 'mobile', 'province', 'city', 'country', 'detail'];
	protected $hidden = ['user_id', 'delete_time', 'update_time'];

	public function addAddr($uid) {
		$data = Request::only($this->addAllowField);
		$data['uid'] = $uid;
		if ($this->save($data)) {
			return ReturnMsg('1001');
		}
		throw new \app\common\exception\BaseException(['errorCode' => '999', 'code' => '400', 'msg' => '添加失败']);
	}

}
