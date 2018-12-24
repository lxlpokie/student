<?php
namespace app\admin\validate;
/**
* 用户组验证器
*/
class AuthGroup extends \think\Validate
{
	protected $rule = [
        'title'	=>  'require|max:60|unique:auth_group',
        'rules'	=>	'require',
    ];
    protected $message = [
	    'title.require'	=>	'请输入用户组名称',
	    'title.unique'	=>	'该用户组名称已经存在',
	    'title.max'		=>	'用户组名称不超过20个汉字',
	    'rules.require'	=>	'用户规则不能为空！'
	    
	];
}
?>