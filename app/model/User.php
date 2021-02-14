<?php


namespace app\model;


use think\Model;
use think\model\concern\SoftDelete;


class User extends Model
{
    /**
     * 关联模型初探详情见34
     */
    public function  profile()
    {
        //hasOne 表示一对一关联，参数一表示附表，参数二外键，默认 user_id
        //return $this->hasOne(Profile::class);

        //hasOne模式,适合主表关联附表,具体设置方法如下:
        //hasOne('关联模型',['外键','主键1']);
        //关联模型(必须):关联的模型名或者类名
        //外键:默认的外键规则是当前模型名(不含命名空间，下同)+_id ，例如 user_id
        //主键:当前模型主键，默认会自动获取也可以指定传入
//        return $this->hasOne(Profile::class,'user_id','id');


        //hasMany模式，适合主表关联附表，实现一对多查询，具体设置方式如下:
        //hasMany('关联模型',['外键','主键']);
        //关联模型(必须):模型名或者模型类名
        // 外键:关联模型外键，默认的外键名规则是当前模型名+_id
        // 主键:当前模型主键，一般会自动获取也可以指定传入
        return $this->hasMany(Profile::class,'user_id','id');
    }


    public function book()
    {
        return $this->hasMany(Book::class,'user_id','id');
    }

    //tp_user:用户表;tp_role:角色表;tp_access:中间表;
    //access表包含了user和role表的关联id，多对多模式;
    //在User.php的模型中，设置多对多关联，方法如下:
    public function  roles()
    {
//        在roles方法中，belongsToMany为多对多关联，具体参数如下:
        //belongsToMany('关联模型','中间表',['外键','关联键']);
        return $this->belongsToMany(Role::class,Access::class,'role_id','user_id');
    }


    //添加后缀需要设置模型名称
    //protected $name = 'user';

    //设置主键
    //protected  $pk = 'id';

    //设置表
    // protected $table = 'one';

    //模型初始化
    //protected  static  function  init()
    //{
    //第一次实例化的时候执行init
    //parent::init();
    //echo '初始化User模型';
    //}
    //

    /**
     * 查询范围只能使用find()和select()两种方法;
     * 全局范围查询，就是在此模型下不管怎么查询都会加上全局条件;
     */
    //定义全局的查询范围
//    protected $globalScope = ['status'];

    //如果你只想设置某一个模型开启,需要设置特有字段
    //开启自动时间戳
    //当然，还有一种方法，就是全局开启，单独关闭某个或某几个模型为false;
    //自动时间戳开启后，会自动写入create_time和update_time两个字段;
    //此时，它们的默认的类型是int，如果是时间类型，可以更改如下:
    //'auto_timestamp' => 'datetime', //或
    //protected $autoWriteTimestamp = true;
   // protected $autoWriteTimestamp = 'datetime';

    //都配置完毕后，当我们新增一条数据时，无须新增create_time会自动写入时间;
    //同理，当我们修改一条数据时，无须修改update_time会自动更新时间;
    //自动时间戳只能在模型下有效，数据库方法不可以使用;
    //如果创建和修改时间戳不是默认定义的，也可以自定义;
//    protected $createTime = 'create_at';
//    protected $updateTime = 'update_at';

    //如果业务中只需要 create_time 而不需要 update_time，可以关闭它;
//    protected $updateTime = false;

    /**
     * 模型中可以设置只读字段,就是无法被修改的字段设置
     * 我们要设置username和email不允许被修改
     */
//    protected $readonly = ['username','email'];


   //想要写入json字段的字符字段,需要设置
//    protected $json = ['list'];

   //需要在模型端设置软删除的功能，引入SoftDelete，它是trait


    //设置字段信息,需要写完整的数据表字段
//    protected $schema = [
//        'id' => 'int',
//        'username' => 'string',
//        'password' => 'string',
//        'gender' => 'string',
//        'email' => 'string',
//        'price' => 'float',
//        'details' => 'string',
//        'uid' => 'int',
//        'status' => 'int',
//        'list' => 'string',
//        'delete_time' => 'datetime',
//        'create_time' => 'datetime',
//        'update_time' => 'datetime',
//        '_pk' => 'id',
//        '_autoinc' => 'id',
//    ];

    //是否严格区分大小写
//    protected $strict = false;

    //模型端
//    public function getUsername($id)
//    {
//        $obj = $this->find($id);
//        return $obj->getAttr('username');
//    }

    /**
     * 获取器的作用是对模型实例的数据做出自动处理
     * 一个获取器对应模型的一个特殊方法，该方法为public
     * 方法名的命名规范为:getFieldAttr();
     * 数据库表示状态status字段采用的是数值
     * 而页面上，我们需要输出status字段希望是中文，就可以使用获取器
     * 在User模型端，我创建一个对外的方法，如下
     */
//    public function getStatusAttr($value)
//    {
//        $status = [-1=>'删除',0=>'禁用',1=>'正常',2=>'待审核'];
//        return $status[$value];
//    }

//    //除了getFieldAttr中Field可以是字段值，也可以是自定义的虚拟字段;
//    public function getNothingAttr($value,$data)
//    {
//        $myGet = [-1=>'删除', 0=>'禁用', 1=>'正常', 2=>'待审核'];
//        return $myGet[$data['status']];
//    }

      /**
       * 模型修改器的作用，就是对模型设置对象的值进行处理
       * 比如，我们要新增数据的时候，对数据就行格式化、过滤、转换等处理
       * 模型修改器的命名规则为:setFieldAttr;
       *  我们要设置一个新增，规定邮箱的英文都必须大写，修改器如下:
       */

//      public function setEmailAttr($value)
//      {
//          return strtoupper($value);
//      }


      /**
       * 模型查询范围
       * 在模型端创建一个封装的查询或写入方法，方便控制器端等调用;
       * 比如，封装一个筛选所有性别为男的查询，并且只显示部分字段5条;
       * 方法名规范:前缀scope，后缀随意，调用时直接把后缀作为参数使用;
       */
//      public function scopeMale($query)
//      {
//          $query->where('gender','男')
//          ->field('id,username,gender,email')
//          ->limit(5);
//      }

//      public function scopeEmail($query,$value)
//      {
//          //查询封装可以传递参数，比如，通过邮箱查找某人;
//          $query->where('email','like','%'.$value.'%');
//      }

//      public function scopePrice($query,$value)
//      {
//          //也可以实现多个查询封装方法连缀调用，比如找出邮箱xiao并大于80分的;
//          $query->where('price','>',80);
//      }


      //全局范围
//     public function scope($query)
//     {
//         $query->where('status',1);
//     }

     /**
      * 搜索器是用于封装字段(或搜索标识) 的查询表达式,类似范围查询
      * 一个搜索器对应模型的一个特殊方法,该方法为public
      * 方法名的命名规范为:searchFieldAttr();
      * 举个例子,我们要封装一个邮箱字符模糊查询，然后封装一个时间限定查询
      * 在User模型端，我创建两个对外的方法
      */
//     public function searchEmailAttr($query,$value,$data)
//     {
//         $query->where('email','like','%'.$value.'%');
//         //如果你想在搜索器添加一个可以排序的功能
//         if(isset($data['sort'])){
//             $query->order($data['sort']);
//         }
//     }

//     public function searchCreateTimeAttr($query,$value,$data)
//     {
//         $query->whereBetweenTime('create_time',$value[0],$value[1]);
//     }


     /**
      * 系统可以通过模型端设置写入或读取时对字段类型进行转换
      * 系统可以通过模型端设置写入或读取时对字段类型进行转换
      * 在模型端设置你想要类型转换的字段属性，属性值为数组
      *
      * 数据库查询读取的字段很多都是字符串类型，我们可以转换成如下类型: integer(整型)、float(浮点型)、boolean(布尔型)、array(数组) object(对象)、serialize(序列化)、json(json)、timestamp(时间戳) datetime(日期)
      */
//     protected $type = [
//       'price' => 'integer',
//       'status' => 'boolean',
//       'create_time' => 'datetime:Y-m-d'
//     ];

     /**
      * 类型转换还是会调用属性里的获取器等操作，编码时要注意这方面的问题;
      * 废弃字段，当某个字段在开发项目版本升级中不再使用，可以设置为废弃字段;
      * 设置废弃字段后，这个字段就不在查询数据列表里了，写入忽略(存疑);
      */
      //设置废弃字段
     //protected $disuse = ['status', 'uid'];


    //开启软删除
    //use SoftDelete;
    //protected $deleteTime = 'delete_time';
    //delete_time 默认我们设置的是 null，如果你想更改这个默认值，可以设置:
    //protected $defaultSoftDelete = 0;


//    public static function onAfterRead($query)
//    {
//        echo '执行了查询的方法';
//    }
//
//    public static function onBeforeUpdate($query)
//    {
//        echo '准备修改中...';
//    }
//
//
//    public static function onAfterUpdate($query)
//    {
//        echo '修改完毕...';
//    }

}


