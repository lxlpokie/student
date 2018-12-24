<?php
namespace app\admin\validate;
/**
* 院系验证器
*/
class College extends \think\Validate
{
	protected $rule = [
        'college_name'  =>  'require|max:60|unique:college',
        'college_num'	=>	'require|number|length:7|between:1000101,1000199|unique:college',
    ];
    protected $message = [
	    'college_name.require' => '院系名称不能为空',
	    'college_name.unique'	=>	'院系名称已经存在',
	    'college_num.length'	=>	'请输入七位的数字',
	    'college_num.number'	=>	'请输入七位的数字',
	    'college_num.unique'	=>	'该编号在此学院已经存在'
	];
}
?>