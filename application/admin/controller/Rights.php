<?php  
namespace app\admin\Controller;
/**
* 权限控制器
*/
class Rights extends Common
{
	
	public function ruleadd()
	/*添加规则界面*/
	{
		$rule_select = db('auth_rule')->where('status','eq','1')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildren($rule_select);
		$this->assign('rule_in',$rule_in);
		// dump($rule_in);
		return view();
	}

	public function ruleaddhanddle()
	/*添加规则提交处理*/
	{
		$post = request()->post();
		if (empty($post)) {
			$this->redirect('rights/rulelist');
		}
		$validate = validate('Rights');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$rule_add_result = db('auth_rule')->insert($post);
		if ($rule_add_result) {
			$this->success('规则添加成功','rights/ruleadd');
		}
		else{
			$this->error('规则添加失败','rights/ruleadd');
		}
	}

	public function rulelist()
	/*规则列表*/
	{
		$rule_select = db('auth_rule')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildren($rule_select);
		$this->assign('rule_in',$rule_in);
		// dump($rule_in);
		return view();
	}

	public function ruleupd($id="")
	/*修改规则界面显示*/
	{
		$rule_find = db('auth_rule')->find($id);
		if (empty($rule_find)) {
			$this->redirect('rights/rulelist');
		}
		$this->assign('rule_find',$rule_find);
		$rule_select = db('auth_rule')->where('status','eq','1')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildren($rule_select);
		$this->assign('rule_in',$rule_in);
		// dump($rule_in);
		return view();
	}

	public function ruleupdhanddle()
	/*修改规则提交处理方法*/
	{
		$post = request()->post();
		if (empty($post)) {
			$this->redirect('rights/rulelist');
		}
		$validate = validate('Rights');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$rule_add_result = db('auth_rule')->update($post);
		if ($rule_add_result!==false) {
			$this->success('规则修改成功','rights/rulelist');
		}
		else{
			$this->error('规则修改失败','rights/rulelist');
		}
	}

	public function ruledel($id='')
	{
		$rule_find = db('auth_rule')->find($id);
		if (empty($rule_find)) {
			$this->redirect('rights/rulelist');
		}
		$rule_select = db('auth_rule')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildren($rule_select,$id);
		$rule_in[] = $rule_find;
		//将规则彻底删除
		/*foreach ($rule_in as $key => $value) {
			db('auth_rule')->delete($value['id']);
		}*/
		//将规则状态改为不可用
		foreach ($rule_in as $key => $value) {
			db('auth_rule')->where('id','eq',$value['id'])->update(['status'=>'0']);
		}
		$this->redirect('rights/rulelist');

	}
	public function ruleactive($id='')
	{
		$rule_find = db('auth_rule')->find($id);
		if (empty($rule_find)) {
			$this->redirect('rights/rulelist');
		}
		$rule_select = db('auth_rule')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildren($rule_select,$id);
		$rule_in[] = $rule_find;
		//将规则彻底删除
		/*foreach ($rule_in as $key => $value) {
			db('auth_rule')->delete($value['id']);
		}*/
		//将规则状态改为不可用
		foreach ($rule_in as $key => $value) {
			db('auth_rule')->where('id','eq',$value['id'])->update(['status'=>'1']);
		}
		$this->redirect('rights/rulelist');
	}

	public function groupadd()
	/*添加用户组界面显示*/
	{
		$rule_select = db('auth_rule')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildrenM($rule_select);
		$this->assign('rule_in',$rule_in);
		// dump($rule_in);
		return view();
	}

	public function groupaddhanddle()
	/*添加用户组提交方法处理*/
	{
		$post = request()->post();
		$validate = validate('AuthGroup');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$post['rules'] = implode(',',$post['rules']);

		$group_add_result = db('auth_group')->insert($post);
		if ($group_add_result) {
			$this->success('用户组添加成功','rights/grouplist');
		}
		else{
			$this->error('用户组添加失败','rights/grouplist');
		}

	}

	public function grouplist()
	/*用户组列表*/
	{
		$group_select = db('auth_group')->select();
		foreach ($group_select as $key => $value) {
			$rules = db('auth_rule')->where('id','in',$value['rules'])->where('status','eq','1')->select();
			$group_select[$key]['rules'] = $rules;
			}
		$this->assign('group_select',$group_select);
		return view();
	}

	public function groupupd($id="")
	/*用户组修改界面显示*/
	{
		$group_find = db('auth_group')->find($id);
		if (empty($group_find)) {
			$this->redirect('rights/grouplist');
		}
		$group_find['rules'] = explode(',',$group_find['rules']);

		$this->assign('group_find',$group_find);
		$rule_select = db('auth_rule')->select();
		$auth_rule_model = model('AuthRule');
		$rule_in = $auth_rule_model->getChildrenM($rule_select);
		$this->assign('rule_in',$rule_in);
		return view();
	}

	public function groupupdhanddle()
	/*修改用户组提交处理方法*/
	{
		$post = request()->post();
		if (empty($post)) {
			$this->redirect('rights/grouplist');
		}
		$validate = validate('AuthGroup');
		if (!$validate->check($post)) {
			$this->error($validate->getError());
		}
		$post['rules'] = implode(',',$post['rules']);

		$group_add_result = db('auth_group')->update($post);
		if ($group_add_result) {
			$this->success('用户组修改成功','rights/grouplist');
		}
		else{
			$this->error('用户组修改失败','rights/grouplist');
		}
	}

	public function changeGroupStatus()
	/*改变用户组状态的ajax请求处理*/
	{
		if (request()->isAjax()) {
			$post = request()->post();
			$id = $post['id'];
			$group_find = db('auth_group')->find($id);
			$status = $group_find['status'];
			db('auth_group')->where('id','eq',$id)->update(['status'=>!$status]);
			return '1';
		}
	}

	public function groupdel($id='')
	/*用户组的删除*/
	{
		$group_find = db('auth_group')->find($id);
		if (empty($group_find)) {
			$this->redirect('rights/grouplist');
		}
		$group_del_result = db('auth_group')->delete($id);
		if ($group_del_result) {
			$this->success('用户组删除成功','rights/grouplist');
		}
		else{
			$this->error('用户组删除失败','rights/grouplist');
		}
	}

	public function adminadd()
	/*添加管理员界面显示*/
	{
		$group_select = db('auth_group')->where('status','eq','1')->select();
		$this->assign('group_select',$group_select);
		return view();
	}

	public function adminaddhanddle()
	/*添加管理员提交处理方法*/
	{
		if (request()->isPost()) {
			$post = request()->post();
			$validate = validate('Admin');
			if (!$validate->check($post)) {
				$this->error($validate->getError());
			}
			unset($post['admin_password1']);
			$post['admin_password'] = md5($post['admin_password']);
			$group_id = $post['group_id'];
			unset($post['group_id']);
			$admin_add_result = db('admin')->insertGetId($post);
			if ($admin_add_result) {
				$admin_model = model('Admin');
				$admin_get = $admin_model->get($admin_add_result);
				foreach ($group_id as $key => $value) {
					$admin_get->group()->save($value);
				}
				$this->success('管理员添加成功','rights/adminlist');
			}
			else{
				$this->error('管理员添加失败','rights/adminlist');
			}
		}
	}

	public function adminlist()
	/*管理员列表*/
	{
		$admin_select = db('admin')->select();
		$this->assign('admin_select',$admin_select);
		return view();
	}

	public function adminupd($admin_id='')
	/*管理员修改界面显示*/
	{
		$admin_model = model('Admin');
		$admin_get = $admin_model->get($admin_id);
		if (empty($admin_get)) {
			$this->redirect('rights/adminlist');
		}
		$auth = new Auth();
		$group_ids = $auth->getGroups($admin_id);
		$group_id = array_column($group_ids,'group_id');
		$this->assign('group_id',$group_id);

		$group_select = db('auth_group')->where('status','eq','1')->select();
		$this->assign('group_select',$group_select);
		$this->assign('admin_find',$admin_get->toArray());
		return view();
	}

	public function adminupdhanddle()
	/*管理员修改提交处理*/
	{
		if (request()->isPost()) {
			$post = request()->post();
			$validate = validate('Admin');
			if (!$validate->check($post)) {
				$this->error($validate->getError());
			}
			
			unset($post['admin_password1']);
			$post['admin_password'] = md5($post['admin_password']);
			//获取提交过来的用户组id
			$group_id = $post['group_id'];
			unset($post['group_id']);
			$admin_add_result = db('admin')->update($post);
			if ($admin_add_result!==false) {
				$admin_model = model('Admin');
				$admin_get = $admin_model->get($post['admin_id']);
				//删除旧的中间表
				$admin_get->group()->detach();
				//添加新的关系
				foreach ($group_id as $key => $value) {
					$admin_get->group()->save($value);
				}
				$this->success('管理员修改成功','rights/adminlist');
			}
			else{
				$this->error('管理员修改失败','rights/adminlist');
			}
		}
	}

	public function admindel($admin_id='')
	/*管理员删除*/
	{
		$admin_find = db('admin')->find($admin_id);
		if (empty($admin_find)) {
			$this->redirect('rights/adminlist');
		}
		$admin_del_result = db('admin')->delete($admin_id);
		if ($admin_del_result) {
			$this->success('管理员删除成功','rights/adminlist');
		}
		else{
			$this->error('管理员删除失败','rights/adminlist');
		}
	}
}
?>