<?php


namespace app\controller;
use app\model\Role;
use app\model\User as UserModel;
use app\model\Profile as ProfileModel;
class Grade
{
    public function  index()
    {
        //        return json(UserModel::find(21)->profile);
        //        return json(UserModel::find(21)->profile->hobby);
        //        return json(UserModel::find(21)->profile->status);

        //反向关联
         //    return json(ProfileModel::find(1)->user->email);
        //  return json(ProfileModel::find(1)->user);

        //使用save()方法，可以设置关联修改，通过主表修改附表字段的值;
//        $user = UserModel::find(19);
//        $user->profile->save(['hobby'=>'酷爱小姐姐']);

        //->profile属性方式可以修改数据，->profile()方法方式可以新增数据;
//        $user = UserModel::find(19);
//        $user->profile()->save(['hobby'=>'小辣椒']);


        //使用hasOne()也能模拟belongsTo()来进行查询;
        //参数一表示的是 User 模型类的 profile 方法，而非 Profile 模型类
//        return json(UserModel::hasWhere('profile',['id'=>2])->find());


        //采用闭包，这里是两张表操作，会导致 id 识别模糊，需要指明表
//        return json(UserModel::hasWhere('profile',function ($query){
//            $query->where('profile.id',2);
//        })->select());

        // 使用->profile()方法模式，可以进一步进行数据的筛选;
//         $user = UserModel::find(19);
//         return json($user->profile);
//         return  $user->profile()->where('id','>',10)->select();
//        return $user->profile->where('id','>',10);

        //使用has()方法，查询关联附表的主表内容，比如大于等于2条的主表记录;
        //return UserModel::has('profile','>=',2)->select();

        //使用hasWhere()方法，查询关联附表筛选后记录，比如兴趣审核通过的主表记录;
        //return UserModel::hasWhere('profile',['status'=>1])->select();

        //使用save()和saveAll()进行关联新增和批量关联新增
//        $user = UserModel::find(19);
//        $user->profile()->save(['hobby'=>'测试爱好','status'=>1]);
//        $user->profile()->saveAll([
//           ['hobby'=>'测试爱好1','status'=>1],
//           ['hobby'=>'测试爱好2','status'=>2]
//        ]);

           //  使用together()方法,可以删除主表内容时,将附表关联的内容全部删除
//           $user = UserModel::with('profile')->find(304);
//           $user->together(['profile'])->delete();


    }


    public function  load()
    {
        //普通的关联查询下，我们循环数据列表会执行n+1次SQL查询
//        $list = UserModel::select([19,20,21]);
//        foreach ($list as $user){
//            dump($user->profile->toArray());
//        }

        //如果采用关联预载入的方式，将会减少到两次，也就是起步一次，循环一次;
//        $list = UserModel::with(['profile'])->select([19,20,21]);
//        foreach ($list as $user){
//            var_dump($user->profile);
//        }

        //37节重点
        //关联预载入减少了查询次数提高了性能，但是不支持多次调用;
        //如果你有主表关联了多个附表，都想要进行预载入，可以传入多个模型方法即可;
//        $list = UserModel::with(['profile','book'])->select([19,20,21]);
//        foreach ($list as $user){
//            var_dump($user->profile.$user->book);
//        }

        //如果想要在关联模型实现链式操作，可以使用闭包，比如添加->field();
//        $user = UserModel::field('id,username')->with(['profile'=>function($query){
//            $query->field('user_id,hobby');
//        }])->select([19,20,21]);
//        echo $user;

        //关联预载入还提供了一个延迟预载入,就是先执行select()再load载入
//        $list = UserModel::select([19,20,21]);
//        $list->load(['profile']);
//        foreach ($list as $user){
//            dump($user->profile->toArray());
//        }

        //使用withCount()方法，可以统计主表关联附表的个数，输出用profile_count
//        $list = UserModel::withCount(['profile'])->select([19,20,21]);
//        foreach ($list as $user){
//            var_dump($user->profile_count);
//        }

        //关联统计的输出采用“关联方法名”_ count，这种结构输出
        //不单单支持Count，还有如下统计方法，均可支持;
        //withMax()、withMin()、withSum()、withAvg()等;
        //除了withCount()不需要指定字段，其它均需要指定统计字段;
//        $list = UserModel::withSum(['profile'],'status')->select([19,20,21]);
//        foreach ($list as $user){
//           echo$user->profile_sum.'<br/>';
//        }

        //对于输出的属性，可以自定义:
//        $list = UserModel::withSum(['profile'=>'p_s'],'status')->select([19,20,21]);
//        foreach ($list as $user){
//            echo $user->p_s.'<br/>';
//        }


        //使用hidden()方法,隐藏主表字段或附属表的字段
//        $list = UserModel::with('profile')->select();
//        return json($list->hidden(['profile.status']));
//        return json($list->hidden(['username','password','profile'=>['status','id']]));


        //使用visible()方法,只显示相关的字段
//        echo $list->visible(['profile.status']);

        //使用append()方法,添加一个额外字段,比如另一个关联的对象模型
//        $list->append(['book']);
    }

    public function many()
    {
        // 注意:Role 继承 Model 即可，而中间表需要继承 Pivot;
        //得到一个用户:蜡笔小新
        $user = UserModel::find(21);
        //获取这个用户的所有角色
        //$roles = $user->roles;
        //输出这个角色所具有的权限
        //return json($roles);


        //当我们要给一个用户创建一个角色时，用到多对多关联新增;
        // 而关联新增后，不但会给 tp_role 新增一条数据，也会给 tp_access 新增一条;
        //echo $user->roles()->save(['type'=>'测试管理员']);
//        $user->roles()->saveAll([['type'=>'开发工程师'],['type'=>'财务管理员']]);

        //一般来说，上面的这种新增方式，用于初始化角色比较合适;
        //也就是说，各种权限的角色，并不需要再新增了，都是初始制定好的;
        //那么，我们真正需要就是通过用户表新增到中间表关联即可;
//        $user->roles()->save(5);
        //或者
//        $user->roles()->save(Role::find(5));
//        $user->roles()->saveAll([1,2,3]);

        //或
//        $user->roles()->attach(1);
//        $user->roles()->attach(2,['details'=>'英雄']);

        //除了新增，还有直接删除中间表数据的方法 2代表但是role_id:
        $user->roles()->detach(2);
   }
}