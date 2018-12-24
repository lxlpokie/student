<?php
namespace app\admin\validate;
/**
* 管理员验证器
*/
class Admin extends \think\Validate
{
	protected $rule = [
        'admin_name'		=>  'require|max:60|unique:admin',
        'admin_password'	=>	'require|alphaNum|length:6,10',
        'admin_password1'	=>	'require|alphaNum|length:6,10|confirm:admin_password',
        'group_id'			=>	'require',
    ];
    protected $message = [
	    'admin_name.require'		=>	'请输入管理员名称',
	    'admin_name.max'			=>	'管理员名称不超过20个汉字',
	    'admin_name.unique'			=>	'该管理员已经存在',
	    'admin_password.require'	=>	'请输入密码',
	    'admin_password.alphNum'	=>	'密码只能是数字和字母的组合',
	    'admin_password.length'		=>	'密码长度为6~10位',
	    'admin_password1.require'	=>	'请再次输入密码',
	    'admin_password1.alphNum'	=>	'密码只能是数字和字母的组合',
	    'admin_password1.length'	=>	'密码长度为6~10位',
	    'admin_password1.confirm'	=>	'两次密码输入不一致',
	    'group_id.require'			=>	'请选择所属用户组',
	    
	];
}
?>