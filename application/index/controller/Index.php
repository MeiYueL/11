<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use app\index\model\ProductModel;
use app\index\model\CartModel;
use app\index\model\ChinaModel;
use app\index\model\ArticleModel;
use app\index\model\FeedbackModel;
use app\index\model\UserModel;
use app\index\model\ApplyModel;
use app\index\model\OrderModel;
class Index extends controller
{
		public function cart_delete($id)
	    {
	       CartModel::destroy($id);
	   return $this->redirect('person',["id"=>34]);
	    }
		public	function index()
		{
				$selectResult=Db::table('gs_article')//热点精选
			    //->field('article_class_name') 
			    //->alias('a')
				->join('gs_article_class','gs_article_class.article_class_id = gs_article.article_class_id')
			//	->join('gs_user','gs_user.user_id = gs_article.user_id')
			    ->order('article_id asc')
			    ->limit(6)
			    ->select();
			    //			return dump($selectResult);
			//	$this->assign('schoolstation_rs',$schoolstation_rs);


			//$user = new ArticleModel();
		//	$selectResult=$user->getUsersByWhere();
       //   	$selectResult = $user->selectall();
        //  	$mod->comments();
			//return dump($selectResult);
        	$this->assign('article',$selectResult);

			//return dump(ROOT_PATH);
			$selectResult1=Db::table('gs_product')//最新商品
			    //->field('article_class_name') 
			    //->alias('a')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
			//	->join('gs_supplier','gs_supplier.supplier_id = gs_product.supplier_id')
			  //  ->where('a.pid',$rs['sid'])
			  //  ->where('a.flid',2)
			    ->select();
			    
        	$this->assign('article1',$selectResult1);





			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}


			return	$this->fetch('index');
		}
		public	function contact_us()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
	        	$selectResult1=Db::table('gs_product')//热点精选

				->join('gs_product_class','gs_product.one_class_id = gs_product_class.product_class_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
				->limit(6)
			//    ->where('one_class_id',$class)
			  //  ->where('a.flid',2)
			    ->select();

	        	$this->assign('goods1',$selectResult1);
			return	$this->fetch('contact_us');
		}
		public	function cooperate()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
	        	if(request()->isPost())
	        	{	        		
					$data = input("post.");
					$user = new ApplyModel();
		            $result = $user->insertcontent($data);
		            return	$this->fetch('cooperate');
	        	}
			return	$this->fetch('cooperate');
		}
		public	function about_us()
		{
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			return	$this->fetch('about_us');
		}
		public	function goods($class='')
		{
			//return dump($class);
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
				$selectResult=Db::table('gs_product')//热点精选

				->join('gs_product_class','gs_product.one_class_id = gs_product_class.product_class_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
				->where('one_class_id',$class)
				->paginate(3,false,
            	['type'=>'BootstrapDetailed']);

        		$this->assign('goods',$selectResult);
        //	return dump($selectResult);

				$selectResult1=Db::table('gs_product')//热点精选

				->join('gs_product_class','gs_product.one_class_id = gs_product_class.product_class_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
			//    ->where('one_class_id',$class)
			  //  ->where('a.flid',2)
			    ->select();

	        	$this->assign('goods1',$selectResult1);
				$this->assign('id',$class);

			return	$this->fetch('goods');
		}
		public	function searchgoods()
		{
			//return dump($class);
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			if(request()->isPost())
			{
				
        $data = input("post.search");
        $where['product_name'] = ['like', '%' . $data . '%'];
 	//return dump($data);
    

				$selectResult=Db::table('gs_product')//热点精选
				->join('gs_product_class','gs_product.one_class_id = gs_product_class.product_class_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
				->where($where)
				->paginate(3,false,
            	['type'=>'BootstrapDetailed']);

        		$this->assign('goods',$selectResult);
        //	return dump($selectResult);

				$selectResult1=Db::table('gs_product')//热点精选

				->join('gs_product_class','gs_product.one_class_id = gs_product_class.product_class_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
			//    ->where('one_class_id',$class)
			  //  ->where('a.flid',2)
			    ->select();

	        	$this->assign('goods1',$selectResult1);
				//$this->assign('id',$class);
			}
			return	$this->fetch('searchgoods');
		}




		public	function news($class)
		{
					    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}



				session('class', $class);

				$this->assign('kind','发布时间');
			    $this->assign('order','升序');
				$this->assign('id',$class);
			   

			     $selectResult1=Db::table('gs_article')
				->join('gs_article_class','gs_article_class.article_class_id = gs_article.article_class_id')
				->where('gs_article.article_class_id',$class)
				->paginate(3,false,
            	['type'=>'BootstrapDetailed']);
            	 $this->assign('news',$selectResult1);
			  //  ->select();
			   // return dump($selectResult1);


			return	$this->fetch('news');
		}
		public	function litter()
		{
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}


				$selectResult1=Db::table('gs_litter_classname')//热点精选
			    ->select();
			    $this->assign('litter',$selectResult1);
			return	$this->fetch('litter');
		}

		public	function paypay($id)
		{
					//$data = input("post.");
			$selectResult=Db::table('gs_order')//热点精选
			->join('gs_user','gs_order.user_id = gs_user.user_id')
			->where('order_id',$id)
			->find();
			
			if($selectResult['user_money']>$selectResult['order_total_money'])
			{
					$user = new OrderModel();
					$res=$user->updatelitterclass($id,$selectResult);

					$user = new UserModel();
					$res=$user->updatelitterclass11($id,$selectResult);
			       return $this->redirect('person',["id"=>34]);
			}
			else
			{
		// echo "<script>alert('您的金额不够!');window.location.href= 'appraiseOK.php';</script>";
           //     echo '<script>alert("您的金额不够");</script>';
				return $this->redirect('person',["id"=>35]);
			}

		}

		public	function litter_class()
		{
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}

			return	$this->fetch('litter_class');
		}
		public	function person($id)
		{
			    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}

				$nameid=Db::table('gs_user')
			  	->where('user_name', $res)
			    ->value('user_id');


			$this->assign('data',$id);
			$selectResult1=Db::table('gs_order')
			->order('create_time desc')//热点精选
			->select();
			$this->assign('order',$selectResult1);

        		$s=Db::table('gs_order_detail')
				->join('gs_product','gs_product.product_id = gs_order_detail.product_id')
				->join('gs_order','gs_order.order_id = gs_order_detail.order_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')

			//	->where('user_name',$res)
			    ->select();
				$this->assign('detail',$s);


				$selectResult1=Db::table('gs_cart')
				->join('gs_product','gs_product.product_id = gs_cart.product_id')
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
				->join('gs_user','gs_user.user_id = gs_cart.user_id')
				->where('user_name',$res)
			    ->select();
			   // return dump($selectResult1);
			     $this->assign('cart',$selectResult1);
			 //    for($i=0;$i<100;$i++)
			 //    {
			 //    	$s[$i]=$i;
			 //    }
				$user=Db::table('gs_user')
				->where('user_name',$res)
			    ->find();
			   $bir=Db::table('gs_user')//热点精选
				->field('year(user_birth) as y ,month(user_birth) as m ,day(user_birth) as d ')
				->where('user_name',$res)
				->find();
				//return dump($bir);
				$this->assign('user',$user);
				$this->assign('bir',$bir);


		        $where['name'] = ['like', '%' . '市' . '%'];
		        $user = new ChinaModel();
		        $selectResult = $user->getUsersByWhere($where);
		        $this->assign('jilian',$selectResult);


        		$drop=Db::table('gs_drop_litter')
				->where('user_id',$nameid)
			    ->select();
				$this->assign('drop',$drop);

        		$re=Db::table('gs_recycle_litter')
				->where('user_id',$nameid)
			    ->select();
				$this->assign('re',$re);

			return $this->fetch('person');
		}

		public	function person_setpic()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			$file = request()->file('image_url');
	        $s=date("Y-m-d-H-i-s");
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'touxiang',$s);
	        if($info){

	        }
	        else
	        {
	            // 上传失败获取错误信息
	            echo $file->getError();
	        }
	        $user = new UserModel();
		    $selectResult = $user->updatelitterclass($s,$res);	
	        return $this->redirect('person',["id"=>32]);
		}
		public	function person_setperson()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			if(request()->post())
        	{
				$param = input('post.');
			//	return dump($param);
				$res=session('username');
				$content = input("post.content");
				$selectResult1=Db::table('gs_user')
			  	->where('user_name', $res)
			    ->value('user_id');

			   // return dump($selectResult1);

				$userModel = new UserModel();
        		$result = $userModel->personupdate($param,$res);
        		//return dump($result);
				return $this->redirect('person',["id"=>32]);
        	}
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
		public	function feedback()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			if(request()->post())
        	{
				//$param = input('post.');
				$res=session('username');
				$content = input("post.content");
				$selectResult1=Db::table('gs_user')
			  	->where('user_name', $res)
			    ->value('user_id');

			   // return dump($selectResult1);

				$userModel = new FeedbackModel();
        		$result = $userModel->insertcontent($content,$selectResult1);
        		//return dump($result);
				return $this->redirect('index');
        	}
			if (!session::get('username')) 
			{
            	$this->error('请先登录。','login/login');
            	//return	$this->fetch('login');
	        } 
	        else 
	        {
				return	$this->fetch('feedback');
	        }
		}


}
?>
