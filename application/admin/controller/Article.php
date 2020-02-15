<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

use think\Request;
use app\index\model\ChinaModel;
use app\admin\model\ArticleModel;
use app\admin\model\ArticleClassModel;
class Article extends controller
{
		public	function article()
		{
			$selectResult=Db::table('gs_article')//热点精选
			->join('gs_article_class','gs_article.article_class_id = gs_article_class.article_class_id')
			->select();
			//return dump($selectResult);
			$this->assign('article',$selectResult);
		//	return	$this->fetch('goods');
			return	$this->fetch('article');
		}
		public	function article_add()
		{
			$where['name'] = ['like', '%' . '市' . '%'];
		    $user = new ChinaModel();
		    $selectResult = $user->getUsersByWhere($where);
		    $this->assign('jilian',$selectResult);

    		$leibie = new ArticleClassModel();
		    $selectResult1 = $leibie->litterclass();
		    $this->assign('chuchu',$selectResult1);
			return	$this->fetch('article_add');
		}

		public function article_delete($id)
	    {
	       ArticleModel::destroy($id);
	       return $this->redirect('article');
	    }
		

		public	function article_update($id)
		{
			$selectResult=Db::table('gs_article')//热点精选
			->where('gs_article.article_id',$id)
			->find();
			$this->assign('article',$selectResult);
			//return dump($selectResult);


			$where['name'] = ['like', '%' . '市' . '%'];
		    $user = new ChinaModel();
		    $selectResult = $user->getUsersByWhere($where);
		    $this->assign('jilian',$selectResult);

    		$leibie = new ArticleClassModel();
		    $selectResult1 = $leibie->litterclass();
		    $this->assign('chuchu',$selectResult1);


			return	$this->fetch('article_update');
		}
		public function save(Request $request)
	    {
	        $file = request()->file('image_url');
	        if($file!='')
	        {
		     //   return dump($file);
		        $s=date("Y-m-d-H-i-s");
		        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'article',$s);
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
						//	return dump($data);
							$user = new ArticleModel();
			            	$res=$user->insertcontent($data,$s);
			            	$this->redirect(url('article'));
						}
			}
			else
			{
    //        echo "<script>alert('支付成功！');</script>";
  //          echo "<script language=JavaScript>parent.location.reload();</script>";
    echo "<script>alert('请添加封面图片');window.location.href='article_add';</script>";

//  window.location.href="http://baidu.com"
			//	echo "<script>alert('请添加封面图片');</script>";
			//	$this->redirect(url('article_add'));
			}
	    }
		public	function article_updatecheck(Request $request)
		{
	        $file = request()->file('image_url');
	     //   return dump($file);
	         if($file!='')
	        {
		        $s=date("Y-m-d-H-i-s");
		        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'article',$s);
		        if($info)
		        {
		        }
		        else
		        {
		            // 上传失败获取错误信息
		            echo $file->getError();
		        }
				if(request()->isPost())
				{
					$data = input("post.");
					$user = new ArticleModel();
				//	return dump($data);
			        $res=$user->updatelitterclass($data,$s);
			        $this->redirect(url('article'));
				}
			}
			else
			{
				echo "<script>alert('请添加封面图片');</script>";
			}
		}
   
}
?>
