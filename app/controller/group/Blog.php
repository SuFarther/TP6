<?php


namespace app\controller\group;


class Blog
{
    /**
     * 多级控制器
     */
   public function index()
   {
       return 'index';
   }

    //http://www.juzss.com/tp6/public/group.blog/read
    public function read()
    {
        return 'read';
    }

    public function details($id)
    {
        return '详情id:'.$id;
    }
}