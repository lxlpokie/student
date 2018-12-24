<?php
namespace app\admin\controller;
/**
* 系控制器
*/
class Department extends Common
{
	public function departmentadd($college_id='')
	/*添加系界面*/
	{
		$college_find = db('college')->find($college_id);
		if (empty($college_find)) {
			$this->redirect('college/collegelist');
		}
		$this->assign('college_find',$college_find);
		return view();
	}
	public function departmentaddhanddle()
	{
		$post = request()->post();
		$college_id = $post['college_id'];
		// dump($post);die;
		$college_model = model('college');
		$college_get = $college_model->get($college_id);
		unset($post['college_id']);dump($post);
		$college_get->department()->save($post);
		$this->redirect('college/collegelist');
	}

	public function departmentupd($department_id='')
	/*系修改界面*/
	{
		$department_find = db('department')->find($department_id);
		if (empty($department_find)) {
			$this->redirect('college/collegelist');
		}
		$this->assign('department_find',$department_find);
		return view();
	}

	public function departmentupdhanddle()
	/*系修改提交处理方法*/
	{
		$post = request()->post();
		$department_upd_result = db('department')->update($post);
		if($department_upd_result!==false){
			$this->success('系修改成功！','college/collegelist');
		}
		else{
			$this->error('系修改失败!','college/collegelist');
		}
	}

	public function departmentdel($department_id)
	/*系删除的方法使用模型层实现*/
	{
		$department_model = model('department');
		$department_get = $department_model->get($department_id);
		if (empty($department_get)) {
			$this->redirect('college/collegelist');
		}
		$department_get->classes()->delete();
		$department_get->delete();
		$this->redirect('college/collegelist');
	}
}
?>