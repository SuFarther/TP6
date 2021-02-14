<?php


namespace app\controller;


class Error
{
    /**
     * 空控制器
     */
   public function index(){
       return '当前控制器不存在';
   }

    /**
     * @return string 全局miss
     */
//   public function miss()
//   {
//       return '404 页面不存在';
//   }
}