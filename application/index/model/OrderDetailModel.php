<?php   

namespace app\index\model;

use think\Model;

    class OrderDetailModel extends Model
    { 
	    protected $table = 'gs_order_detail';

	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function insertcart($Oid, $sss,$rrr)
	    {
	        $result = $this->save([
	                'order_id'=>$rrr,
	               	'product_id'=>$sss['product_id'], 
	                'product_amount'=>$sss['product_amount']
	            ]);
	        return $result;
	    }

    }  
?>
