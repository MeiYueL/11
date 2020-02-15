<?php   
    namespace app\admin\model;  
    use think\Model;  
    class UserModel extends Model
    { 

       protected $table	= 'gs_admin';
      public function findUserByName($name)
      {
          return $this->where('admin_name', $name)->find();
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
    }  
?>
