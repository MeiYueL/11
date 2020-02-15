<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use app\admin\model\ProductModel;
use app\admin\model\ProductClassModel;
use app\admin\model\ProductPicModel;
class Goods extends controller
{
		public	function goods()
		{

			$selectResult=Db::table('gs_product')//热点精选
			->join('gs_product_class','gs_product_class.product_class_id = gs_product.one_class_id')
		//	->join('gs_litter_class','gs_litter_class.litter_class_id = gs_litter.two_class_id')
			->select();
		//	return dump($selectResult);
			$this->assign('product',$selectResult);
			return	$this->fetch('goods');
		}

		public	function goods_adds()
		{
			 $file = request()->file('image_url');
	   //     return dump($file);
	        $s=date("Y-m-d-H-i-s");
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'goods',$s);
	        if($info){
	        	//$this->success('文件上传成功：' . $info->getRealPath());
	            // 成功上传后 获取上传信息
	       //     $_POST['image_url'] = '/uploads/image/'.$info->getSaveName();
	       //     $row = DB::name('article')->insert($_POST);
	            //if($row){
	          //      return "<script>alert('添加成功');window.location.href='index?cancel=yes';</script>";
	          //  }
	        }
	        else
	        {
	            // 上传失败获取错误信息
	            echo $file->getError();
	        }
		        if(request()->isPost())
				{
					$data = input("post.");
				//	return dump($data);
					$user = new ProductModel();
	            	$res=$user->insertcontent($data);

				$selectResult1=Db::table('gs_product')
			  	->where('product_name', $data['name'])
			  	->where('product_price',$data['price'])
			    ->value('product_id');


	            	$user = new ProductPicModel();
	            	$res=$user->addlitterclass($selectResult1,$s);
	            	$this->redirect(url('goods'));
				}
		}
		public	function goods_add()
		{
				if(request()->isAjax())
		        {
		          $result = array();
		          $cate = input("param.value");
		          $user = new ProductClassModel();
		          $result = $user->find($cate);
		          return json($result);
		        }
				$litter = new ProductClassModel();
            	$res=$litter->litterclasswhere();
            //	return dump($res);
            	$this->assign('productclass',$res);
			return	$this->fetch('goods_add');
		}
		public function goods_delete($id)
	    {
	       ProductModel::destroy($id);
	       return $this->redirect('goods');
	    }
		public	function goods_update($id)
		{
			$selectResult=Db::table('gs_product')//热点精选
		//	->join('gs_litter_class','gs_litter_class.litter_class_id = gs_litter.two_class_id')
		//	->join('gs_litter_classname','gs_litter_classname.litter_class_pid = gs_litter.one_class_id')
			->where('gs_product.product_id',$id)
			->find();
			$this->assign('product',$selectResult);
		
			$selectResult1=Db::table('gs_product_pic')//热点精选
			->where('gs_product_pic.product_id',$id)
			->find();
		//	return dump($id);
		//	return dump($selectResult1);
			$this->assign('productpic',$selectResult1);

				$litter = new ProductClassModel();
            	$res=$litter->litterclasswhere();
            //	return dump($res);
            	$this->assign('productclass',$res);


				if(request()->isAjax())
		        {
		          $result = array();
		          $cate = input("param.value");
		          $user = new ProductClassModel();
		          $result = $user->find($cate);
		          return json($result);
		        }

				$s=$selectResult['two_class_id'];
				$litter1 = new ProductClassModel();
            	$res1=$litter1->litterclasswhere1($s);
          //  	return dump($s);
            	$this->assign('littetwo',$res1);

			return	$this->fetch('goods_update');
		}
		public	function goods_updatecheck()
		{



			$file = request()->file('image_url');
	        $s=date("Y-m-d-H-i-s");
	        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'goods',$s);
	        if($info){

	        }
	        else
	        {
	            // 上传失败获取错误信息
	            echo $file->getError();
	        }			
			if(request()->isPost())
			{
				$data = input("post.");
				$user = new ProductModel();
			//	return dump($data);
            	$res=$user->updatelitterclass($data);


            	$user = new ProductPicModel();
	            $res=$user->updatelitterclass($data,$s);

            	$this->redirect(url('goods'));
			}
		}

		public	function goods_class()
		{
			$selectResult=Db::table('gs_product_class')//热点精选
			->select();
		//	return dump($selectResult);
			$this->assign('productclass',$selectResult);
			return	$this->fetch('goods_class');
		}
		public	function goodsclass_delete($id)
		{
	       ProductClassModel::destroy($id);
	       return $this->redirect('goods_class');
		}
		public	function goodsclass_add()
		{
			$selectResult=Db::table('gs_product_class')//热点精选
			->where('product_class_pid', '0')
			->select();
		//	return dump($selectResult);
			$this->assign('productclass',$selectResult);


				if(request()->isPost())
				{
					$data = input("post.");
				//	return dump($data);
					$user = new ProductClassModel();
	            	$res=$user->addlitterclass($data);
	            	$this->redirect(url('goods_class'));
				}
			return	$this->fetch('goodsclass_add');
		}
		public	function goodsclass_update($id)
		{
			$selectResult1=Db::table('gs_product_class')//热点精选
			->where('product_class_id', $id)
			->find();
			$this->assign('productclass123',$selectResult1);

			$selectResult=Db::table('gs_product_class')//热点精选
			->where('product_class_pid', '0')
			->select();
		//	return dump($selectResult);
			$this->assign('productclass',$selectResult);
			return	$this->fetch('goodsclass_update');
		}
		public	function goodsclass_updatecheck()
		{
			if(request()->isPost())
			{
				$data = input("post.");
            	$user = new ProductClassModel();
	            $res=$user->updatelitterclass($data);

            	$this->redirect(url('goods_class'));
			}
		}
}
?>
