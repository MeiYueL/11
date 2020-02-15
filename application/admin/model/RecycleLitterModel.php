<?php   
    namespace app\admin\model;  
    use think\Model;  
    class RecycleLitterModel extends Model
    { 
       protected $table	= 'gs_recycle_litter';
     public function findre()
    {
        return $this->select();
    }
    }

?>
