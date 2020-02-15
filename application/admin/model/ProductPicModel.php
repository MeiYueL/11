<?php   
    namespace app\admin\model;  
    use think\Model;  
    class ProductPicModel extends Model
    { 
       protected $table	= 'gs_product_pic';
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
	     public function addlitterclass($data,$s)
	    {
	    	$s='/upload/goods/'.$s.'.jpg';
	        $result = $this->save([
	                'product_id'=>$data,
	               	'product_pic_url'=>$s
	            ]);
	        return $result;
	    }
	    
	    public function updatelitterclass($param,$s)
	    {  
				$s='/upload/goods/'.$s.'.jpg';
	            $result =  $this->where('product_id',$param['id'])->update([
	                    'product_pic_url'=>$s
	                ]);
	              return  $result;
	    }   
    }  

?>
