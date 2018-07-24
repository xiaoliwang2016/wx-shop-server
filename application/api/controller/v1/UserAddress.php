<?php

namespace app\api\controller\v1;

use app\common\model\UserAddress as AddressModel;
use app\common\service\Token;
use app\common\validate\Address as AddressValidate;
use think\Controller;
use think\Request;

class UserAddress extends Controller {

	/**
	 * add new address
	 */
	public function addNewAddr() {
		(new AddressValidate())->goCheck();
		$indentity = Token::getCurrentIdentity();
		if (!$indentity['uid']) {
			throw new Exception("获取用户ID错误");
		}
		return (new AddressModel())->addAddr($indentity['uid']);
	}
	/**
	 * edit address information
	 */
	public function editAddr() {
		(new AddressValidate())->goCheck();
		$indentity = Token::getCurrentIdentity();
		$result = AddressModel::where([
			'uid' => $indentity['uid'],
			'id' => $this->request->post('id'),
		])->find()->toArray();
		if (empty($result)) {
			throw new \app\common\exception\BaseException(['msg' => '用户不存在，或者用户与记录不符合']);
		}
		return (new AddressModel())->edit();
	}
	/**
	 * delete addr info
	 */
	public function deleteAddr() {
		if (!$id = $this->request->param('id')) {
			throw new \app\common\exception\BaseException(['errorCode' => '10000', 'msg' => '参数错误']);
		}
		AddressModel::destroy($id);
		return ReturnMsg('1001');
	}

}
