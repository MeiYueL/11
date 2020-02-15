<?php   

namespace app\index\model;

use think\Model;

    class CartModel extends Model
    { 
	    protected $table = 'gs_cart';

	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function insertcart($param,$selectResult1)
	    {
	        $result = $this->save([
	                'user_id'=>$selectResult1,
	               	'product_id'=>$param['product_id'], 
	                'product_amount'=>$param['number'],
	                'cart_indate'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }
	    public function findUserByName1($param,$selectResult1)
	    {
	        return $this->where('user_id', $selectResult1)->where('product_id', $param['product_id'])->find();
	    }

	    public function updatelitterclass($param,$selectResult1)
	    {  
	            $result =  $this->where('user_id',$selectResult1)->update([
	                'product_amount'=>$param["newtitle"]
	                ]);
	              return  $result;
	    } 
    }  
?>
