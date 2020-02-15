<?php   
    namespace app\admin\model;  
    use think\Model;  
    class GovermentModel extends Model
    { 
       protected $table	= 'gs_goverment';
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
	    public function insertcontent($data)
	    {
	        $result = $this->save([
	                'goverment_name'=>$data['govermentname'],
	               	'goverment_password'=>$data['govermentpassword'], 
	                'goverment_email'=>$data['govermentemail']
	            ]);
	        return $result;
	    }
    }  

?>
