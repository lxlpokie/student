<?php  
namespace app\admin\model;
/**
* 管理员模型
*/
class Admin extends \think\Model
{
	protected $resultSetType = 'collection';
	public function group()
	/*管理员与用户组之间的*/
	{
		return $this->belongsToMany('AuthGroup','auth_group_access','group_id','uid');
	}
}
?>