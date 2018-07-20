<?php
namespace app\common\model;
use think\facade\Request;
use think\Model;
use think\model\concern\SoftDelete;

class Base extends Model {
	use SoftDelete;
	protected $pk = 'id';
	//自动时间戳
	protected $autoWriteTimestamp = true;
	//软删除
	protected $deleteTime = 'delete_time';
	//添加时允许字段
	protected $addAllowField = [];

	//新增一条数据
	public function add() {
		$data = Request::only($this->addAllowField);
		return $this->save($data);
	}
}