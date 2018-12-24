<?php
namespace app\admin\Controller;
/**
* 教师控制器
*/
class Teacher extends Common
{
	
	public function teacherlist()
	/*教师列表*/
	{
		$teacher_model = model('teacher');
		$teacher_all = $teacher_model->all();
		foreach ($teacher_all as $key => $value) {
			$value->college;
			$value->title;
		}
		$teacher_all_toArray = $teacher_all->toArray();
		$this->assign('teacher_all_toArray',$teacher_all_toArray);
		return view();
	}

	public function teacheradd()
	/*添加教师界面*/
	{
		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);

		$title_select = db('title')->select();
		$this->assign('title_select',$title_select);
		return view();
	}

	public function teacheraddhanddle()
	/*教师添加提交处理*/
	{
		$post = request()->post();
		$validate = validate('teacher');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$file1 = request()->file('teacher_thumb');
		
		if (empty($file1)) {
			$this->error('请上传教师照片');
		}
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'teacher'.DS.'thumb');
	    if($info1){
	    	$post['teacher_thumb'] = DS.'student'.DS. 'public' . DS . 'uploads'.DS.'teacher'.DS.'thumb'.DS.$info1->getSaveName();
	    }else{
	        // 上传失败获取错误信息
	        return $file1->getError();
	    }
	    $teacher_add_result = db('teacher')->insert($post);
	    $this->redirect('teacher/teacherlist');
	}

	public function teacherupd($teacher_id='')
	/*教师修改界面显示*/
	{
		$teacher_find = db('teacher')->find($teacher_id);
		if (empty($teacher_id)) {
			$this->redirect('teacher/teacherlist');
		}
		$this->assign('teacher_find',$teacher_find);
		$college_select = db('college')->select();
		$this->assign('college_select',$college_select);

		$title_select = db('title')->select();
		$this->assign('title_select',$title_select);
		return view();
	}

	public function teacherupdhanddle()
	/*教师修改提交处理*/
	{
		$post = request()->post();
		$teacher_find = db('teacher')->find($post['teacher_id']);
		$thumb_old = $teacher_find['teacher_thumb'];
		$validate = validate('teacher');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$file1 = request()->file('teacher_thumb');
		if (empty($file1)) {
			$this->error('请上传教师照片');
		}
	    // 移动到框架应用根目录/public/uploads/ 目录下
	    $info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads'.DS.'teacher'.DS.'thumb');
	    if($info1){
	    	$thumb_new = DS.'student'.DS. 'public' . DS . 'uploads'.DS.'teacher'.DS.'thumb'.DS.$info1->getSaveName();
	    	$post['teacher_thumb'] = $thumb_new;
	    }else{
	        // 上传失败获取错误信息
	        return $file1->getError();
	    }
	    $teacher_upd_result = db('teacher')->update($post);
	    $thumb_pre = DS.'student'.DS.'public';
	    if($teacher_upd_result!==false){
	    	$thumb_del = str_replace($thumb_pre, '.', $thumb_old);
	    	if (file_exists($thumb_del)) {
	    		unlink($thumb_del);
	    	}
	    	$this->success('教师信息修改成功','teacher/teacherlist');
	    }
	    else{
	    	$thumb_del = str_replace($thumb_pre, '.', $thumb_new);
	    	if (file_exists($thumb_del)) {
	    		unlink($thumb_del);
	    	}
	    	$this->error('教师信息修改失败','teacher/teacherlist');
	    }
	    $this->redirect('teacher/teacherlist');
	}

	public function teacherdel1($teacher_id='')
	/*不使用模型层进行教师及图片的删除*/
	{
		$teacher_find = db('teacher')->find($teacher_id);
		if (empty($teacher_find)) {
			$this->redirect('teacher/teacherlist');
		}
		$thumb = $teacher_find['teacher_thumb'];
		$teacher_del_result = db('teacher')->delete($teacher_id);
		if ($teacher_del_result) {
			$thumb_pre = DS.'student'.DS.'public';
			$thumb_del = str_replace($thumb_pre, '.', $thumb);
	    	if (file_exists($thumb_del)) {
	    		unlink($thumb_del);
	    	}
			$this->success('教师信息删除成功','teacher/teacherlist');
		}
		else{
			$this->error('教师信息删除失败','teacher/teacherlist');
		}
	}

	public function teacherdel($teacher_id='')
	/*使用模型层进行教师和图片的删除（推荐使用这种方法）*/
	{
		$teacher_model = model('teacher');
		$teacher_get = $teacher_model->get($teacher_id);
		if (empty($teacher_get)) {
			$this->redirect('teacher/teacherlist');
		}
		$thumb_pre = DS.'student'.DS.'public';
		$thumb_del = str_replace($thumb_pre, '.', $teacher_get->teacher_thumb);
    	if (file_exists($thumb_del)) {
    		unlink($thumb_del);
    	}
    	$teacher_get->course()->detach();
    	$teacher_get->delete();
    	$this->redirect('teacher/teacherlist');
	}

	
}
?>