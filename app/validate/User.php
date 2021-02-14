<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        //系统提供了常用的规则让开发者直接使用，也可以自行定义独有的特殊规则;
        'name｜用户名' => 'require|max:20|checkName:将军在世上',
        // 'name' => 'require|max:20', //不得为空,不得大于20位
        'price'=> 'number|between:1,100', //必须是数值,1-100之间
        'email' => 'email',//邮箱格式要正确
        'id' => 'number|between:1,10'

        //数组模式
        //数组模式在验证规则很多很乱的情况下，更容易管理，可读性更高;
        //如果你想使用独立验证，就是手动调用验证类，而不是调用User.php验证类;
        //这种调用方式，一般来说，就是独立、唯一，并不共享的调用方式;
//        'name' => [
//          'require',
//              'max' => 10,
//              'checkName' => '将军在世上'
//        ],
//        'price' => [
//           'number',
//           'between' => '1,100'
//        ],
//        'email' => 'email'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'name.require' => '姓名不得为空',
        'name.max' => '姓名不得大于20位',
        'price.number' => '价格必须是数字',
        'price.between' => '价格必须1-100之间',
        'email' => '邮箱的格式错误',
        'id.between' => 'id 只能是 1-10 之间',
        'id.number' => 'id 必须是数字',
    ];



    //验证场景设置，即特定的场景下是否进行验证，独立验证不存在场景验证
    protected $scene = [
       'insert' => ['name','price','email'],
       //'edit' =>   ['name','price'],
        'route'     =>  ['id']
    ];

    public function sceneEdit()
    {
        //注意： 请不要对一个字段进行两个或以上的移出和添加，会被覆盖;
        //remove('name', 'xxx|yyy|zzz')或 remove('name', ['xxx', 'yyy', 'zzz']);
        $edit = $this->only(['name', 'price'])  //仅对两个字段验证
                    ->remove('name', 'max') //移出掉最大字段的限制
                    ->append('price', 'require'); //增加一个不能为空的限制
        return $edit;
    }

    //自定义规则，名称中不得是“将军在世上”
    protected function checkName($value,$rule)
    {
        return $rule !=$value ? true : '名称存在非法称谓'.$rule;
    }

    //对于自定义规则中，一共可以有五个参数，我们分别了解一下;
//    protected  function  checkName($value,$rule,$data,$field,$title)
//    {
//        dump($data);  //所有数据信息
//        dump($field);  //当前的字段名
//        dump($title);  //字段描述,没有就是 字段名
//    }

}
