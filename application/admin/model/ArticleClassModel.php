<?php   
    namespace app\admin\model;  
    use think\Model;  
    class ArticleClassModel extends Model
    { 
       protected $table	= 'gs_article_class';
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
	                'litter_class_pid'=>$data['fatherid'],
	               	'litter_class_name'=>$data['category'],
	                'litter_class_damage'=>$data['danger'],
	                'litter_class_info'=>$data['detail']
	            ]);
	        return $result;
	    }
	    
	    public function updatelitterclass($param)
	    {  

	            $result =  $this->where('litter_class_id',$param['id'])->update([
	                    'litter_class_pid'=>$param['litterclass'],
	                    'litter_class_name'=>$param['littercategoryname'],
	                    'litter_class_damage'=>$param['littercategorydamage'],
	                    'litter_class_info'=>$param['littercategoryinfo']
	                ]);
	              return  $result;
	    }   
    }  

?>
