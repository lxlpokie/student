<?php
namespace app\admin\validate;
/**
* 院系验证器
*/
class Teacher extends \think\Validate
{
	protected $rule = [
        'teacher_name'  =>  'require|max:60',
        'college_id'	=>	'require|gt:0',
        'title_id'	=>	'require|gt:0'
    ];
    protected $message = [
	    'teacher_name.require' => '请输入教师名称',
	    'college_id.gt'	=>	'请选择学院',
	    'title_id.gt'	=>	'请选择职称'
	];
}
?>