<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;

class Blog
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return  '资源列表首页';
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        return '创建资源表单页';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        return '保存新建资源';
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        return '返回指定的资源id: '.$id;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        return '修改资源表单id:'.$id;
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        return '保存更新的资源'.$id;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return '删除指定资源的id'.$id;
    }
}
