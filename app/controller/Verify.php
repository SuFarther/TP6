<?php


namespace app\controller;


use app\validate\User;
use think\exception\ValidateException;
use think\facade\Request;
use think\facade\Session;
use think\facade\Validate;
use think\validate\ValidateRule;



class Verify
{
   public function index()
   {
       //字符串模式
       try {
           //默认情况下，出现一个错误就会停止后面字段的验证，我们也可以设置批量验证
//           validate(User::class)->batch(true)->check([
//               'name' => '蜡笔小新',
//               'price' => 90,
//               'email' => 'xiaoxin@163.com'
//           ]);


           //在控制器端，验证时，根据不同的验证手段，绑定相关场景进行验证即可
           validate(User::class)->batch(true)->scene('edit')->check([
               'name' => '蜡笔小新蜡笔小新蜡笔小新蜡笔小新蜡笔小新蜡笔小新',
               'price' => '',
               'email' => 'xiaoxin@163.com'
           ]);
       } catch (ValidateException $e) {
           dump($e->getError());
       }
   }

    public function route($id)
    {
        return 'id:'.$id;
    }

   public function rule(){
       //这种调用方式，一般来说，就是独立、唯一，并不共享的调用方式;
//       $validate = Validate::rule([
//          'name' => 'require|max:20',
//           'price' => 'number|between:1,100',
//           'email' => 'email'
//       ]);



       //第一种
       //独立验支持闭包的自定义方式，但这种方式会不支持字段的多规则;
//       $validate = Validate::rule([
//          'name' => function($value){
//             return $value != ' '?true : '姓名不能为空';
//          },
//          'price' => function($value){
//             return $value > 0 ? true : '价格不能小于零';
//          }
//       ]);


       //第二种
       //独立验证的自定义错误提示，可以在方法的第二参数，参数一是规则;
//        $validate = Validate::rule([
//            'name' => ValidateRule::isRequire()->max(20),
//            'email' => ValidateRule::isEmail(null,'邮箱格式不正确'),
//            'price' => ValidateRule::isNumber()->between([1, 100], '价格范围1-100之间')
//        ]);
//
//       $validate->message([
//           'name.require' => ['code'=>1001, 'msg'=>'姓名不得为空'],
//           'name.max' =>'姓名不可以超过20位'
//       ]);
//
//       //独立验证默认也是返回一条错误信息，如果要批量返回所有错误使用batch();
//       $result = $validate->batch(true)->check([
//           'name|姓名' => '将军在世上',
//           'price' => 100,
//           'email' =>  'xiaomin@163.com'
//       ]);
//
//
//       if(!$result){
//           dump($validate->getError());
//       }

   }


   public function single()
   {
       //验证邮箱是否合法
       //dump(Validate::isEmail('xiaoming@163.com'));

       //验证是否为空
       //dump(Validate::isRequire(''));

       //验证是否为数值
       //dump(Validate::isNumber(10));

       //静态调用,也是支持多规则验证的,使用checkRule()方法实现
       //验证数值合法性
       //dump(Validate::checkRule(10, 'number|between:1,10'));

       //checkRule()不支持错误信息，需要自己实现，但支持对象化规则定义;
       dump(Validate::checkRule(100,ValidateRule::isNumber()->between('1,10')));
   }

   public function token()
   {
//       echo session('__token__');
//       echo '<br/>';
//       echo input('post.__token');
       //打印出保存到 session 的 token
       //echo Session::get('__token__');

       //在验证端口，可以使用控制器验证单独验证token是否验证成功;
//       $check = Request::checkToken('__token');
//       if(false === $check) {
//           throw new ValidateException('令牌错误');
//       }

     //       验证器部分，只要使用内置规则token即可验证，具体流程如下:
       $validate = Validate::rule([
          'name' => 'require|token'
       ]);

       $result = $validate->batch(true)->check([
           'name' => input('post.name'),
           '__token__'=> input('post.__token__')
       ]);

       if(!$result){
           dump($validate->getError());
       }
   }


}