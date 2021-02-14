<?php


namespace app\model;


use think\Model;

class Book extends Model
{
   public function user()
   {
       //$this->belongsTo(User::class,'user_id','id');
   }
}