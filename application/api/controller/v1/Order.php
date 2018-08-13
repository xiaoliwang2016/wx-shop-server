<?php

namespace app\api\controller\v1;

use app\common\service\Order as OrderService;
use app\common\service\Token;
use think\Controller;

class Order extends Controller {

	public function place() {
		$identity = Token::getCurrentIdentity();
		$orderInfo = $this->request->param('list');
		$address_id = $this->request->param('address_id');
		$status = (new OrderService())->placeOrder($identity['uid'], $orderInfo, $address_id);
		return json($status);
	}

}
