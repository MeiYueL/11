<?php   
    namespace app\admin\model;  
    use think\Model;  
    class UserModel1 extends Model
    { 

       protected $table	= 'gs_user';
      public function findUserByName($name)
      {
          return $this->where('admin_name', $name)->find();
      }
     public function chaxun()
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
      public function updatelitterclass($id)
      {  

              $result =  $this->where('user_id',$id)->update([
                      'user_status'=>0
                  ]);
                return  $result;
      }   
      public function updatelitterclass1($id)
      {  

              $result =  $this->where('user_id',$id)->update([
                      'user_status'=>1
                  ]);
                return  $result;
      }  
      public function staffadd($param,$s)
      {
          $result = $this->save([
                  'user_name'=>$param['username'],
                  'user_pswd'=>$param['userpswd'], 
                  'user_truename'=>$param['truename'],
                  'user_tel'=>$param['phonenumber'],
                  'user_province'=>$s[0], 
                  'user_city'=>$s[1],
                  'user_area'=>$s[2],
                  'user_community'=>$param['shequ'],
                  'user_address'=>$param['address'],
                  'user_type'=>4,
                  'register_time'=>date("Y-m-d H:i:s")
              ]);
          return $result;
      }
    }  
?>
