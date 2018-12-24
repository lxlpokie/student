<?php
namespace app\admin\model;
/**
* 成绩模型
*/
class Score extends \think\Model
{
	protected $resultSetType = 'collection';
	public function student()
	/*学生与班级的多对一关系*/
	{
		return $this->belongsTo('Student');
	}

	public function course()
	/*成绩和课程的多对一关系*/
	{
		return $this->belongsTo("Course");
	}

}
?>