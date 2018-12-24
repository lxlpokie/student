<?php  
namespace app\admin\controller;
/**
* 登录控制器
*/
class Login extends \think\Controller
{
	
	public function login()
	/*管理员登录界面显示*/
	{
		return view();
	}

	public function checklogin()
	/*验证管理员登录*/
	{
		if (request()->isPost()) {
			$post = request()->post();
			$admin_find = db('admin')->where('admin_name','eq',$post['admin_name'])->where('admin_password','eq',md5($post['admin_password']))->find();
			if (empty($admin_find)) {
				$this->error('用户或密码错误','login/login');
			}
			else{
				session('admin_id',$admin_find['admin_id']);
				session('admin_name',$admin_find['admin_name']);
				$this->redirect('index/index');
			}
		}
	}

	public function logout()
	/*管理员登出*/
	{
		session('admin_id',null);
		session('admin_name',null);
		$this->redirect('login/login');
	}
}
?>