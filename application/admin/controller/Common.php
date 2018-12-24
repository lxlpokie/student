<?php  
namespace app\admin\controller;
/**
* 公共控制器
*/
class Common extends \think\Controller
{
	
	public function _initialize()
	/*控制器初始化函数*/
	{
		if (!session("?admin_id")) {
			$this->redirect('login/login');
		}
		$module_model = model('module');
		$module_list_select = db('module')->where('module_status','eq','1')->select();
		$module_list_inM = $module_model->getChildrenM($module_list_select);
		if(!in_array(session('admin_name'),config('superadmin'))){
			$auth = new Auth();
			if (!$auth->check(request()->controller()."/".request()->action(),session('admin_id'))) {
				$this->error('您没有该权限','index/index');
			}
			//获取管理员拥有的权限
			$authlist = $auth->getAuthList(session('admin_id'),'1');
			foreach ($module_list_inM as $key => $value) {
				//判断模块是否在权限里面
				if (in_array($value['module_name'],$authlist)) {
					$module_list_inM1[] = $value;
				}
			}
			$module_list_inM = $module_list_inM1;
		}
		$this->assign('module_list_selectM',$module_list_inM);
	}
}
?>