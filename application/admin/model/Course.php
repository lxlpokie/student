<?php
namespace app\admin\model;
/**
* 课程模型层
*/
class Course extends \think\Model
{
	protected $resultSetType = 'collection';
	public function college()
	/*课程与学院的的多对一关系*/
	{
		return $this->belongsTo('College');
	}

	public function teacher()
	/*课程与教师的多对多关联模型*/
	{
		return $this->belongsToMany('Teacher','teachercourse')->using('Teacherourse');
	}

	public function classes()
	/*课程与班级的多对多关联模型*/
	{
		return $this->belongsToMany('Classes','classes_course');
	}

	public function teachercourse()
	/*课程与教师课程的多对一关系*/
	{
		return $this->hasMany('Teachercourse');
	}

	public function score()
	/*课程和成绩的一对多关系*/
	{
		return $this->hasMany('Score');
	}
}
?>