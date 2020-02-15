<?php
namespace app\index\model;

use think\Model;

class ChinaModel extends Model
{
    // 确定链接表名
    protected $table = 'gs_china';

    public function addArticle($param,$teachers)
    {
        $result = $this->save([
                'biaoti'=>$param['biaoti'],
                'price'=>$param['thumbnail'],
                'detail'=>$param['content'],
                'checkbox'=>$teachers,
                'danxuan'=>$param['qw']
            ]);
        return $result;
    }
    public function exchange($param)
    {
        $result = $this->where('id','eq',$param['type1'])->field('name')->select();

        return $result;
    }
    public function exchange1($param)
    {
        $result = $this->where('id','eq',$param['lables'])->field('name')->select();
        return $result;
    }
     public function exchange2($param)
    {
        $result = $this->where('id','eq',$param['lables2'])->field('name')->select();
        return $result;
    }
    public function getUsersByWhere($where)
    {
        return $this->where('pid','eq',0)->select();
    }
    public function find($cate)
    {
        return $this->where('pid','eq',$cate)->select();
    }
    public function find1($where)
    {
        return $this->where('pid','eq',$cate)-> select();
    }
    public function updateNews($param)
    {  

            $result =  $this->where('newisd',$param['newisd'])->update([
                    'biaoti'=>$param['biaoti'],
                    'price'=>$param['thumbnail'],
                    'detail'=>$param['content']
                ]);
              return  $result;
    }   
}