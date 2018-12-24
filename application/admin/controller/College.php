<?php
namespace app\admin\controller;
/**
* 学院控制器
*/
class College extends Common
{
	
	public function collegelist()
	/*院系列表*/
	{
		$college = model('college');
		$college_all = $college->all();
		foreach ($college_all as $key => $value) {
			$value->department;
			foreach($value['department'] as $k => $v){
				$v->classes;
			}
		}
		$college_all_toArray = $college_all->toArray();
		$this->assign('college_all_toArray',$college_all_toArray);
		return view();
	}

	public function collegeadd()
	/*添加学院界面显示*/
	{
		return view();
	}

	public function collegeaddhanddle()
	/*添加学院提交处理*/
	{
		$post = request()->post();
		$validate = validate('college');
		if (!$validate->check($post)) {
			$this->error($validate->getError(),'college/collegelist');
		}
		$college_add_result = db('college')->insert($post);
		if ($college_add_result) {
			$this->success('学院添加成功','college/collegelist');
		} else {
			$this->error('学院添加失败','college/collegelist');
		}
		
	}
	public function collegeupd($college_id='')
	/*修改学院界面显示*/
	{
		$college_find = db('college')->find($college_id);
		$this->assign('college_find',$college_find);
		return view();
	}

	public function collegeupdhanddle()
	/*学院修改提交处理方法*/
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
	/*学院删除的方法*/
	{
		$college_model = model('college');
		$college_get = $college_model->get($college_id);
		if(empty($college_get)){
			$this->redirect('college/collegelist');
		}
		$college_get->department;
		foreach($college_get['department'] as $key => $value){
			$value->classes()->delete();
		}
		// dump($college_get->toArray());die;
		$college_get->department()->delete();
		$college_get->delete();
	}
}
?>