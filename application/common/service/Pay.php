<?php
namespace app\common\service;

class Pay
{
/**
 * 1.客户发起请求，传入订单号
 * 2.根据订单号从数据库中找到订单对应下所有商品，对商品库存量进行检测
 * 3.创建微信支付订单
 * 4.发送支付订单到微信服务器，获得 prepay_id
 * 5.生成小程序拉起支付的 5个参数 及签名 并返回给小程序
 * 6.小程序根据服务端返回的参数进行支付
 * 7.微信将支付结果返回给小程序和服务端
 */
    protected $order_id;
    protected $order_no;

    public function __construct($orderId)
    {
        if (!(is_numeric($orderId) && $orderId > 0)) {
        	throw new \app\common\exception\BaseException("msg"=>"非法ID");
        }	
        $this->order_id = $orderId;
    }

    public function pay(){
    	
    }
}
