<?php
namespace app\admin\validate;
/**
* 院系验证器
*/
class Course extends \think\Validate
{
	protected $rule = [
        'course_name'  =>  'require|max:60|unique:course',
        'college_id'	=>	'require|gt:0',
    ];
    protected $message = [
	    'course_name.require' => '课程名称不能为空',
	    'course_name.unique'	=>	'课程名称已经存在',
	    'college_id.gt'	=>	'请选择学院',
	];
}
?>