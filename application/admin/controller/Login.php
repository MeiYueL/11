<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\UserModel;
class Login extends controller
{
		public	function login()
		{	  
			if(request()->isAjax())
        	{
        		//return json(msg(-3, '', '用户不存在'));
				$userName = input("param.user_name");
			    $password = input("param.password");
			//  $sort = input("param.sort");
			//	return json(msg(-3, '', '用户不存在'));

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
			        if($password != $hasUser['admin_password']){
			            return json(msg(-4, '', '密码错误'));
			        }
			 //       session('type', '普通用户');
			       session('adminname', $userName);
			        return json(msg(1, url('user/user'), '登录成功'));
			    
        	}
			return	$this->fetch('login');
		}
			public function logOut()
    	{
        session('adminname', null);
        $this->redirect(url('login/login'));
    	}
}
?>
