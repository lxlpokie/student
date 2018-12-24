<?php
namespace app\index\controller;
/**
* 教师登录控制器
*/
class Teacherlogin extends \think\Controller
{
	
	public function login()
	/*教师登录界面显示*/
	{
		return view();
	}

	public function checklogin()
	/*教师登录验证*/
	{
		$post = request()->post();
		$teacher_find = db('teacher')->where('teacher_name','eq',$post['teacher_name'])->where('teacher_password','eq',$post['teacher_password'])->find();
		if(empty($teacher_find)){
			$this->error('姓名或密码错误','teacherlogin/login');
		}
		else{
			session('teacher_name',$teacher_find['teacher_name']);
			session('teacher_id',$teacher_find['teacher_id']);
			$this->success('登录成功','teacher/index');
		}
	}

	public function logout()
	/*教师登出*/
	{
		session('teacher_name',null);
		session('teacher_id',null);
		$this->redirect('teacherlogin/login');
	}
}
?>
