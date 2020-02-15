<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\LitterClassModel;
use app\admin\model\LitterClassNameModel;
use app\admin\model\LitterModel;
class Litter extends controller
{
		public	function litter()
		{

			$selectResult=Db::table('gs_litter')//热点精选
			->join('gs_litter_classname','gs_litter_classname.litter_class_pid = gs_litter.one_class_id')
			->join('gs_litter_class','gs_litter_class.litter_class_id = gs_litter.two_class_id')
			//->where('one_class_id','litter_class_pid')
		//	->where('gs_litter.two_class_id','litter_class_pid')
			->select();

			//$user = new LitterModel();
           // $res=$user->litter();
            $this->assign('litter',$selectResult);
         //   return dump($selectResult);
		//	return	$this->fetch('litter_class');
			return	$this->fetch('litter');
		}

		public	function litter_add()
		{
				if(request()->isAjax())
		        {
		          $result = array();
		          $cate = input("param.value");
		          $user = new LitterClassModel();
		          $result = $user->find($cate);
		          return json($result);
		        }

				if(request()->isPost())
				{
					$data = input("post.");
					//return dump($data);
					$user = new LitterModel();
	            	$res=$user->addlitterclass($data);
	            	$this->redirect(url('litter'));
				}

				$litter = new LitterClassNameModel();
            	$res=$litter->litterclass();
            	$this->assign('litterclass',$res);
			return	$this->fetch('litter_add');
		}

		public	function litter_update($id)
		{
				if(request()->isAjax())
		        {
		          $result = array();
		          $cate = input("param.value");
		          $user = new LitterClassModel();
		          $result = $user->find($cate);
		          return json($result);
		        }
			$selectResult=Db::table('gs_litter')//热点精选
			->join('gs_litter_class','gs_litter_class.litter_class_id = gs_litter.two_class_id')
			->join('gs_litter_classname','gs_litter_classname.litter_class_pid = gs_litter.one_class_id')
			->where('gs_litter.litter_id',$id)
			->find();
			$s=$selectResult['one_class_id'];

		//	return dump($s);
			$this->assign('litter',$selectResult);


				$litter = new LitterClassNameModel();
            	$res=$litter->litterclass();
            	$this->assign('litterclass',$res);

				$litter1 = new LitterClassModel();
            	$res1=$litter1->litterclasswhere($s);
            	$this->assign('littetwo',$res1);
            		//return dump($res1);
			return	$this->fetch('litter_update');
		}
		public	function litter_updatecheck()
		{
			if(request()->isPost())
			{
				$data = input("post.");
				$user = new LitterModel();
            	$res=$user->updatelitterclass($data);
            	$this->redirect(url('litter'));
			}
		}

	    public function litter_delete($id)
	    {
	       LitterModel::destroy($id);
	       return $this->redirect('litter');
	    }

	    public function litterclass_delete($id)
	    {
	       LitterClassModel::destroy($id);
	       return $this->redirect('litter_class');
	    }
		public	function litter_class()
		{
			$user = new LitterClassModel();
            $res=$user->litterclass();
            $this->assign('litterclass',$res);
         //   return dump($res);
			return	$this->fetch('litter_class');
		}
		public	function litterclass_update($id)
		{

				$selectResult1=Db::table('gs_litter_class')
			  	->where('litter_class_id',$id)
			    ->value('litter_class_pid');



			$selectResult=Db::table('gs_litter_class')//热点精选
			->join('gs_litter_classname','gs_litter_classname.litter_class_pid = gs_litter_class.litter_class_pid')
			->where('gs_litter_class.litter_class_id',$id)
			->where('gs_litter_classname.litter_class_pid',$selectResult1)
			->select();

			$this->assign('content',$selectResult);
			$res=Db::table('gs_litter_classname')//热点精选
			->select();
   
		//	$user = new LitterClassModel();
         	//$res=$user->litterclasswhere();
     	    $this->assign('litterclassname',$res);
			return	$this->fetch('litterclass_update');
		}

		public	function litterclass_updatecheck()
		{
			if(request()->isPost())
			{
				$data = input("post.");
		//		return dump($data);
				$user = new LitterClassModel();
            	$res=$user->updatelitterclass($data);
            	$this->redirect(url('litter_class'));
			}
		}

		public	function litterclass_add()
		{
			if(request()->isPost())
			{
				$data = input("post.");
				//return dump($data);
				$user = new LitterClassModel();
            	$res=$user->addlitterclass($data);
            	$this->redirect(url('litter_class'));
			}
			return	$this->fetch('litterclass_add');
		}
}
?>
