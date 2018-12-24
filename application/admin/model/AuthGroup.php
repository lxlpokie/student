<?php  
namespace app\admin\model;
/**
* 用户组模型
*/
class AuthGroup extends \think\Model
{
	protected $resultSetType = 'collection';
	public function admin()
	/*用户组和管理员之间的多对多关系*/
	{
		return $this->belongsToMany('Admin','auth_group_access','uid','group_id');
	}
}
?>