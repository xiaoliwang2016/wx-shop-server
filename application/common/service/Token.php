<?php
namespace app\common\service;

class Token {
	/**
	 * generate the token according to random string
	 */
	public function generateToken() {
		$randChar = getRandChar(32);
		$timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
		return md5($randChar . $timestamp);
	}
}
