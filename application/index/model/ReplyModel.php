<?php   

namespace app\index\model;

use think\Model;

    class ReplyModel extends Model
    { 
	    protected $table = 'gs_article_reply';

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
	        	'article_reply_id'=>date("Y-m-d H:i:s"),
	                'article_comment_id'=>$data['id'],
	               	'user_id'=>$res, 
	                'article_reply_content'=>$data['classname']
	            ]);
	        return $result;
	    }

    }  
?>
