<?php   
    namespace app\admin\model;  
    use think\Model;  
    class LitterModel extends Model
    { 
       protected $table	= 'gs_litter';
	     public function litter()
	    {
	        return $this->select();
	    }

	    public function litterclasswhere()
	    {
	        return $this->where('litter_class_pid','eq','0')->select();
	    }
	     public function addlitterclass($data)
	    {
	        $result = $this->save([
	                'litter_name'=>$data['name'],
	               	'one_class_id'=>$data['type1'],
	                'two_class_id'=>$data['lables']
	            ]);
	        return $result;
	    }
	    
	    public function updatelitterclass($param)
	    {  

	            $result =  $this->where('litter_id',$param['id'])->update([
	                    'litter_name'=>$param['littername'],
	                    'one_class_id'=>$param['type1'],
	                    'two_class_id'=>$param['lables']
	                ]);
	              return  $result;
	    }   
    }  

?>
