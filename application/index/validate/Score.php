<?php
namespace app\index\validate;
/**
* 分数验证器
*/
class Score extends \think\Validate
{
	
	protected $rule = [
		'score'   => 'unique:score,course_id^student_id',
	];
}
?>