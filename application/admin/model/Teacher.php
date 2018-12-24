<?php
namespace app\admin\model;
/**
* 教师模型层
*/
class Teacher extends \think\Model
{
	protected $resultSetType = 'collection';
	public function college()
	/*学院与教师的一对多关系*/
	{
		return $this->belongsTo('College');
	}

	public function title()
	/*教师与职称之间的多对一关系*/
	{
		return $this->belongsTo('Title');
	}

	public function course()
	/*教师与课程的多对多关系*/
	{
		return $this->belongsToMany('Course','teachercourse')->using('Teachercourse');
	}

	public function teachercourse()
	/*教师与教师课程的多对一关系*/
	{
		return $this->hasMany('Teachercourse');
	}
}
?>