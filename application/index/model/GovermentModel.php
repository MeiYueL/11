<?php   

namespace app\index\model;

use think\Model;

    class GovermentModel extends Model
    { 
	    protected $table = 'gs_goverment';

	    public function findUserByName($name)
	    {
	        return $this->where('goverment_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function addArticle($param,$s)
	    {
	    	$s='/upload/logo/'.$s.'.jpg';
	        $result = $this->save([
	                'goverment_name'=>$param['name'],
	               	'goverment_password'=>$param['password'], 
	                'goverment_contact'=>$param['con'],
	                'goverment_contact_sex'=>$param['sex'],
	                'goverment_contact_tel'=>$param['tel'],
	                'goverment_address'=>$param['address'],
	               'goverment_logo'=>$s,
	                'goverment_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }
	    	    public function personupdate($param,$res)
	    {  
	            $result =  $this->where('goverment_id',$res)->update([
	                'goverment_name'=>$param['quancheng'],
	                'goverment_contact_sex'=>$param['sex'],
	                'goverment_address'=>$param['address'],
	                'goverment_contact_tel'=>$param['tel']

	                ]);
	              return  $result;
	    }  

    }  
?>
