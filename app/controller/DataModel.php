<?php


namespace app\controller;



use app\model\User as UserModel;
use think\facade\Db;

class DataModel
{
   public function  index()
   {
       return json(UserModel::find('19'));
   }

   public function insert()
   {
       //1. 使用实例化的方式添加一条数据，首先实例化方式如下，两种均可:
       //$user = new \app\model\User();
//       $user =  new  UserModel();

       //2. 设置要新增的数据，然后用save()方法写入到数据库中，save()返回布尔值;
//       $user->username = '小米';
//       $user->password = '123';
//       $user->gender = '男';
//       $user->email = 'xiaomi@163.com';
//       $user->price = 100;
//       $user->details = '123';
//       $user->uid = 1012;
       //5. 模型新增也提供了replace()方法来实现REPLACEinto新增;
//       $user->replace()->save();
//       也可以动态实现不修改 update_time
//       $user->isAutoWriteTimestamp(false)->replace()->save();
//       return Db::getLastSql();

       //3.也可以通过save()传递数据数组的方式，来新增数据;
//       $user->save([
//           'username'=>'小白鼠',
//           'password'=>'234',
//           'gender'=>'男',
//           'email'=>'xiaobaishu@163.com',
//           'price'=>200,
//           'details'=>'123',
//           'uid'=>1014
//       ]);

        //4. 使用allowField()方法，允许要写入的字段，其它字段就无法写入了;
//        $user->allowField(['username','email','password','details'])->
//        save(['username'=>'一拳超人','email'=>'chaoren@163.com','password'=>'134','details'=>'123']);


       //7. 使用saveAll()方法，可以批量新增数据，返回批量新增的数组;
//        $dataAll = [
//            [
//               'username'=>'小白鼠1',
//               'password'=>'234',
//               'gender'=>'男',
//               'email'=>'xiaobaishu1@163.com',
//               'price'=>200,
//               'details'=>'123',
//               'uid'=>1014
//            ],
//            [
//                'username'=>'小白鼠2',
//                'password'=>'234',
//                'gender'=>'男',
//                'email'=>'xiaobaishu2@163.com',
//                'price'=>200,
//                'details'=>'123',
//                'uid'=>1014
//            ]
//
//        ];
//        $user = new UserModel();
//        dump($user->saveAll($dataAll));


       //8. 使用::create()静态方法，来创建要新增的数据;
       //参数 1 是新增数据数组，必选
        //参数 2 是允许写入的字段，可选
        //参数 3 为是否 replace 写入，默认 false 为 Insert 写入
//       $user = UserModel::create([
//            'username'=>'小黑',
//            'password'=>'234',
//            'gender'=>'男',
//            'email'=>'xiaohei@163.com',
//            'price'=>100,
//            'details'=>'567',
//            'uid'=>1015
//       ],['username','password','email','details'],false);
//       echo $user->id;
   }


   public function  delete()
   {
       //1. 使用find()方法，通过主键(id)查询到想要删除的数据;
       //$user = UserModel::find(310);
       //2. 然后再通过delete()方法，将数据删除，返回布尔值;
       //echo $user->delete();
       //3. 也可以使用静态方法调用destroy()方法，通过主键(id)删除数据;
      // echo UserModel::destroy(309);
       //4. 静态方法destroy()方法,也可以批量删除数据
       // echo UserModel::destroy([306,307,308]);
       //5. 通过数据库类的查询条件删除;
       // echo UserModel::where('id', '=', 303)->delete();
       //6. 使用闭包的方式进行删除
       echo UserModel::destroy(function ($query){
           $query->where('id','=',303);
       });

   }

   public function update()
   {
       //1. 使用find()方法获取数据，然后通过save()方法保存修改，返回布尔值;
       $user = UserModel::find(306);
       $user->username='小黑';
       $user->email='xiaomi@163.com';
       //5. Db::raw()执行SQL函数的方式，同样在这里有效;
       $user->price = Db::raw('price+1');
       //3. save()方法只会更新变化的数据，如果提交的修改数据没有变化，则不更新;
       echo $user->save();
//       除了在模型端设置，也可以动态设置只读字段;
       //同样，只读字段只支持模型方式不支持数据库方式;
//       echo $user->readonly(['username', 'email'])->save();


       //2. 通过where()方法结合find()方法的查询条件获取的数据，进行修改;
//       $user = UserModel::where('username','小白')->find();
//       $user->username='小白';
//       $user->email='xiaobai@163.com';
       ////4. 但如果你想强制更新数据，即使数据一样，那么可以使用force()方法;
//       echo $user->force()->save();



       //6. 使用allowField()方法，允许要更新的字段，其它字段就无法写入了;
//       $user = UserModel::find(302);
//       $user->allowField(['username','email'])->save(['username'=>'小池','email'=>'xiaochi@163.com']);
       //7. 通过saveAll()方法，可以批量修改数据，返回被修改的数据集合;
//       $user = new UserModel();
//       $saveAll = [
//           [
//               'id'=>301,
//               'username'=>'李东',
//               'email'=>'lidong@163.com'
//           ],
//           [
//               'id'=>302,
//               'username'=>'小花',
//               'email'=>'xiaohua@163.com'
//           ]
//       ];
//       dump($user->saveAll($saveAll));



       //8. 批量更新saveAll()只能通过主键id进行更新;
       //9. 使用静态方法::update()更新，返回的是对象实例;
//       UserModel::update([
//           'id'=>302,
//           'username'=>'小牛',
//           'email'=>'xiaoniu@163.com'
//       ]);
//       UserModel::update([
//           'username'=>'小黄',
//           'email'=>'xiaohuang@163.com'
//       ],['id'=>302]);

//       UserModel::update([
//           'username'=>'小菊',
//           'email'=>'xiaohuang@163.com'
//       ],['id'=>302],['username']);//只更新 username
       //10. 模型的新增和修改都是 save()进行执行的，它采用了自动识别体系来完成;
       //11. 实例化模型后调用 save()方法表示新增，查询数据后调用 save()表示修改;
       //12. 当然，如果在 save()传入更新修改条件后也表示修改;
   }

   public function select()
   {
       //一.数据查询
       //1. 使用find()方法，通过主键(id)查询到想要的数据;
       //return json(UserModel::find(19));

       //2. 也可以使用where()方法进行条件筛选查询数据;
       //return json(UserModel::where('username','辉夜')->find());

       //3. 调用find()方法时，如果数据不存在则返回Null;
       //4. 同上，还有findOrEmpty()方法，数据不存在返回空模型;
       //5. 此时，可以后使用isEmpty()方法来判断，是否为空模型;
       //  $user = UserModel::where('id',18)->findOrEmpty();
       //  if($user->isEmpty()){
        //    echo '空模型,无数据!';
        //   }

       //6. 使用select([])方式，查询多条指定id的字段，不指定就是所有字段;
//       $user = UserModel::select([19,20,21]);
//       foreach ($user as $key=>$obj){
//           echo $obj->username;
//       }

       //7. 模型方法也可以使用where等连缀查询，和数据库查询方式一样;
//       return json(UserModel::where('status',1)->limit(5)
//           ->order('id','desc')->select());

       //8. 获取某个字段value()或者某个列column()的值;
//       return json(UserModel::where('id',79)->value('username'));
       //return json(UserModel::whereIn('id',[79,118,128])->column('username','id'));

       //9. 模型支持动态查询:getBy*，*表示字段名;
      // echo UserModel::getByUsername('辉夜');
       //echo UserModel::getByEmail('huiye@163.com');

       //10. 模型支持聚合查询:max、min、sum、count、avg 等;
       //echo UserModel::max('price');


       //11. 使用 chunk()方法可以分批处理数据，数据库查询时讲过，防止一次性开销过大;
//       return json(UserModel::chunk(5,function ($users){
//           foreach ($users as $user){
//               echo $user->username;
//           }
//           echo '<br>------<br/>';
//       }));


       //12. 可以利用游标查询功能，可以大幅度减少海量数据的内存开销，它利用了 PHP 生
       //成器特性。每次查询只读一行，然后再读取时，自动定位到下一行继续读取;
       foreach (UserModel::where('status',1)->cursor() as $user){
           echo $user->username;
           echo '<br>------<br/>';
       }
   }

   public function field()
   {
      //4. 系统提供了一条命令，生成一个字段信息缓存，可以自动生成;
       //php think optimize:schema 切换到项目到路径下面输出这个命令 会在runtime文件下面看到schema
       //11. 当数据获取到后，想要单独获取数据可以用->和数组方式来获取;
       $user = UserModel::find(19);
       echo $user->username;
       echo $user['email'].'<br/>';

       //控制器端调用
//       $user = new UserModel();
//       return $user->getUsername(19);

       //12.如果我们在模型端把数据整理好，交给控制器直接调用，如下方式:
       //13. 字段的赋值操作，也可以是->和数组方式，作用就是提交给模型处理;
 //     $user = new UserModel();
//       echo $user->username = 'Mr.Lee'.'<br/>';
//       echo $user['email'] ='lee@163.com';
       //14. 默认情况下，字段是严格区分大小写的，也就是需要和数据表字段保持一致;
       //echo $user->create_time;
       //15. 我们可以在模型属性$strict 设置为 false 即可实现非严格字段;
       echo $user->createTime;
   }

    public function getStatus()
    {
        //然后，在控制器端，直接输出数据库字段的值即可得到获取器转换的对应值
//        $user = UserModel::find(19);
//        return $user->status;

       /**
        * Nothing这个字段不存在，而此时参数$value只是为了占位，并未使用;
        * 第二个参数$data 得到的是筛选到的数据，然后得到最终值;
        * 如果你定义了获取器，并且想获取原始值，可以使用 getData()方法;
        */
//       return  $user->nothing;
//        return $user->getData('status');

        //直接输出无参数的 getData()，可以得到原始值，而$user 输出是改变后的
//        dump($user->getData());
//        dump($user);

//        使用 WithAttr 在控制器端实现动态获取器，比如设置所有 email 为大写;
        $user = UserModel::WithAttr('email', function ($value) { return strtoupper($value);
        })->select();
        return json($user);

//        $user = UserModel::WithAttr('status', function ($value) {
//            $status = [-3=>'未删除',-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核',3=>'审核完成'];
//            return $status[$value];
//        })->select();
//        return json($user);
    }

    public function modelSelect()
    {
        /**
         * 模型模糊查询
         */
//        return json(UserModel::scope('male')->select());
//         return json(UserModel::male()->select());


         //查询封装可以传递参数，比如，通过邮箱查找某人;
//        return json(UserModel::scope('email','xiao')->select());
//        return json(UserModel::email('xiao')->select());

        //也可以实现多个查询封装方法连缀调用，比如找出邮箱xiao并大于80分的;
//        return json(UserModel::scope('email','xiao')
//        ->scope('price','>',80)->select());
//         return json(UserModel::email('xiao')->price(80)->select());


        //在定义了全局查询后,如果想取消这个查询的所有全局查询,可以用下面方法：
//        UserModel::withoutGlobalScope();

        // 在定义了全局查询后,如果想取消这个查询的部分全局查询,可以添加参数指定
//        UserModel::withoutGlobalScope(['status']);
    }


    public function search()
    {
//        在控制器端，通过withSearch()方法实现模型搜索器的调用
        // withSearch()中第一个数组参数，限定搜索器的字段，第二个则是表达式值;
        // 如果想在搜索器查询的基础上再增加查询条件，直接使用链式查询即可;
//        return json(UserModel::withSearch(['email','create_time'],
//            [
//                'email'=>'xiao',
//                'create_time'=> ['2016-1-1','2020-1-1'],
//                'price'=>'desc'
//            ]
//        )->select());
        //where('username','like','%'.'蜡笔'.'%')->select();
        //搜索器的第三个参数$data，可以得到 withSearch()方法第二参数的值;
        //字段也可以设置别名:'create_time'=>'ctime'




        //模型数据集
        //数据集也是直接继承collection类，所以和数据库方式一样
        //数据集对象和数组操作方法一样，循环遍历、删除元素等
        //判断数据集是否为空，我们需要采用isEmpty()方法;
        $result = UserModel::where('id',111)->select();
        if($result->isEmpty()){
            return '没有数据!';
        }

        //更多数据集方法，直接参考数据库那篇的表格即可;
        //使用模型方法hidden()可以隐藏某个字段，使用visible()显示只某个字段;
        //使用append()可以添加某个获取器字段，使用withAttr()对字段进行函数处理;
        return json(UserModel::select()
            ->hidden(['password'])
            ->append(['nothing'])
            ->withAttr('email',function($value){
                return strtoupper($value);
            })
        );

    }


    public function typeC()
    {
        $user = UserModel::find(19);
        var_dump($user->price);
        var_dump($user->status);
        var_dump($user->create_time);
    }

    public function jsonInsert()
    {
        //数据库写入JSON字段，直接通过数组的方式即可完成
//        $data = [
//            'username' => '辉夜',
//            'password' => '123',
//            'gender' => '女',
//            'email' => 'huiye@163.com',
//            'price' => 90,
//            'details' => '123',
//            'uid' => 1011,
//            'status' => 1,
//            'list' => ['username'=>'辉夜','gender'=>'女', 'email' => 'huiye@163.com']
//        ];
//        Db::name('user')->json(['list'])->insert($data);

        //如果要查询数据时，正确转换json数据格式，也需要设置json方法;
       // return json(Db::name('user')->json(['list'])->find(307));


        //如果要将json字段里的数据作为查询条件，可以通过如下方式实现
        //return json(Db::name('user')->json(['list'])->where('list->username','辉夜')->find());


        //如果想完全修改json数据，可以使用如下的方式实现
        //$data['list'] = ['username'=>'李白','gender'=>'男','email'=>'libai@163.com'];
        //return json(Db::name('user')->json(['list'])->where('id',306)->update($data));


        //如果只想修改json数据里的某一个项目，可以使用如下的方式实现
        //$data['list->username']='李黑';
        //return json(Db::name('user')->json(['list'])->where('id',306)->update($data));
//
        //数组模型新增方式
//       UserModel::create([
//            'username'=>'小黑',
//            'password'=>'234',
//            'gender'=>'男',
//            'email'=>'xiaohei@163.com',
//            'price'=>100,
//            'details'=>'567',
//            'uid'=>1015,
//            'list'=>['username'=>'辉夜','gender'=>'女', 'email' => 'huiye@163.com']
//       ]);


        //对象数组模型新增方式
//        $user = new UserModel();
//        $user->username = '李白';
//        $user->password = '123';
//        $user->gender = '男';
//        $user->email = 'libai@163.com';
//        $user->price = 100;
//        $user->details = '123';
//        $user->uid = 1011;
//
//        $list = new  \StdClass();
//        $list->username = '小红';
//        $list->gender = '女';
//        $list->email = 'xiaohong@163.com';
//        $user->list = $list;
//
//        $user->isAutoWriteTimestamp(false)->replace()->save();


        //通过对象调用方式，直接获取json里面的数据;
//         return UserModel::find(309)->list->username;


        // 通过json的数据查询，获取一条数据;
//        return   UserModel::where('list->username','辉夜')->find()->list->email;
        $user = UserModel::find(308);
        $user ->list->username = '东宫';
        $user->save();
     }

    public  function softDelete()
    {
    //开启软删除
    // UserModel::destroy(308);
    //  UserModel::find(309)->delete();

    //    默认情况下，开启了软删除功能的查询，模型会自动屏蔽被软删除的数据;
    //     $user = UserModel::select();
    //    return Db::getLastSql();
    //     return json($user);

     // 在开启软删除功能的前提下，使用withTrashed()方法取消屏蔽软删除的数据;
    //         return json(UserModel::withTrashed()->select());

     //如果只想查询被软删除的数据，使用onlyTrashed()方法即可;
    //         return json(UserModel::onlyTrashed()->select());

     // 如果想让某一条被软删除的数据恢复到正常数据，可以使用restore()方法;
    //         $user = UserModel::onlyTrashed()->find(309);
    //         return json($user->restore());


    //         如果想让一条软删除的数据真正删除，在恢复正常后，使用force()和delete();
    //           $user = UserModel::onlyTrashed()->find(308);
    //           $user->restore();
    //           $user->force()->delete();

        UserModel::destroy(308,true);
    }
}