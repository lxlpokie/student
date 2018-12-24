<?php  
namespace app\index\controller;
/**
* 公共控制器
*/
class Common extends \think\Controller
{
	
	public function _initialize()
	/*控制器初始化函数*/
	{
		if (request()->controller()=='Student') {
			if(!session('?student_id')){
				$this->redirect('studentlogin/login');
			}
		}else{
			if(!session('?teacher_id')){
				$this->redirect('teacherlogin/login');
			}
		}
	}
}
?>