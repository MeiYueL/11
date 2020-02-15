<?php
namespace app\index\controller;
use think\Session;
use think\Db;
use think\Request;
use think\Controller;
use app\index\model\UserModel;
use app\index\model\ChinaModel;
use app\index\model\CompanyModel;
use app\index\model\GovermentModel;
class Login extends controller
{
	public	function register_hezuo()
	{

	        			if(request()->isPost())
						{
							$file = request()->file('image_url');
					        $s=date("Y-m-d-H-i-s");
					        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'logo',$s);
					        if($info){

					        }
					        else
					        {
					            // 上传失败获取错误信息
					            echo $file->getError();
					        }

							$data = input("post.");
							if($data['type1']=='公司')
							{
								$user = new CompanyModel();
				            	$res=$user->addArticle($data,$s);
			          	  	}
			          	  	else
			          	  	{
			          	  		$user = new GovermentModel();
				            	$res=$user->addArticle($data,$s);		
			          	  	}
							//return dump($data);
			            	$this->redirect(url('login'));
						}
		return	$this->fetch('register_hezuo');

	}
		public	function login()
		{	  
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}

				$request = Request::instance();
	        	$s=$request->path();
	        //	return dump($id);
			if(request()->isAjax())
        	{
				$userName = input("param.user_name");
			    $password = input("param.password");
			    $sort = input("param.sort");
					//return json(msg(-3, '', '用户不存在'));
			    if($sort=='普通用户')
			    {
			        $result = $this->validate(compact('userName','password'), 'UserValidate');
			        if(true !== $result){
			            return json(msg(-1, '', $result));
			        }
			        $userModel = new UserModel();
			        $hasUser = $userModel->findUserByName($userName);
			      //  return json(msg(-3, '', '用户不存在'));
			      //  dump($hasUser);
			     //   die();
			        if(empty($hasUser))
			        {
			            return json(msg(-3, '', '用户不存在'));
			        }
			        if($password != $hasUser['user_pswd']){
			            return json(msg(-4, '', '密码错误'));
			        }
			        session('type', '普通用户');
			       session('username', $userName);
			        return json(msg(1, url('index/index'), '登录成功'));
			     }
			     else if($sort=='公司')
			     {
			        $result = $this->validate(compact('userName','password'), 'UserValidate');
			        if(true !== $result){
			            return json(msg(-1, '', $result));
			        }
			        $userModel = new CompanyModel();
			        $hasUser = $userModel->findUserByName($userName);
			        if(empty($hasUser))
			        {
			            return json(msg(-3, '', '用户不存在'));
			        }
			        if($password != $hasUser['company_password']){
			            return json(msg(-4, '', '密码错误'));
			        }
			          session('type', '公司');
			       session('username', $userName);
			        return json(msg(1, url('otheruser/company'), '登录成功'));
			     }
			     else
			     {
			        $result = $this->validate(compact('userName','password'), 'UserValidate');
			        if(true !== $result){
			            return json(msg(-1, '', $result));
			        }
			        $userModel = new GovermentModel();
			        $hasUser = $userModel->findUserByName($userName);
			        if(empty($hasUser))
			        {
			            return json(msg(-3, '', '用户不存在'));
			        }
			        if($password != $hasUser['goverment_password']){
			            return json(msg(-4, '', '密码错误'));
			        }
			        session('type', '政府');
			        session('username', $userName);
			        return json(msg(1, url('otheruser/goverment'), '登录成功'));
			     }
        	}
			return	$this->fetch('login');
		}
		public	function register()
		{
						    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
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

		        $where['name'] = ['like', '%' . '市' . '%'];
		        $user = new ChinaModel();
		        $selectResult = $user->getUsersByWhere($where);
		        $this->assign('jilian',$selectResult);
		        return view('register');
		}
	public function kankan1()
    {
    				    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
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
		public	function registeradd()
		{

			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
	        $param = input('post.');
	       // $teachers = input('post.teachers/a'); 
	       // $teachers=implode(',',$teachers);
	        //return var_dump(date("Y-m-d H:i:s")); 
	       // return var_dump($param);
	       $user = new ChinaModel();
            $result = $user->exchange($param);

            $s=$result[0]['name'];
          	//$result=$result.$user->exchange1($param);
           // $result=$result->toArray();
            $result = $user->exchange1($param);
			$s=$s.$result[0]['name'];
			$result = $user->exchange2($param);
			$s=$s.$result[0]['name'];
			$s=$s.$param['address'];
           // return dump($param);
	        $article = new UserModel();
	        $flag = $article->addArticle($param,$s);
        	echo '<script>alert("注册成功");</script>';
	        $this->redirect(url('login'));
		}
	public function logOut()
    {

        session('username', null);
        $this->redirect(url('index/index'));
    }
}
?>
