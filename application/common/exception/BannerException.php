<?php

namespace app\common\exception;

class BannerException extends BaseException {
	public $code = 400;
	public $msg = 'Banner不存在';
	public $errorCode = 40000;
}