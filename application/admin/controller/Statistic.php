<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\DropLitterModel;
use app\admin\model\RecycleLitterModel;
use app\admin\model\OrderModel;
class Statistic extends controller
{
		public	function drop_litter()
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
								    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');	
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
									    return	$this->fetch('drop_litter');	
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
									    return	$this->fetch('drop_litter');										
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
								    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');	
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
									    return	$this->fetch('drop_litter');	
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
									    return	$this->fetch('drop_litter');											
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
									    return	$this->fetch('drop_litter');
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
			return	$this->fetch('drop_litter');
		}
		public	function recycle_litter()
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
									    return	$this->fetch('recycle_litter');
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');											
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
									    return	$this->fetch('recycle_litter');
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
									    return	$this->fetch('recycle_litter');
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');	
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
									    return	$this->fetch('recycle_litter');
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
			return	$this->fetch('recycle_litter');
		}
		public	function sale_data()
		{

			$res=Db::table('gs_order')//热点精选
			->field('user_name as time ,sum(order_total_money) as qq')
			->group("user_name")
		//	->whereTime('recycle_litter_time', 'month')
			->join('gs_user','gs_user.user_id = gs_order.user_id')
			->order('sum(order_total_money) asc')
			->limit(10)
			->select();

			$this->assign('order',$res);
		//	return dump($res);
		//	return	$this->fetch('order');

				$s=Db::table('gs_order_detail')//热点精选
			    ->field('gs_product.product_name,sum(gs_order_detail.product_price) as qq')
				
				->join('gs_product','gs_product.product_id = gs_order_detail.product_id')
				->group('gs_product.product_name')

				//->whereTime('drop_litter_time', 'month')
				//->where('drop_litter_time','between time',['2019-3-1','2019-4-16'])
			    ->select();
			    $this->assign('s',$s);
//return dump($s);

				$s1=Db::table('gs_order')//热点精选
			    ->field('DATE_FORMAT(create_time,"%m-%d") as time,sum(order_total_money) as qq')
				->group('DATE_FORMAT(create_time,"%m-%d")')
				->whereTime('create_time', 'month')
				//->where('drop_litter_time','between time',['2019-3-1','2019-4-16'])
			    ->select();
			    $this->assign('s1',$s1);
		//		return dump($s1);




			return	$this->fetch('sale_data');
		}
		public	function user_analysis()
		{
			return	$this->fetch('user_analysis');
		}
}
?>
