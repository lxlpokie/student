<?php
namespace app\admin\model;
/**
* 学院模型层
*/
class College extends \think\Model
{
	protected $resultSetType = 'collection';
	public function department()
	/*学院与系的一对多关系*/
	{
		return $this->hasMany('Department');
	}

	public function teacher()
	/*学院与教师的一对多关系*/
	{
		return $this->hasMany('Teacher');
	}

	public function course()
	/*学院与课程的一对多关系*/
	{
		return $this->hasMany('Course');
	}
}
?>