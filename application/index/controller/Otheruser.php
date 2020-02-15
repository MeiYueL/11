<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;
use app\index\model\CompanyModel;
use app\index\model\GovermentModel;
use app\index\model\ChinaModel;
use think\Db;
class Otheruser extends controller
{
		public	function goverment()
		{
				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			$userName=session('govermentname');
			 $userModel = new GovermentModel();
			 $hasUser = $userModel->findUserByName($res);
			$this->assign('goverment',$hasUser);
		//	return dump($hasUser);

			if(request()->post())
        	{
				$param = input('post.');
			//	return dump($param);
				$res=session('username');
			//	$content = input("post.content");
				$selectResult1=Db::table('gs_goverment')
			  	->where('goverment_name', $res)
			    ->value('goverment_id');

			   // return dump($selectResult1);

				$userModel = new GovermentModel();
        		$result = $userModel->personupdate($param,$selectResult1);
        		//return dump($result);
				return $this->redirect('goverment');
        	}


			return	$this->fetch('goverment');
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
		public	function goverment_chart()
		{

				        if(request()->isPost())
						{
							$data = input("post.");
					//		return dump($data);
							if($data["shuju"]=='投放')
							{
								if($data["one"]=='时间')
								{
									//if($data["two"]=='sx')
									$s=Db::table('gs_drop_litter')//热点精选
								    ->field('DATE_FORMAT(drop_litter_time,"%m-%d") as time,sum(drop_litter_weight) as qq')
									->group('DATE_FORMAT(drop_litter_time,"%m-%d")')
									//->whereTime('drop_litter_time', 'month')
									->where('drop_litter_region',$data["two"])
								    ->select();
								    $this->assign('s',$s);
								     $this->assign('data',$data);
								    return	$this->fetch('goverment_chart');
								}
								else if($data["one"]=='地点')
								{
									if($data["two"]=='所有时间')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										//->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');	
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'week')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');	
									}
									else
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'year')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');										
									}
								}
								else
								{
									if($data["two"]=='所有时间')
									{
										
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('user_name as time,sum(drop_litter_weight) as qq')
									    ->group("user_name")
										->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('user_name as time ,sum(drop_litter_weight) as qq')
									    ->group("user_name")
									    ->whereTime('drop_litter_time', 'month')
										->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('user_name as time ,sum(drop_litter_weight) as qq')
									    ->group("user_name")
									    ->whereTime('drop_litter_time', 'week')
										->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('user_name as time ,sum(drop_litter_weight) as qq')
									    ->group("user_name")
									    ->whereTime('drop_litter_time', 'year')
										->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
								}

							}
							else
							{

								if($data["one"]=='时间')
								{
									//if($data["two"]=='sx')
									$s=Db::table('gs_recycle_litter')//热点精选
								    ->field('DATE_FORMAT(recycle_litter_time,"%m-%d") as time,sum(recycle_litter_weight) as qq')
									->group('DATE_FORMAT(recycle_litter_time,"%m-%d")')
									//->whereTime('drop_litter_time', 'month')
									->where('recycle_litter_region',$data["two"])
								    ->select();
								    $this->assign('s',$s);
								    $this->assign('data',$data);
								    return	$this->fetch('goverment_chart');
								}
								else if($data["one"]=='地点')
								{
									if($data["two"]=='所有时间')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										//->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');	
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'week')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');	
									}
									else
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'year')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');											
									}
								}
								else
								{
									if($data["two"]=='所有时间')
									{
										
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('staff_name as time,sum(recycle_litter_weight) as qq')
									    ->group("staff_name")
										->join('gs_staff','gs_staff.staff_id = gs_recycle_litter.staff_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('staff_name as time ,sum(recycle_litter_weight) as qq')
									    ->group("staff_name")
									    ->whereTime('recycle_litter_time', 'month')
										->join('gs_staff','gs_staff.staff_id = gs_recycle_litter.staff_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('staff_name as time ,sum(recycle_litter_weight) as qq')
									    ->group("staff_name")
									    ->whereTime('recycle_litter_time', 'week')
										->join('gs_staff','gs_staff.staff_id = gs_recycle_litter.staff_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
									else
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('staff_name as time ,sum(recycle_litter_weight) as qq')
									    ->group("staff_name")
									    ->whereTime('recycle_litter_time', 'year')
										->join('gs_staff','gs_staff.staff_id = gs_recycle_litter.staff_id')
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart');
									}
								}

							}

						}



				$selectResult1=Db::table('gs_drop_litter')//热点精选
			    ->field('drop_litter_region,sum(drop_litter_weight) as qq')
			    ->group("drop_litter_region")
				//->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
		//		->join('gs_user','gs_user.user_id = gs_article.user_id')
			  //  ->where('a.pid',$rs['sid'])
			  //  ->where('a.flid',2)
			    ->select();
				$this->assign('info',$selectResult1);



				$selectResult=Db::table('gs_drop_litter')//热点精选
			    ->field('user_name,sum(drop_litter_weight) as qq')
			    ->group("user_name")
				->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
			//	->whereTime('drop_litter_time', 'month')
				//->where('drop_litter_time','between time',['2019-3-1','2019-4-16'])
			    ->select();
				$this->assign('userkind',$selectResult);
	//return dump($selectResult);


//$result = Db::query('SELECT DATE_FORMAT(drop_litter_time,"%Y-%m-%d"), sum(drop_litter_weight)
//FROM gs_drop_litter
//GROUP BY(DATE_FORMAT(drop_litter_time,"%Y-%m-%d"))');

				$s=Db::table('gs_drop_litter')//热点精选
			    ->field('DATE_FORMAT(drop_litter_time,"%m-%d") as time,sum(drop_litter_weight) as qq')
				->group('DATE_FORMAT(drop_litter_time,"%m-%d")')
				//->whereTime('drop_litter_time', 'month')
				//->where('drop_litter_time','between time',['2019-3-1','2019-4-16'])
			    ->select();


	 //return dump($s);

			/*    $s1=Db::table('gs_drop_litter')//热点精选
			  //  ->field('drop_litter_time,sum(drop_litter_weight) as qq')
			    ->group("drop_litter_time")
				->join('gs_user','gs_user.user_id = gs_drop_litter.user_id')
				->whereTime('drop_litter_time', 'month')
				//->where('drop_litter_time','between time',['2019-3-1','2019-4-16'])
			    ->count();
			   

			    for($i=0;$i<$s1;$i++)
			    {
			    	$time=strtotime($s[$i]['drop_litter_time']);
			    	$s[$i]['drop_litter_time']=date("m-d",$time);

			    }*/

			//	 return dump($s[2]['drop_litter_time']);
			    $data['shuju']='投放';
			    $data['one']='时间';
			    $data['two']='绍兴市';
				$s=Db::table('gs_drop_litter')//热点精选
				->field('DATE_FORMAT(drop_litter_time,"%m-%d") as time,sum(drop_litter_weight) as qq')
				->group('DATE_FORMAT(drop_litter_time,"%m-%d")')
									//->whereTime('drop_litter_time', 'month')
				->where('drop_litter_region',"绍兴市")
				->select();
				$this->assign('s',$s);
				$this->assign('data',$data);
								   // return	$this->fetch('drop_litter');
			return	$this->fetch('goverment_chart');
		}
		public	function goverment_chart1()
		{
      if(request()->isPost())
						{
							$data = input("post.");
					//		return dump($data);
							if($data["shuju"]=='投放')
							{
								if($data["one"]=='地点')
								{
									if($data["two"]=='所有时间')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										//->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');
									}
									else if($data["two"]=='所有时间')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'week')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
									else
									{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
										->group('drop_litter_region')
										->whereTime('drop_litter_time', 'year')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');											
									}
								}
								else if($data["one"]=='垃圾分类')
								{
										$s=Db::table('gs_drop_litter')//热点精选
									    ->field('bin_class as time,sum(drop_litter_weight) as qq')
										->group('bin_class')
										->join('gs_bin','gs_bin.bin_id = gs_drop_litter.bin_id')
										//->whereTime('drop_litter_time', 'month')
										->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');
								}
							}
							else
							{
								if($data["one"]=='地点')
								{
									if($data["two"]=='所有时间')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										//->whereTime('drop_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');
									}
									else if($data["two"]=='近一个月')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'month')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
									else if($data["two"]=='近一周')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'week')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
									else if($data["two"]=='近一年')
									{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('recycle_litter_region as time,sum(recycle_litter_weight) as qq')
										->group('recycle_litter_region')
										->whereTime('recycle_litter_time', 'year')
										//->where('drop_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');	
									}
								    return	$this->fetch('drop_litter');
								}
								else if($data["one"]=='垃圾分类')
								{
										$s=Db::table('gs_recycle_litter')//热点精选
									    ->field('bin_class as time,sum(recycle_litter_weight) as qq')
										->group('bin_class')
										->join('gs_bin','gs_bin.bin_id = gs_recycle_litter.bin_id')
										//->whereTime('drop_litter_time', 'month')
										->where('recycle_litter_region',$data["two"])
									    ->select();
									    $this->assign('s',$s);
									    $this->assign('data',$data);
									    return	$this->fetch('goverment_chart1');
								}
							}

						}

			    $data['shuju']='投放';
			    $data['one']='地点';
			    $data['two']='所有时间';
				$s=Db::table('gs_drop_litter')//热点精选
				->field('drop_litter_region as time,sum(drop_litter_weight) as qq')
				->group('drop_litter_region')
				//->whereTime('drop_litter_time', 'month')
				//->where('drop_litter_region',$data["two"])
				->select();
				$this->assign('s',$s);
				$this->assign('data',$data);
								   // return	$this->fetch('drop_litter');
			return	$this->fetch('goverment_chart1');
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
			if($file!='')
	        {
		        $s=date("Y-m-d-H-i-s");
		        $info = $file->move(ROOT_PATH . 'public' . DS . 'static'. DS .'upload'. DS .'logo',$s);
		        if($info){

		        }
		        else
		        {
		            // 上传失败获取错误信息
		            echo $file->getError();
		        }
		        $user = new CompanyModel();
			    $selectResult = $user->updatelitterclass($s,$res);	
			}
	        return $this->redirect('company');
		}

		public	function company()
		{

				if (session::get('username')) 
				{
					$res=session('username');
					$url=Db::table('gs_user')//最新商品
					->where('user_name',$res)
			    	->find();
			    	$this->assign('url',$url);
	        	}
			$userName=session('companyname');
			 $userModel = new CompanyModel();
			 $hasUser = $userModel->findUserByName($res);
		//	 return dump($userName);
			$this->assign('company',$hasUser);





				if(request()->isAjax())
		        {
		          $result = array();
		          $cate = input("param.value");
		          $user = new ChinaModel();
		          $result = $user->find($cate);
		            return json($result);
		        }

		        $where['name'] = ['like', '%' . '市' . '%'];
		        $user = new ChinaModel();
		        $selectResult = $user->getUsersByWhere($where);
		        $this->assign('jilian',$selectResult);
			return	$this->fetch('company');
		}
		public	function company_chart()
		{
			return	$this->fetch('company_chart');
		}
		public	function company_addstaff()
		{
			return	$this->fetch('company_addstaff');
		}
		public	function company_updatestaff()
		{
			return	$this->fetch('company_updatestaff');
		}
		public	function company_update()
		{
			return	$this->fetch('company_update');
		}

}
?>
