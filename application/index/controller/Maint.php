<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\index\model\ProductModel;
use app\index\model\CartModel;
use app\index\model\OrderDetailModel;
use app\index\model\OrderModel;
use app\index\model\CommentModel;
use app\index\model\ReplyModel;
class Maint extends controller
{
		public	function goods_detail($id)
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
        		$selectResult=Db::table('gs_product')//根据id进来的
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
				->join('gs_product_class','gs_product_class.product_class_id = gs_product.one_class_id')
			//	->join('gs_supplier','gs_supplier.supplier_id = gs_product.supplier_id')
			    ->where('gs_product.product_id',$id)
			    ->select();
			    $this->assign('product',$selectResult);
			 //   return dump($selectResult);
			    $selectResult1=Db::table('gs_product')//热点精选
				->join('gs_product_pic','gs_product_pic.product_id = gs_product.product_id')
			//	->join('gs_supplier','gs_supplier.supplier_id = gs_product.supplier_id')
			    ->select();
			    $this->assign('product1',$selectResult1);
		  		return $this->fetch('goods_detail');
		}
		public	function cart()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    //	return dump($res);
			    	$this->assign('url',$url);
	        	}
			    if (!session::get('username')) 
				{
            		$this->error('请先登录。','login/login');
	        	}
	        	else
	        	{
	        		$res=session('username');
	        	} 
			if(request()->post())
        	{
				$param = input('post.');
				$selectResult1=Db::table('gs_user')
			  	->where('user_name',$res)
			    ->value('user_id');

				$userModel = new CartModel();
	        	$hasUser = $userModel->findUserByName1($param,$selectResult1);
		        if(!empty($hasUser))
		        {
		            Db::table('gs_cart')
					->where('user_id', $selectResult1)
					->setInc('product_amount',$param['number']);
		        }
		        else
		        {
        			$result = $userModel->insertcart($param,$selectResult1);
        		}
        	}
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
			 //    $this->assign('s',$s);
			//     return dump($s);
        	//	return dump($selectResult1);
				return	$this->fetch('cart');
	//		return	$this->fetch('cart');
		}
		public	function cart_submit()
		{
			$data = input('post.');
        //  return var_dump($data); 
            $sumprice = 0;

            $shoppro = input('post.teachers/a'); 
          //  $shoppro = request::instance()->post('pid/a');
            if ($shoppro == NULL) {
                echo '<script>alert("未选择任何数据！");</script>';
				return $this->redirect('cart');
            }
                 $rrr=Db::table('gs_order')
				->limit(1)
				->order('order_id desc')
			//	->order('order_id,asc')
			    ->value('order_id');
			    $rrr++;
			 //   return dump($sss);
            $Oid = $this->pro_orderid();
            for ($i = 0; $i < count($shoppro); $i++) {
                $pid = $shoppro[$i];
                $sss=Db::table('gs_cart')
				->join('gs_user','gs_user.user_id = gs_cart.user_id')
				->join('gs_product','gs_product.product_id = gs_cart.product_id')
			//	->join('gs_user','gs_user.user_id = gs_cart.user_id')
				->where('cart_id',$pid)
			    ->find();
            //    return dump($sss); 
                $sumprice= $sumprice+$sss['product_amount']*$sss['product_price'];
                $user = new OrderDetailModel();
                $user->insertcart($Oid, $sss,$rrr);

	       		CartModel::destroy($pid);
    
            }
            $res=session('username');
            $s1=Db::table('gs_user')
		  	->where('user_name',$res)
			->value('user_id');
            $user = new OrderModel();
            $user->saveorder($Oid, $sumprice,$s1);
			return $this->redirect('index/person',["id"=>35]);


			//  return dump('as');
			//	return	$this->fetch('cart');
	//		return	$this->fetch('cart');
		}
		public	function buy()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			return	$this->fetch('buy');
		}
		public function cart_delete($id)
	    {
	       CartModel::destroy($id);
	       return $this->redirect('cart');
	    }
		public	function order()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			return	$this->fetch('order');
		}
		public	function news_detail($id)
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
				//return dump($id);
			    $selectResult=Db::table('gs_article')//根据id进来的
				->join('gs_article_class','gs_article.article_class_id = gs_article_class.article_class_id')
			    ->where('gs_article.article_id',$id)
			    ->find();
			    $this->assign('article',$selectResult);

			    $selectResult1=Db::table('gs_article')//根据id进来的
				->join('gs_article_class','gs_article.article_class_id = gs_article_class.article_class_id')
			    ->select();
			    $this->assign('article1',$selectResult1);


			    $selectResult2=Db::table('gs_article_comment')//根据id进来的
			    ->join('gs_user','gs_article_comment.user_id = gs_user.user_id')
			    ->limit(4)
			    ->order('article_comment_id asc')
				->where('article_id',$id)
			    ->select();
			    $this->assign('reply',$selectResult2);
				//return dump($selectResult2);

			    $selectResult3=Db::table('gs_article_reply')//真正的评论
			    ->join('gs_user','gs_article_reply.user_id = gs_user.user_id')
			    ->join('gs_article_comment','gs_article_comment.article_comment_id = gs_article_reply.article_comment_id')
		//		->where('article_id',$id)
			    ->select();
			    $this->assign('reply1',$selectResult3);
			  //  return dump($selectResult3);
				return	$this->fetch('news_detail');
		}
		public	function add_comment()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			if (!session::get('username')) 
			{
            	$this->error('请先登录。','login/login');
	        }
	        else
	        {
	        	$res=session('username');
	        } 

				$data = input("post.");
				$selectResult2=Db::table('gs_user')//根据id进来的
				->where('user_name',$res)
			    ->value('user_id');
			//return dump($selectResult2);
			$user = new CommentModel();
            $res=$user->insertcontent($data,$selectResult2);
           // $this->assign('litterclass',$res);
         //   return dump($res);
		//	return	$this->fetch('litter_class');
            return $this->redirect('maint/news_detail',["id"=>$data['danjia']]);
		//	return	$this->fetch('news_detail');
		}
		public	function add_replycomment()
		{
						    if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			if (!session::get('username')) 
			{
            	$this->error('请先登录。','login/login');
	        }
	        else
	        {
	        	$res=session('username');
	        } 

				$data = input("post.");
				//return dump($data);
				$selectResult2=Db::table('gs_user')//根据id进来的
				->where('user_name',$res)
			    ->value('user_id');
			//return dump($selectResult2);
			$user = new ReplyModel();
            $res=$user->insertcontent($data,$selectResult2);
           // $this->assign('litterclass',$res);
         //   return dump($res);
		//	return	$this->fetch('litter_class');
            return $this->redirect('maint/news_detail',["id"=>$data['danjia']]);
		//	return	$this->fetch('news_detail');
		}
	public function pro_orderid()
    {
        $s_time = "";
        $s_time .= date("Y");
        $s_time .= date("m");
        $s_time .= date("d");
        $s_time .= date("H");
        $s_time .= date("i");
        $s_time .= date("s");
        $s_time .= mt_rand(10000, 99999);
        return $s_time;
    }
}
?>
