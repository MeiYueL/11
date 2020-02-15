<?php   
    namespace app\admin\model;  
    use think\Model;  
    class ArticleModel extends Model
    { 
       protected $table	= 'gs_article';
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
	    public function insertcontent($data,$s)
	    {
	    	$s='/upload/article/'.$s.'.jpg';
	        $result = $this->save([
	                'article_name'=>$data["newtitle"],
	               	'article_class_id'=>$data["type2"], 
	                'article_content'=>$data["content"],
	                'article_from'=>$data["type1"],
	               	'article_pic_url'=>$s
	            ]);
	        return $result;
	    }

	    public function updatelitterclass($param,$s)
	    {  
	$s='/upload/article/'.$s.'.jpg';
	            $result =  $this->where('article_id',$param['id'])->update([
	                'article_name'=>$param["newtitle"],
	               	'article_class_id'=>$param["lables"], 
	                'article_content'=>$param["content"],
	                'article_from'=>$param["type1"],
	               	'article_pic_url'=>$s
	                ]);
	              return  $result;
	    } 
    }  

?>
