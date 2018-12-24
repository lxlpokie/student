<?php
namespace app\admin\controller;
/**
* 班级控制器
*/
class Classes extends Common
{
	
	public function classesadd($department_id='')
	/*添加班级界面显示*/
	{
		$department_find = db('department')->find($department_id);
		// dump($department_id);die;
		if (empty($department_find)) {
			$this->redirect('college/collegelist');
		}
		$this->assign('department_find',$department_find);
		return view();
	}

	public function classesaddhanddle()
	/*添加班级提交处理方法*/
	{
		$post = request()->post();
		$department_id = $post['department_id'];
		// dump($post);die;
		$department_model = model('department');
		$department_get = $department_model->get($department_id);
		unset($post['department_id']);dump($post);
		$department_get->classes()->save($post);
		$this->redirect('college/collegelist');
	}

	public function classesupd($classes_id='')
	/*班级修改界面*/
	{
		$classes_find = db('classes')->find($classes_id);
		if (empty($classes_find)) {
			$this->redirect('college/collegelist');
		}
		$this->assign('classes_find',$classes_find);
		return view();
	}

	public function classesupdhanddle()
	/*班级修改提交处理方法*/
	{
		$post = request()->post();
		$classes_upd_result = db('classes')->update($post);
		if($classes_upd_result!==false){
			$this->success('班级修改成功！','college/collegelist');
		}
		else{
			$this->error('班级修改失败!','college/collegelist');
		}
	}

	public function classesdel($classes_id='')
	/*班级删除的方法使用模型层实现*/
	{
		$classes_model = model('classes');
		$classes_get = $classes_model->get($classes_id);
		if (empty($classes_get)) {
			$this->redirect('college/collegelist');
		}
		$classes_num = $classes_get->classes_num;
		$department_num = substr($classes_num, 0,9);
		$college_num = substr($classes_num, 0,7);
		$dir = "uploads".DS.'student'.DS.$college_num.DS.$department_num.DS.$classes_num;
		delDirAndFile($dir,1);
		$classes_get->delete();
		$this->redirect('college/collegelist');
	}

	public function classescourseadd($classes_id='')
	/*为班级分配课程老师显示界面*/
	{
		$classes_find = db('classes')->find($classes_id);
		if(empty($classes_find)){
			$this->redirect('college/collegelist');
		}
		$this->assign('classes_find',$classes_find);
		$college_model = model('college');
		$college_all = $college_model->all();
		$college_all_toArray = $college_all->toArray();
		$this->assign('college_all_toArray',$college_all_toArray);
		// dump($college_all_toArray);
		return view();
	}

	public function choosecollege()
	/*选择学院后显示对应课程*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$college_id = $post['college_id'];
			$course_select = db('course')->where('college_id','eq',$college_id)->select();
			return $course_select;
		}
	}

	public function choosecourse()
	/*选择学院后显示对应课程*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$course_id = $post['course_id'];
			$course_model = model('course');
			$course_get = $course_model->get($course_id);
			$course_get->teacher;
			$course_get_toArray = $course_get->toArray();
			return $course_get_toArray['teacher'];
		}
	}

	public function classescourseaddhanddle()
	/*为班级分配课程及老师*/
	{
		$post = request()->post();
		$classes_id = $post['classes_id'];
		$course_id = $post['course_id'];
		$teacher_id = $post['teacher_id'];
		if ($teacher_id=='0') {
			$this->error('请选择课程及老师');
		}
		$teachercourse_model = model('teachercourse');
		$teachercourse_get = $teachercourse_model->get(function($query) use($course_id,$teacher_id){
			$query->where('course_id','eq',$course_id)->where('teacher_id','eq',$teacher_id);
		});
		$teachercourse_get->classes()->attach($classes_id);
		$this->redirect('college/collegelist');
	}

	public function classescourseupd($classes_id='')
	/*班级课程修改（删除）*/
	{
		$classes_model = model('classes');
		$classes_get = $classes_model->get($classes_id);
		if (empty($classes_get)) {
			$this->redirect('college/collegelist');
		}
		$classes_get->teachercourse;
		foreach ($classes_get['teachercourse'] as $key => $value) {
			$value->teacher;
			$value->course;
			$value['teacher']->college;
			$value['teacher']['college']->course;
			$value['course']->teacher;
		}
		$classes_get_toArray = $classes_get->toArray();
		// dump($classes_get_toArray);
		$this->assign('classes_get_toArray',$classes_get_toArray);

		$college_select = db('college')->select();
		// $course_select = db('course')->select();
		// $teacher_select = db('teacher')->select();
		$this->assign('college_select',$college_select);
		return view();
	}
	public function teachercoursedelajax()
	/*班级课程修改的ajax请求处理*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$classes_id = $post['classes_id'];
			$course_id = $post['course_id'];
			$teacher_id = $post['teacher_id'];
			$teachercourse_model = model('teachercourse');
			$teachercourse_get = $teachercourse_model->get(function($query) use($course_id,$teacher_id){
				$query->where('course_id','eq',$course_id)->where('teacher_id','eq',$teacher_id);
			});
			$teachercourse_get->classes()->detach($classes_id);

		}
	}
	

	
}
?>