<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\admin\model\BinModel;
use app\admin\model\OrderModel;
use app\admin\model\ApplyModel;
class Other extends controller
{
		public	function index()
		{ 

			return	$this->fetch('index');
		}
		public	function bin()
		{
			$user = new BinModel();
			$res=$user->findbin();
			//return dump($res);
			$this->assign('bin',$res);

			$sss=$user->findcc();
			$this->assign('bin11',$sss);
		//	return dump($sss);
			return	$this->fetch('bin');
		}
		public	function order()
		{
			$user = new OrderModel();
			$res=$user->findorder();
			$this->assign('order',$res);
			return	$this->fetch('order');
		}
		public	function fahuo()
		{
			$user = new OrderModel();
			$res=$user->updatelitterclass();
			//$this->assign('order',$res);
			        $this->redirect(url('order'));
		}
		public	function apply()
		{
			$selectResult=Db::table('gs_apply')//热点精选
			->where('apply_status',0)
			->select();
			$this->assign('order',$selectResult);
			return	$this->fetch('apply');
		}
		public	function apply1($s)
		{
			$user = new ApplyModel();
			$res=$user->updatelitterclass1($s);
			$selectResult=Db::table('gs_apply')//热点精选
			->where('apply_status',0)
			->select();
			$this->assign('order',$selectResult);
			return	$this->fetch('apply');
		}
		public	function apply2($s)
		{
			$user = new ApplyModel();
			$res=$user->updatelitterclass2($s);
			$selectResult=Db::table('gs_apply')//热点精选
			->where('apply_status',0)
			->select();
			$this->assign('order',$selectResult);
			return	$this->fetch('apply');
		}
		public	function order_detail()
		{
			return	$this->fetch('order_detail');
		}
}
?>
