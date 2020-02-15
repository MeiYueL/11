<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\UserModel1;
use app\admin\model\CompanyModel;
use app\admin\model\GovermentModel;
use app\index\model\ChinaModel;
class User extends controller
{
		public	function user()
		{
			$user = new UserModel1();
            $res=$user->chaxun();
            $this->assign('user',$res);
        //    return dump($res);
			return	$this->fetch('user');
		}

		public	function dongjie($id)
		{
					$data = input("post.");
					$user = new UserModel1();
				//	return dump($data);
			        $res=$user->updatelitterclass($id);
			        $this->redirect(url('user'));
		}

		public	function jiedong($id)
		{
					$data = input("post.");
					$user = new UserModel1();
				//	return dump($data);
			        $res=$user->updatelitterclass1($id);
			        $this->redirect(url('user'));
		}
		public	function goverment_delete($id)
		{
	       GovermentModel::destroy($id);
	       return $this->redirect('goverment');
		}
		public	function staff()
		{
			$selectResult=Db::table('gs_user')//热点精选
		//	->join('gs_staff','gs_staff.company_id = gs_company.company_id')
			->where('user_type',4)
			->select();
		//	 return dump($selectResult);
			$this->assign('staff',$selectResult);
			return	$this->fetch('staff');
		}
		public function kankan1()
    {

        if(request()->isAjax())
        {
       //     return json('asd');
          //  $this->ajaxReturn('asd',"JSON");
          //  return view('jilian');
       //      return var_dump('123');
          $result = array();
          $where = input("param.value");
        //  $cate =$_POST['type'];
          $user = new ChinaModel();
          $result = $user->find($where);
          return json($result);
        //  $this->ajaxReturn($result,"JSON");
        }
    }
		public	function staffadd()
		{


				if(request()->isAjax())
		        {
		       //     return json('asd');
		          //  $this->ajaxReturn('asd',"JSON");
		          //  return view('jilian');
		       //      return var_dump('123');
		          $result = array();
		          $cate = input("param.value");
		        //  $cate =$_POST['type'];
		          $user = new ChinaModel();
		          $result = $user->find($cate);

		            // return var_dump($result);
		          //dump($result);
		            return json($result);
		        //  $this->ajaxReturn($result,"JSON");
		        }

				if(request()->isPost())
				{
					$param = input("post.");
					
	       $user = new ChinaModel();
            $result = $user->exchange($param);

            $s[0]=$result[0]['name'];
          	//$result=$result.$user->exchange1($param);
           // $result=$result->toArray();
            $result = $user->exchange1($param);
			$s[1]=$result[0]['name'];
			$result = $user->exchange2($param);
			$s[2]=$result[0]['name'];

		//	return dump($param);
					$user = new UserModel1();
	            	$res=$user->staffadd($param,$s);

	            	$this->redirect(url('staff'));
				}

		        $where['name'] = ['like', '%' . '市' . '%'];
		        $user = new ChinaModel();
		        $selectResult = $user->getUsersByWhere($where);
		        $this->assign('jilian',$selectResult);
		  //      return view('register');
			return	$this->fetch('staffadd');
		}
		public	function goverment()
		{
			$selectResult=Db::table('gs_goverment')//热点精选
		//	->join('gs_staff','gs_staff.company_id = gs_company.company_id')
			->select();
		//	 return dump($selectResult);
			$this->assign('goverment',$selectResult);
			return	$this->fetch('goverment');
		}
		public	function company()
		{
			$selectResult=Db::table('gs_company')//热点精选
			->select();
			$this->assign('company',$selectResult);
			return	$this->fetch('company');
		}
		public	function company_add()
		{
			if(request()->isPost())
				{
					$data = input("post.");
				//	return dump($data);
					$user = new CompanyModel();
	            	$res=$user->insertcontent($data);

	            	$this->redirect(url('company'));
				}
			return	$this->fetch('company_add');
		}
		public	function goverment_add()
		{
				if(request()->isPost())
				{
					$data = input("post.");
				//	return dump($data);
					$user = new GovermentModel();
	            	$res=$user->insertcontent($data);
	            	$this->redirect(url('goverment'));
				}
			return	$this->fetch('goverment_add');
		}
}
?>
