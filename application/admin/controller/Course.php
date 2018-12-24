<?php
namespace app\admin\controller;
/**
* 课程控制器
*/
class Course extends Common
{
	
	public function courseadd()
	/*添加课程显示界面*/
	{
		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function courseaddhanddle()
	/*添加课程提交处理方法*/
	{
		$post = request()->post();
		$validate = validate('course');
		if(!$validate->check($post)){
			$this->error($validate->getError(),'course/courselist');
		}
		else{
			$course_add_result = db('course')->insert($post);
			if ($course_add_result) {
				$this->success('课程添加成功','course/courselist');
			}
			else{
				$this->error('课程添加失败','course/courselist');
			}
		}
	}
	public function courselist()
	/*课程列表*/
	{
		$course_model = model('course');
		$course_all = $course_model->all();
		foreach ($course_all as $key => $value) {
			$value->college;
			$value->teacher;
		}
		$course_all_toArray = $course_all->toArray();
		// dump($course_all_toArray);
		$this->assign('course_all_toArray',$course_all_toArray);
		return view();
	}

	public function courseupd($course_id='')
	/*课程修改界面显示*/
	{
		$course_find = db('course')->find($course_id);
		if (empty($course_find)) {
			$this->redirect('course/courselist');
		}
		$this->assign('course_find',$course_find);
		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function courseupdhanddle()
	/*课程修改提交处理*/
	{
		$post = request()->post();
		db('course')->update($post);
		$this->redirect('course/courselist');
	}

	public function courseteacheradd($course_id='')
	/*为课程分配教师界面*/
	{
		$course_model = model('course');
		$course_get = $course_model->get($course_id);
		if (empty($course_get)) {
			$this->redirect('course/courselist');
		}
		$course_get->college;
		$course_get['college']->teacher;
		$course_get_toArray = $course_get->toArray();
		$this->assign('course_get_toArray',$course_get_toArray);
		// dump($course_get_toArray);
		return view();
	}

	public function courseteacheraddhanddle()
	/*为课程添加教师提交处理方法*/
	{
		$post = request()->post();
		$course_model = model('course');
		$course_get = $course_model->get($post['course_id']);
		$teacher_model = model('teacher');
		$teacher_get = $teacher_model->get($post['teacher_id']);
		$course_get->teacher()->attach($post['teacher_id']);
		$this->redirect('course/courselist');
	}

	public function courseteacherdel($course_id='',$teacher_id='')
	/*位课程取消教师*/
	{
		$course_model = model('course');
		$course_get = $course_model->get($course_id);
		if (empty($course_get)) {
			$this->redirect('course/courselist');
		}

		$teacher_model = model('teacher');
		$teacher_get = $teacher_model->get($teacher_id);
		if (empty($teacher_get)) {
			$this->redirect('course/courselist');
		}

		$course_get->teacher()->detach($teacher_get);
		$this->redirect('course/courselist');
	}

	public function coursedel($course_id='')
	/*课程删除的方法*/
	{
		$course_model = model('course');
		$course_get = $course_model->get($course_id);
		if (empty($course_get)) {
			$this->redirect('course/courselist');
		}
		// $course_get->teacher()->detach();
		$course_get->delete();
		$this->redirect('course/courselist');
	}
}
?>