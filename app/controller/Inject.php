<?php


namespace app\controller;


use app\model\One;

/**
 * 依赖注入:即允许通过类的方法传递对象的能力，并且限制了对象的类型(约束);
 * 而传递的对象背后的那个类被自动绑定并且实例化了，这就是依赖注入;
 */
class Inject
{
    protected  $one;

    public function __construct(One $one)
    {
        $this->one = $one;
    }

    public function index()
    {
        return $this->one->username;
    }


    public function bind()
    {
        /**
         * 依赖注入的类统一由容器管理的，大多数情况下是自动绑定和自动实例化的;
         * 如果想手动来完成绑定和实例化，可以使用bind()和app()助手函数来实现;
         */
        //bind('one','app\model\One');
        //return app('one')->username;

        //bind('one','...')绑定类库标识,这个标识具有唯一性,以便快速调用
        //app('one)快速调用,并自动实例化对象,标识严格保持一致包括大小写
        //自动实例化对象的方式,是采用单例模式实现，如果向想重新实例化一个对象,则
        //每次调用总是会重新实例化'
       // bind('one','app\model\One');
        //$one = app('one',[],true);
        //return $one->username;

        //bind('one','app\model\one');
        //$one = app('one',[['file']],true);
        //return $one->username;

        //return app('app\model\One')->username;

        //使用 bind([])可以实现批量绑定，只不过系统有专门提供批量绑定的文件;
//        bind([
//            'one' => 'app\model\One',
//            'user' => 'app\model\User'
//        ]);
//        return app('one')->username;

        //::class 模式，不需要单引号，而且需要在最前面加上\，之前的加不加都行;
        //系统提供了 provider.php 文件，用于批量绑定类到容器中，这里不加不报错;
//        bind([
//            'one' => \app\model\One::class,
//            'user' => \app\model\User::class
//        ]);
//        return app('user')->username;


//        return [
//            'one' => app\model\One::class, //这里加不加\都正常
//            'user' => app\model\User::class
//        ];
    }

}