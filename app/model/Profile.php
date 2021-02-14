<?php


namespace app\model;


use think\Model;

class Profile extends Model
{

    //反向关联   关联模型初探详情见34
    public function user()
    {
        // return $this->belongsTo(User::class);

        // belongsTo模式，适合附表关联主表，具体设置方式如下:
        //belongsTo('关联模型',['外键','关联主键']);
        // 关联模型(必须):模型名或者模型类名
        // 外键: 当前模型外键，默认的外键名规则是关联模型名+_id
        //关联主键:关联模型主键，一般会自动获取也可以指定传入

        return $this->belongsTo(User::class,'user_id','id');
    }

}