<?php   

namespace app\index\model;

use think\Model;

    class CompanyModel extends Model
    { 
	    protected $table = 'gs_company';

	    public function findUserByName($name)
	    {
	        return $this->where('company_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function addArticle($param,$s)
	    {
	    	$s='/upload/logo/'.$s.'.jpg';
	        $result = $this->save([
	                'company_name'=>$param['name'],
	               	'company_password'=>$param['password'], 
	                'company_contact'=>$param['con'],
	                'company_contact_sex'=>$param['sex'],
	                'company_contact_tel'=>$param['tel'],
	                'company_address'=>$param['address'],
	                'company_service'=>$param['content'],
	                'company_logo'=>$s,
	                'company_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }
	    public function updatelitterclass($s,$res)
	    {  
				$s='/upload/logo/'.$s.'.jpg';
	            $result =  $this->where('company_name',$res)->update([
	                'company_logo'=>$s
	                ]);
	              return  $result;
	    }
    }  
?>
