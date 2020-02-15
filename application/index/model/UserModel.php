<?php   

namespace app\index\model;

use think\Model;

    class UserModel extends Model
    { 
	    protected $table = 'gs_user';

	    public function findUserByName($name)
	    {
	        return $this->where('user_name', $name)->find();
	    }
	   public function getUsersByWhere()
	    {
	        return $this->select();
	    }
	    public function addArticle($param,$address)
	    {
	    	if($param['sort']=='普通用户')
	    		$s='1';
	    	else if($param['sort']=='社区管理员')
	    		$s='2';
	    	else if($param['sort']=='回收人员')
	    		$s='3';
	    	else 
	    		$s='4';
	        $result = $this->save([
	                'user_name'=>$param['username'],
	               	'user_pswd'=>$param['userpswd'], 
	                'user_truename'=>$param['truename'],
	                'user_tel'=>$param['phonenumber'],
	                'user_type'=>$s,
	                'user_address'=>$address,
	                'register_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }

	    public function updatelitterclass($s,$res)
	    {  
				$s='/upload/touxiang/'.$s.'.jpg';
	            $result =  $this->where('user_name',$res)->update([
	                'user_touxiang'=>$s
	                ]);
	              return  $result;
	    }
	    public function personupdate($param,$res)
	    {  
	            $result =  $this->where('user_name',$res)->update([
	                'user_name'=>$param['user_name'],
	                'user_pswd'=>$param['user_pswd'],
	                'user_truename'=>$param['user_truename'],
	                'user_IDcard'=>$param['user_IDcard'],
	                'user_tel'=>$param['user_tel'],
	                'user_email'=>$param['user_email'],
	                'user_sex'=>$param['sex'],
	                'user_community'=>$param['user_community']
	                ]);
	              return  $result;
	    }  
      public function updatelitterclass11($id,$s)
      {  

              $result =  $this->where('user_id',$s['user_id'])->update([
                      'user_money'=>$s['user_money']-$s['order_total_money']
                  ]);
                return  $result;
      } 
    }  
?>
