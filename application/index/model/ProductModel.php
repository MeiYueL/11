<?php   

namespace app\index\model;

use think\Model;

    class ProductModel extends Model
    { 
	    protected $table = 'gs_product';

	    public function findUserByName($id)
	    {

	        return $this->where('product_id', $id)->join('gs_product_pic','gs_product_pic.product_id = gs_article.article_class_id')->select();
	    }
	   public function selectproduct()
	    {
	        return $this->select();
	    }
	    public function insertcontent($content,$selectResult1)
	    {
	        $result = $this->save([
	                'user_id'=>$selectResult1,
	               	'feedback_content'=>$content, 
	                'feddback_time'=>date("Y-m-d H:i:s")
	            ]);
	        return $result;
	    }

    }  
?>
