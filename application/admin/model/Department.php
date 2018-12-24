<?php
namespace app\admin\model;
/**
* 学院模型层
*/
class Department extends \think\Model
{
	protected $resultSetType = 'collection';
	public function college()
	/*系与学院的多对一关系*/
	{
		return $this->belongsTo('College');
	}

	public function classes()
	/*系与班级的一对多关系*/
	{
		return $this->hasMany('Classes');
	}
}
?>