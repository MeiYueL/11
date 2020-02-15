<?php   
    namespace app\admin\model;  
    use think\Model;  
    class ProductModel extends Model
    { 
       protected $table	= 'gs_product';
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
	                'product_name'=>$data["name"],
	               	'one_class_id'=>$data["type1"], 
	                'two_class_id'=>$data["lables"],
	                'product_price'=>$data["price"],
	               	'product_infor'=>$data["content"]
	            ]);
	        return $result;
	    }

	    public function updatelitterclass($param)
	    {  

	            $result =  $this->where('product_id',$param['id'])->update([
	                    'product_name'=>$param['productname'],
	                    'one_class_id'=>$param['type1'],
	                    'two_class_id'=>$param['lables'],
	                    'product_price'=>$param['productprice'],
	                     'product_infor'=>$param['content']
	                ]);
	              return  $result;
	    } 
    }  

?>
