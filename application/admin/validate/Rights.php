<?php
namespace app\admin\validate;
/**
* 规则验证器
*/
class Rights extends \think\Validate
{
	protected $rule = [
        'name'  =>  'require|max:60|unique:auth_rule',
       	'title'	=>	'require|max:60|unique:auth_rule'
    ];
    protected $message = [
	    'name.require'	=> 	'请输入规则',
	    'name.unique'	=>	'该规则已经存在',
	    'name.max'		=>	'规则长度不超过20个汉字',
	    'title.require'	=>	'请输入规则名称',
	    'title.unique'	=>	'该规则名称已经存在',
	    'title.max'		=>	'规则名称不超过20个汉字'
	    
	];
}
?>