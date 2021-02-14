<?php


namespace app\controller;


class Comment
{
    /**
     * @param $id
     * @param $blog_id
     * @return 使用嵌套资源路由，可以让上级资源对下级资源进行操作，创建 Comment 资源;
     */
    public function read($id, $blog_id)
    {
        return 'Comment id:'.$id.'，Blog id:'.$blog_id; }
    public function edit($id, $blog_id)
    {
        return 'Comment id:'.$id.'，Blog id:'.$blog_id;
    }
}