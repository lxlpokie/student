<?php
namespace app\index\controller;
/**
* 
*/
class Teacher extends Common
{
	
	public function index()
	{
		$teacher_id = session('teacher_id');
		$teacher_model = model('\app\admin\model\Teacher');
		$teachercourse_model = model('\app\admin\model\Teachercourse');
		$teacher_get = $teacher_model->get($teacher_id);
		// dump($teacher_get);
		$teacher_get->course;
		$teacher_get_toArray = $teacher_get->toArray();
		
		foreach ($teacher_get_toArray['course'] as $key => $value) {
			$teachercourse_id = $value['pivot']['teachercourse_id'];
			$teachercourse_get = $teachercourse_model->get($teachercourse_id);
			$teachercourse_get->classes;
			$value['classes'] = $teachercourse_get->toArray();
			$teacher_get_toArray['course'][$key] = $value;
			// dump($pivot->parent);
			// $teachercourse = $value['pivot']->subToArray();
			// dump($teachercourse);
		}
		$this->assign('teacher_get_toArray',$teacher_get_toArray);
		return view();
	}

	public function scoreadd($classes_id="",$course_id="")
	/*学生成绩录入界面*/
	{
		$classes_model = model("\app\admin\model\Classes");
		$classes_get = $classes_model->get($classes_id);
		if (empty($classes_get)) {
			$this->redirect('teacher/index');
		}

		$course_model = model("\app\admin\model\Course");
		$course_get = $course_model->get($course_id);
		if (empty($course_get)) {
			$this->redirect('teacher/index');
		}

		$classes_get->student;
		$this->assign('classes_get_toArray',$classes_get->toArray());
		$this->assign('course_get_toArray',$course_get->toArray());
		return view();
		
	}

	public function scoreaddhanddle()
	/*学生成绩录入提交界面*/
	{
		$post = request()->post();
		$param = request()->param();
		$course_id = $param['course_id'];
		if (empty($post)) {
			$this->redirect('teacher/index');
		}
		$validate = validate('score');
		foreach ($post as $key => $value) {
			$data['course_id'] = $course_id;
			$data['student_id'] = $key;
			$data['score'] = $value;
			if(!$validate->check($data)){
				continue;
			}
			else{
				db('score')->insert($data);
			}
		}
		$this->redirect('teacher/index');
	}

	public function scoreupd($classes_id="",$course_id="")
	/*修改成绩界面*/
	{
		$classes_model = model("\app\admin\model\Classes");
		$classes_get = $classes_model->get($classes_id);
		if (empty($classes_get)) {
			$this->redirect('teacher/index');
		}

		$course_model = model("\app\admin\model\Course");
		$course_get = $course_model->get($course_id);
		if (empty($course_get)) {
			$this->redirect('teacher/index');
		}

		$classes_get->student;
		$student = $classes_get->student->toArray();
		foreach ($student as $key => $value) {
			$score = db('score')->where('student_id','eq',$value['student_id'])->where('course_id','eq',$course_id)->find();
			if(empty($score)){
				$value['score'] = '0';
			}
			else{
				$value['score'] = $score['score'];
			}
			$student[$key] = $value;
		}
		// dump($student);
		// $this->assign('classes_get_toArray',$classes_get->toArray());
		$this->assign('course_get_toArray',$course_get->toArray());
		$this->assign('student',$student);

		
		return view();
	}

	public function scoreupdhanddle()
	/*学生成绩录入修改*/
	{
		$post = request()->post();
		$param = request()->param();
		$course_id = $param['course_id'];
		if (empty($post)) {
			$this->redirect('teacher/index');
		}
		$validate = validate('score');
		foreach ($post as $key => $value) {
			$data['course_id'] = $course_id;
			$data['student_id'] = $key;
			$data['score'] = $value;
			if(!$validate->check($data)){dump($data);
				db('score')->where('student_id','eq',$data['student_id'])->where('course_id','eq',$data['course_id'])->update($data);
			}
			else{
				db('score')->insert($data);
			}
		}
		$this->redirect('teacher/index');
	}
}
?>