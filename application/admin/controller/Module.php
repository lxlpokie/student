<?php
namespace app\admin\controller;
/**
* 模块管理控制器
*/
class Module extends Common
{
	
	public function modulelist()
	/*模块列表方法*/
	{
		$module_model = model('module');
		$module_list_select = db('module')->select();
		$module_list_in = $module_model->getChildren($module_list_select);
		// $module_list_inM = $module_model->getChildrenM($module_list_select);
		$this->assign('module_list_select',$module_list_in);
		// $this->assign('module_list_selectM',$module_list_inM);
		return view();
	}

	public function moduleadd()
	/*模块添加显示界面*/
	{
		return view();
	}

	public function moduleremove($module_id='')
	/*模块移除的方法*/
	{
		$module_model = model('module');
		$module_find = db('module')->find($module_id);
		$module_list_select = db('module')->select();
		$module_list_in = $module_model->getChildren($module_list_select,$module_id);
		$module_list_in[] = $module_find;
		foreach ($module_list_in as $key => $value) {
			$data = [
				'module_id'	=>	$value['module_id'],
				'module_status'	=>	'0'
			];
			db('module')->update($data);
		}
		dump($module_list_in);

	}

	public function moduleactive($module_id='')
	/*模块移除的方法*/
	{
		$module_model = model('module');
		$module_find = db('module')->find($module_id);
		$module_list_select = db('module')->select();
		$module_list_in = $module_model->getChildren($module_list_select,$module_id);
		$module_list_in[] = $module_find;
		foreach ($module_list_in as $key => $value) {
			$data = [
				'module_id'	=>	$value['module_id'],
				'module_status'	=>	'1'
			];
			db('module')->update($data);
		}
		dump($module_list_in);

	}
}
?>