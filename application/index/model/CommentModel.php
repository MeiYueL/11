<?php   

namespace app\index\model;

use think\Model;

    class CommentModel extends Model
    { 
	    protected $table = 'gs_article_comment';

	    public function findUserByName($id)
	    {

	        return $this->where('product_id', $id)->join('gs_product_pic','gs_product_pic.product_id = gs_article.article_class_id')->select();
	    }
	   public function selectproduct()
	    {
	        return $this->select();
	    }
	    public function insertcontent($data,$res)
	    {
	        $result = $this->save([
	                'article_id'=>$data['danjia'],
	               	'user_id'=>$res, 
	                'article_comment_content'=>$data['content']
	            ]);
	        return $result;
	    }

    }  
?>
