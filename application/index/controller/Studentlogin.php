<?php
namespace app\index\controller;
/**
* 教师登录控制器
*/
class Studentlogin extends \think\Controller
{
	
	public function login()
	/*学生登录界面显示*/
	{
		return view();
	}

	public function checklogin()
	/*教师登录验证*/
	{
		$post = request()->post();
		// dump($post);
		$student_find = db('student')->where('student_num','eq',$post['student_num'])->where('student_password','eq',md5($post['student_password']))->find();
		if(empty($student_find)){
			$this->error('学号或密码错误','studentlogin/login');
		}
		else{
			session('student_num',$student_find['student_num']);
			session('student_id',$student_find['student_id']);
			$this->success('登录成功','student/index');
		}
	}

	public function logout()
	/*教师登出*/
	{
		session('student_num',null);
		session('student_id',null);
		$this->redirect('studentlogin/login');
	}
}
?>
