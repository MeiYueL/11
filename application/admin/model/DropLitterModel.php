<?php   
    namespace app\admin\model;  
    use think\Model;  
    class DropLitterModel extends Model
    { 
       protected $table	= 'gs_drop_litter';
     public function findbin()
    {
        return $this->select();
    }
    }

?>
