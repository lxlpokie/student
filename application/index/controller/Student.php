<?php  
namespace app\index\controller;
/**
* 学生控制器
*/
class Student extends Common
{
	
	public function index()
	/*学生首页*/
	{
		$student_model = model('\app\admin\model\Student');
		$student_get = $student_model->get(session('student_id'));
		$student_get->score;
		foreach ($student_get['score'] as $key => $value) {
			$value->course;
		}
		$student_get_toArray = $student_get->toArray();
		$this->assign('student_get_toArray',$student_get_toArray);
		return view();
	}

	public function studentinfo()
	/*学生资料*/
	{
		$student_model = model('\app\admin\model\Student');
		$student_get = $student_model->get(session('student_id'));
		if (empty($student_get)) {
			$this->redirect('student/index');
		}
		$student_get->party;
		$student_get->classes;
		$student_get_toArray = $student_get->toArray();
		// dump($student_get_toArray);
		$this->assign('student_get_toArray',$student_get_toArray);
		return view();
	}
	

}
?>