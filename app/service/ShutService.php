<?php
declare (strict_types = 1);

namespace app\service;

use app\common\Shut;

class ShutService extends \think\Service
{
    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
    	//绑定到容器,将被服务的类注册到容器中去
        $this->app->bind('shut',Shut::class);
    }

    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
        //执行
        Shut::setName('Mr.Wang');
    }
}
