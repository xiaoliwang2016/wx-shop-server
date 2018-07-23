<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function ReturnMsg($code, $data = null, $msg = '') {
	if ($msg) {
		return json(array('code' => $code, 'msg' => $msg, 'data' => $data));
	}
	return json(array('code' => $code, 'msg' => config("msg.{$code}"), 'data' => $data));
}

function UploadImg($path) {
	$file = request()->file('image');
	$info = $file->validate(['size' => 1024 * 1024, 'ext' => 'jpg,png,gif'])->move($path);
	if ($info) {
		$fullPath = 'http://' . $_SERVER['SERVER_NAME'] . substr($path, 1) . '/' . $info->getSaveName();
		return ReturnMsg('1001', $fullPath);
	} else {
		return ReturnMsg('1004');
	}
}
//把二维数组中某一项提取出来 组成一个新的数组
function Array2Array($arr, $field) {
	$newArr = [];
	foreach ($arr as $item) {
		$newArr[] = $item[$field];
	}
	return $newArr;
}

/**
 * @param string $url post请求地址
 * @param array $params
 * @return mixed
 */
function curl_post($url, array $params = array()) {
	$data_string = json_encode($params);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt(
		$ch, CURLOPT_HTTPHEADER,
		array(
			'Content-Type: application/json',
		)
	);
	$data = curl_exec($ch);
	curl_close($ch);
	return ($data);
}

function curl_post_raw($url, $rawData) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
	curl_setopt(
		$ch, CURLOPT_HTTPHEADER,
		array(
			'Content-Type: text',
		)
	);
	$data = curl_exec($ch);
	curl_close($ch);
	return ($data);
}

/**
 * @param string $url get请求地址
 * @param int $httpCode 返回状态码
 * @return mixed
 */
function curl_get($url, &$httpCode = 0) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	//不做证书校验,部署在linux环境下请改为true
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	$file_contents = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	return $file_contents;
}

function getRandChar($length) {
	$str = null;
	$strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
	$max = strlen($strPol) - 1;

	for ($i = 0;
		$i < $length;
		$i++) {
		$str .= $strPol[rand(0, $max)];
	}

	return $str;
}