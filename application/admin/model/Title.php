<?php
namespace app\admin\model;
/**
* 职称模型层
*/
class Title extends \think\Model
{
	protected $resultSetType = 'collection';
	public function teacher()
	/*职称与教师的一对多关系*/
	{
		return $this->hasMany('Teacher');
	}
}
?>