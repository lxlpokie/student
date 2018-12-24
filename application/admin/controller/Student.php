<?php
namespace app\admin\controller;
/**
* 学生控制器
*/
class Student extends Common
{
	
	public function studentadd()
	/*添加学生界面显示*/
	{
		$party_select = db('party')->select();
		$this->assign('party_select',$party_select);

		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function choosecollegeajax()
	/*选择学院时的ajax请求处理*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$college_id = $post['college_id'];
			$department_select = db('department')->where('college_id','eq',$college_id)->select();
			return $department_select;
		}
	}

	public function choosedepartmentajax()
	/*选择系时的ajax请求处理*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$department_id = $post['department_id'];
			$classes_select = db('classes')->where('department_id','eq',$department_id)->select();
			return $classes_select;
		}
	}

	public function studentaddhanddle()
	/*添加学生请求处理方法*/
	{
		$post = request()->post();
		$validate = validate('student');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		dump($post);
		// 获取表单上传文件 例如上传了001.jpg
	    $file = request()->file('student_thumb');
	    if (empty($file)) {
	    	$this->error('请选择图片');
	    }
	    $college_find = db('college')->find($post['college_id']);
	    $college_num = $college_find['college_num'];
	    $department_find = db('department')->find($post['department_id']);
	    $department_num = $department_find['department_num'];
	    $classes_find = db('classes')->find($post['classes_id']);
	    $classes_num = $classes_find['classes_num'];
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'student'.DS.$college_num.DS.$department_num.DS.$classes_num,$post['student_num']);
	    if($info){
	    	$post['student_thumb'] = DS.'student'.DS. 'public' . DS . 'uploads'.DS.'student'.DS.$college_num.DS.$department_num.DS.$classes_num.DS.$info->getSaveName();
	    	$post['student_password'] = md5(substr($post['student_IDcard'], 12));
	        unset($post['college_id']);
	        unset($post['department_id']);
	        $student_add_result = db('student')->insert($post);
	        if ($student_add_result) {
	        	$this->success('学生信息添加成功');
	        }
	        else{
	        	$this->error('学生信息添加失败');
	        }
	    }else{
	        // 上传失败获取错误信息
	        $this->error($file->getError());
    	}
	}

	public function studentlist()
	/*学生列表*/
	{
		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function getstudentlist()
	/*学生列表ajax请求的处理方法*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$student_select = db('student')->where('classes_id','eq',$post['classes_id'])->select();
			$this->assign('student_select',$student_select);
			$view = $this->fetch();
			return $view;
		}
	}

	public function studentinfo($student_id='')
	/*查看学生具体信息*/
	{
		$student_model = model('student');
		$student_get = $student_model->get($student_id);
		if (empty($student_get)) {
			$this->redirect('student/studentlist');
		}
		$student_get->party;
		$student_get->classes;
		$student_get_toArray = $student_get->toArray();
		// dump($student_get_toArray);
		$this->assign('student_get_toArray',$student_get_toArray);
		return view();
	}

	public function studentupd($student_id='')
	/*学生信息修改界面显示*/
	{
		$student_find = db('student')->find($student_id);
		if (empty($student_find)) {
			$this->redirect('student/studentlist');
		}

		$party_select = db('party')->select();
		$this->assign('party_select',$party_select);

		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);

		$this->assign('student_find',$student_find);
		return view();
	}

	public function studentupdhanddle()
	/*学生信息修改提交处理方法*/
	{
		//获取post信息并验证post
		$post = request()->post();
		$validate = validate('student');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		//得到旧图片地址
		$student_find = db('student')->find($post['student_id']);
		$student_thumb_old = $student_find['student_thumb'];
		//得到学院编号
		$college_find = db('college')->find($post['college_id']);
	    $college_num = $college_find['college_num'];
	    //得到系编号
	    $department_find = db('department')->find($post['department_id']);
	    $department_num = $department_find['department_num'];
	    //得到班级编号
	    $classes_find = db('classes')->find($post['classes_id']);
	    $classes_num = $classes_find['classes_num'];
	    //图片上传
		$file = request()->file('student_thumb');
	    if (empty($file)) {
	    	$this->error('请选择图片');
	    }
	    $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS .'student'.DS.$college_num.DS.$department_num.DS.$classes_num,$post['student_num']);
	    if($info){
	    	$student_thumb_new = DS.'student'.DS. 'public' . DS . 'uploads'.DS.'student'.DS.$college_num.DS.$department_num.DS.$classes_num.DS.$info->getSaveName();
	    	$post['student_thumb'] = $student_thumb_new;
	        unset($post['college_id']);
	        unset($post['department_id']);
	        $student_add_result = db('student')->update($post);
	        $thumb_pre = DS.'student'.DS.'public';
	        if ($student_add_result) {
	        	$student_thumb_del = str_replace($thumb_pre, '.', $student_thumb_old);
		    	if (file_exists($student_thumb_del)) {
		    		unlink($student_thumb_del);
		    	}
	        	$this->success('学生信息修改成功');
	        }
	        else{
	        	$student_thumb_del = str_replace($thumb_pre, '.', $student_thumb_new);
		    	if (file_exists($student_thumb_del)) {
		    		unlink($student_thumb_del);
		    	}
	        	$this->error('学生信息修改失败');
	        }
	    }else{
	        // 上传失败获取错误信息
	        $this->error($file->getError());
    	}
	}

	public function studentdel($student_id="")
	/*删除学生的方法*/
	{
		$student_find = db("student")->find($student_id);
		if (empty($student_find)) {
			$this->redirect('student/studentlist');
		}
		$student_thumb_old = $student_find['student_thumb'];
		$student_del_result = db("student")->delete($student_id);
		if ($student_del_result) {
			 $thumb_pre = DS.'student'.DS.'public';
			 $student_thumb_del = str_replace($thumb_pre, '.', $student_thumb_old);
		    	if (file_exists($student_thumb_del)) {
		    		unlink($student_thumb_del);
		    	}
		    $this->success('学生信息删除成功','student/studentlist');
		}
		else{
			$this->error('学生信息删除失败','student/studentlist');
		}
	}
}
?>