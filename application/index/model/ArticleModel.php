<?php   

namespace app\index\model;

use think\Model;

    class ArticleModel extends Model
    { 
	    protected $table = 'gs_article';
        public function User()
		{
			return $this->hasOne('UserModel','user_id');
		}
	    public function getUsersByWhere()
	    {
	        return $this->select();
	    }
    }  
?>
