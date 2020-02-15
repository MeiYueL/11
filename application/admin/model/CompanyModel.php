<?php   
    namespace app\admin\model;  
    use think\Model;  
    class CompanyModel extends Model
    { 
       protected $table	= 'gs_company';
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
	                'company_name'=>$data['companyname'],
	               	'company_password'=>$data['companypassword'], 
	                'company_email'=>$data['companyemail']
	            ]);
	        return $result;
	    }
    }  

?>
