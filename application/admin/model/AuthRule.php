<?php
namespace app\admin\model;
/**
* 模块模型
*/
class AuthRule extends \think\Model
{
	
	public function getChildren($list,$pid='0',$level=0)
	/*无限级分类得到全部子类*/
	{
		static $arr = array();
		foreach ($list as $key => $value) {
			if($value['pid']==$pid){
				$value['level'] = $level;
				$value['str'] = str_repeat('————',$value['level']);
				$arr[] = $value;
				$this->getChildren($list,$value['id'],$level+1);
			}
		}
		return $arr;
	}

	public function getChildrenM($list,$pid='0')
	/*无限级分类得到全部子类*/
	{
		$arr = array();
		foreach ($list as $key => $value) {
			if($value['pid']==$pid){
				$value['children'] = $this->getChildrenM($list,$value['id']);
				$arr[] = $value;
			}
		}
		return $arr;
	}

}
?>