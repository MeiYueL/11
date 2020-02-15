<?php   

namespace app\admin\model;

use think\Model;

    class OrderModel extends Model
    { 
	    protected $table = 'gs_order';

	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function findorder()
	    {
	        return $this->select();
	    }
	    public function insertcontent($content,$selectResult1)
	    {
	        $result = $this->save([
	                'user_id'=>$selectResult1,
	               	'feedback_content'=>$content, 
	                'feddback_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }
	    public function updatelitterclass()
	    {  

	            $result =  $this->where('order_status','待发货')->update([
	                    'order_status'=>'已发货'
	                ]);
	              return  $result;
	    }   
    }  
?>
