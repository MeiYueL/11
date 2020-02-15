<?php   
    namespace app\admin\model;  
    use think\Model;  
    class ProductClassModel extends Model
    { 
       protected $table	= 'gs_product_class';
      public function find($cate)
    {
        return $this->where('product_class_pid','eq',$cate)->select();
    }
	     public function litterclass()
	    {
	        return $this->select();
	    }

	    public function litterclasswhere()
	    {
	        return $this->where('product_class_pid','eq','0')->select();
	    }
	    public function litterclasswhere1($s)
	    {
	        return $this->where('product_class_id','eq',$s)->select();
	    }
	     public function addlitterclass($data)
	    {
	        $result = $this->save([
	                'product_class_pid'=>$data['type1'],
	               	'product_class_name'=>$data['classname']
	            ]);
	        return $result;
	    }
	    
	    public function updatelitterclass($param)
	    {  

	            $result =  $this->where('product_class_id',$param['id'])->update([
	                'product_class_pid'=>$param['type1'],
	               	'product_class_name'=>$param['classname']
	                ]);
	              return  $result;
	    }   
    }  

?>
