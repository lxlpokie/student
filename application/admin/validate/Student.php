<?php
namespace app\admin\validate;
/**
* 院系验证器
*/
class Student extends \think\Validate
{
	protected $rule = [
		'student_num'		=>	'require|length:15|unique:student',
        'student_name'  	=>  'require|max:30',
        'student_home'		=>	'require',
        'student_address'	=>	'require',
        'student_birth'		=>	'require|length:6|number',
        'student_IDcard'	=>	'require|length:18|number',
        'college_id'		=>	'require|gt:0',
        'department_id'		=>	'require|gt:0',
        'classes_id'		=>	'require|gt:0'
    ];
    protected $message = [
    	'student_num.require'		=>	'请输入学生编号',
    	'student_num.length'		=>	'学生编号长度为15位',
    	'student_num.unique'		=>	'该学生信息已经存在',
	    'student_name.require' 		=> 	'请输入学生姓名',
	    'student_name.max'			=>	'学生姓名最大长度为10个汉字',
	    'student_home.require'		=>	'请输入学生籍贯信息',
	    'student_address.require'	=>	'请输入学生家庭住址信息',
	    'student_birth.require'		=>	'请输入学生出生年月如199901',
	    'student_birth.length'		=>	'出生年月为6位数字如199901',
	    'student_birth.number'		=>	'出生年月为6位数字如199901',
	    'student_IDcard.require'	=>	'请输入18位身份证号',
	    'student_birth.length'		=>	'请输入18位的身份证号',
	    'student_birth.number'		=>	'请输入18位的身份证号',
	    'college_id.gt'				=>	'请选择学院',
	    'department_id.gt'			=>	'请选择系',
	    'classes_id.gt'				=>	'请选择班级',
	];
}
?>