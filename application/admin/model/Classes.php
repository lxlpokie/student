<?php
namespace app\admin\model;
/**
* 班级模型层
*/
class Classes extends \think\Model
{
	protected $resultSetType = 'collection';
	public function department()
	/*班级与系的多对一关系*/
	{
		return $this->belongsTo('Department');
	}

	public function course()
	/*课程与班级的多对多关联模型*/
	{
		return $this->belongsToMany('Course','classes_course');
	}

	public function teachercourse()
	/*课程与班级的多对多关联模型*/
	{
		return $this->belongsToMany('Teachercourse','teachercourse_classes');
	}

	public function student()
	/*班级与学生之间的一对多关系*/
	{
		return $this->hasMany('Student');
	}
}
?>