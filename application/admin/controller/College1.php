<?php
namespace app\admin\controller;
/**
* 院系控制器
*/
class College extends Common
{
	
	public function collegeadd()
	/*添加院系的界面*/
	{
		$college_select = db('college')->where('college_pid','eq','0')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function collegeaddhanddle()
	/*添加院系的提交方法*/
	{
		$post = request()->post();
		$validate = validate('College');
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$college_add_result = db('college')->insert($post);
		if ($college_add_result) {
			$this->success('院系添加成功!');
		}
		else{
			$this->error('院系添加失败！');
		}
	}

	public function collegelist()
	/*院系列表*/
	{
		$collge_model = model('college');
		$college_list = db('college')->select();
		$college_in = $collge_model->getChildren($college_list);
		$this->assign('college_in',$college_in);
		// dump($college_in);
		return view();
	}

	public function collegeupd($college_id='')
	/*修改院系界面*/
	{
		$college_find = db('college')->find($college_id);
		if (empty($college_find)) {
			$this->redirect('college/collegelist');
		}
		$this->assign('college_find',$college_find);

		$college_select = db('college')->where('college_pid','eq','0')->select();
		$this->assign('college_select',$college_select);
		return view();
	}

	public function collegeupdhanddle()
	/*院系修改提交处理方法*/
	{
		$post = request()->post();
		$college_upd_result = db('college')->update($post);
		if($college_upd_result!==false){
			$this->success('院系修改成功！','college/collegelist');
		}
		else{
			$this->error('院系修改失败!','college/collegelist');
		}
	}

	public function collegedel($college_id='')
	/*院系删除的方法*/
	{
		$college_model = model('college');
		$college_find = db('college')->find($college_id);
		if(empty($college_find)){
			$this->redirect('college/collegelist');
		}
		$college_list_select = db('college')->select();
		$college_list_in = $college_model->getChildren($college_list_select,$college_id);
		$college_list_in[] = $college_find;
		foreach ($college_list_in as $key => $value) {
			db('college')->delete($value['college_id']);
		}
		$this->redirect('college/collegelsit');
	}
}
?>