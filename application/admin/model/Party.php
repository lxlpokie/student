<?php
namespace app\admin\model;
/**
* 学生模型
*/
class Party extends \think\Model
{
	protected $resultSetType = 'collection';
	public function student()
	/*学生与政治面貌之间的多对一关系*/
	{
		return $this->hasMany('Student');
	}
}
?>