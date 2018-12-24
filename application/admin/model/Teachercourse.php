<?php
namespace app\admin\model;
/**
* 课程模型层
*/
class Teachercourse extends \think\Model
{
	protected $resultSetType = 'collection';
	public function classes()
	/*课程与班级的多对多关联模型*/
	{
		return $this->belongsToMany('Classes','teachercourse_classes');
	}

	public function teacher()
	/*教师课程与教师的一对多关系*/
	{
		return $this->belongsTo('Teacher');
	}

	public function course()
	/*教师课程与课程的一对多关系*/
	{
		return $this->belongsTo('Course');
	}
}
?>