<?php   

namespace app\index\model;

use think\Model;

    class OrderModel extends Model
    { 
	    protected $table = 'gs_order';

	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function saveorder($Oid, $sumprice,$s1)
	    {
	        $result = $this->save([
	                'order_core'=>$Oid,
	               	'order_total_money'=>$sumprice,
	               	'user_id'=>$s1,
	               	'order_status'=>'待付款',  
	                'create_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }
      public function updatelitterclass($id,$s)
      {  

              $result =  $this->where('order_id',$id)->update([
                      'order_status'=>'待发货'
                  ]);
                return  $result;
      } 
    }  
?>
