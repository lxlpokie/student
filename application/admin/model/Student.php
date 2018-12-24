<?php
namespace app\admin\model;
/**
* 学生模型
*/
class Student extends \think\Model
{
	protected $resultSetType = 'collection';
	public function classes()
	/*学生与班级的多对一关系*/
	{
		return $this->belongsTo('Classes');
	}

	public function party()
	/*学生与政治面貌之间的多对一关系*/
	{
		return $this->belongsTo('Party');
	}

	public function score()
	/*学生和成绩的一对多关系*/
	{
		return $this->hasMany('Score');
	}
}
?>