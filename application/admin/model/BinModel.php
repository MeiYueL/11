<?php   
    namespace app\admin\model;  
    use think\Model;  
    class BinModel extends Model
    { 
       protected $table	= 'gs_bin';
	     public function findbin()
	    {
	        return $this->select();
	    }
	    
	     public function findcc()
	    {
	        return $this->column('bin_status');
	    }

    	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function getUsersByWhere()
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
    }  

?>
