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

function UploadImg($path){
	$file = request()->file('image');
	$info = $file->validate(['size' => 1024 * 1024, 'ext' => 'jpg,png,gif'])->move($path);
	if ($info) {
		$fullPath = 'http://' . $_SERVER['SERVER_NAME'] . substr($path, 1) .'/'. $info->getSaveName();
		return ReturnMsg('1001', $fullPath);
	} else {
		return ReturnMsg('1004');
	}
}
//把二维数组中某一项提取出来 组成一个新的数组
function Array2Array($arr,$field){
	$newArr = [];
	foreach ($arr as $item) {
		$newArr[] = $item[$field];
	}
	return $newArr;
}