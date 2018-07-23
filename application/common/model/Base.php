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
	//允许修改字段
	protected $editAllowField = [];

	//新增一条数据
	public function add() {
		$data = Request::only($this->addAllowField);
		if($this->save($data)){
			return ReturnMsg('1001');
		}
		throw new \app\common\exception\BaseException(['errorCode'=>'999','code'=>'400','msg'=>'数据库添加失败']);
	}

	public function delete(){
		$id = Request::param($this->pk);
		if($id && is_numeric($id) && $id > 0){
			$this->where($this->pk,$id)->delete();
			return ReturnMsg('1001');
		}
		throw new \app\common\exception\BaseException(['errorCode'=>'10000','code'=>'400','msg'=>'参数错误']);
	}

	public function edit(){
		$data = Request::only($this->editAllowField);
		if($this->save($data,[$this->pk => $data[$this->pk]]) === false){
			throw new \app\common\exception\BaseException(['errorCode'=>'999','code'=>'400','msg'=>'更新失败']);
		}
		return ReturnMsg('1001');
	}
}