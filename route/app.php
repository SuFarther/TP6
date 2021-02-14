<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');

//在没有定义路由规则的情况下，我们访问address/details包含id的URL为:
//http://localhost:8000/address/details/id/5
//将这个URL定义路由规则,在根目录route下的app.php里配置
//Route::rule('details/:id','Address/details');
//当配置好路由规则后,会出现非法请求当错误,我们需要用路由规则的URL访问:
//http://localhost:8000/details/5

//rule()方法是默认请求是any,即任何请求类型均可，第三参数可以限制:
//Route::rule('details/:id','Address/xxx','GET');  //GET
//Route::rule('details/:id','Address/xxx','POST');  //POST
//Route::rule('details/:id','Address/xxx','GET|POST');  //GET|POST

//所有请求方式(快捷方式):GET(get)、POST(post)、DELETE(delete)、PUT(put)PATCH(patch) 、*(any,任意请求方式)
//Route::get(...)、Route::post(...)、Route::delete(...)...

//快捷方式,就是直接用Route::get、Route::post等方式即可,无须等三参数
//当我们设置了强制路由的时候,访问首页就会报错,必须强制设置首页路由
//开始强制路由,需要在route.php里面进行配置,然后配置首页路由

//Route::rule('/','Index/index');   //反斜杆就是首页默认访问的地址

//静态路由
//Route::rule('ad','Address/index');
//静态动态结合的地址
//Route::rule('details/:id','Address/details');
//多参数静态动态结合的地址
//Route::rule('search/:id/:uid','Address/search');
//全动态地址,不限制是否search否定
//Route::rule(':search/:id/:uid','Address/search');
//包含可选参数的地址
//Route::rule('find/:id/[:content]','Address/find');
//规则完全匹配的地址
//Route::rule('search/:id/:uid$','Address/search');

//路由定义好之后,我们在控制器要创建这个路由地址，可以通过url()方法实现

//不定义标识的做法
//return url('Address/details',['id'=>10]);

//定义标识的做法
//Route::rule('details/:id','Address/details')->name('det');
//return url('det',['id'=>10]);


//路由的变量规则和闭包
//将details方法里的id传值，严格限制必须只能是数字\d+;
//Route::rule('details/:id','Address/details')
//->pattern(['id'=>'\d+']);

//也可以设置search方法的两个值的规则，通过数组的方式传递参数;
//Route::rule('details/:id/:uid','Address/search')
//->pattern([
    //'id'=>'\d+',
  //  'uid'=>'\d+'
//]);

//以上两种，均为局部变量规则，也可以直接在app.php设置全局变量规则;
//Route::pattern(['id'=>'\d+','uid'=>'\d+']);

//也支持使用组合变量规则方式，实现路由规则;
//Route::rule('details-><id>','address/details')
// ->pattern(['id'=>'\d+']);


//动态组合的拼装，地址和参数如果都是模糊动态的，可以使用如下方法;
//Route::rule('details-:name-:id','Hello:name/index')->pattern(['id', '\d+']);

//闭包支持我们可以通过URL直接执行，而不需要通过控制器和方法;
//Route::get('think', function () {
//    return 'hello,ThinkPHP6!';
//});

//闭包支持也可以传递参数和动态规则
//Route::get('hello/:name',function ($name){
//   return 'Hello,'.$name;
//});

//默认Index控制器
//Route::rule('/','index');

//Route::rule('bd/:id','group.Blog/details');

//Route::rule('ad/:id','Address/details2');
//Route::rule('ds/:id','\app\controller\Address@details');
//Route::rule('ds/:id','\app\controller\Address::details2');

//Route::redirect('ds/:id', 'http://localhost:8000');

//Route::rule('ds/:id','address/details')->ext('html');
//Route::rule('ds/:id','address/details')->ext('html|shtml');
//Route::rule('ds/:id','address/details')->ext('html')->https();

//Route::rule('details/:id', 'address/details')->denyExt('gif|jpg|png');

//Route::rule('ds/:id','Address/details')->domain('localhost');
//Route::rule('ds/:id','Address/details')->domain('www.juzss.com');
//Route::rule('ds/:id','Address/details')->domain('http://www.juzss.com');

//如果想限定在news.juzss.com这个域名下才有效，通过域名路由闭包的形式;
//Route::domain('news',function (){
//    Route::rule('details/:id','Address/details');
//});


//除了二级(子)域名的开头部分，也可以设置完整域名;
//Route::domain('news.juzss.com',function (){
//    Route::rule('details/:id','Address/details');
//});

//支持多个二级(子)域名开头部分,使用相同的路由规则;
//Route::domain(['news','blog','live'],function (){
//   Route::rule('details/:id','Address/details');
//});

//可以作为方法，进行二级(子)域名开头部分的检测，或完整域名检测;
//Route::rule('details/:id','Address/details')->domain('news');
//Route::rule('details/:id','Address/details')->domain('news');


//路由域名也支持:ext、pattern、append 等路由参数方法的操作

//跨域请求
//所以，为了解除这个限制，我们通过路由allowCrossDomain()来实现;
//Route::rule('details/:id','Address/details')->ext('html')->allowCrossDomain();
//实现跨域比如没有实现的header头文件多了几条开头为Access的信息
//此时，这个页面，就可以支持跨域请求的操纵了
//我们创建一个不同端口号或不同域名的ajax按钮,点击获取这个路由页面信息
//如果,没有开启跨域请求，则会爆出提醒：

//已拦截跨源请求:同源策略禁止读取位于 http://localhost:8000/details/5.html 的远程资源。(原因:CORS 头
//缺少 'Access-Control-Allow-Origin')

//开启后，即正常获取得到的数据;
//如果你想限制跨域请求的域名，则可以增加一条参数;
//Route::rule('details/:id','Address/details')
//    ->allowCrossDomain([
//        'Access-Control-Allow-Origin'=>'http://news.juzss.com:8000'
//    ]);

//路由分组，即将相同前缀的路由合并分组，这样可以简化路由定义，提高匹配效率;
//使用group()方法，来进行分组路由的注册;

//http://news.juzss.com:8000/address/read/13.html
//Route::group('address',function (){
//    Route::rule('details/:id','Address/details');
//    Route::rule('read/:name','Address/read');
//})->ext('html')->pattern(['id'=>'\d+','name'=>'\w+']);

//http://news.juzss.com:8000/address/13.html
//Route::group('address',function (){
//    Route::rule(':id','Address/details');
//    Route::rule(':name','Address/read');
//})->ext('html')->pattern(['id'=>'\d+','name'=>'\w+']);


//http://news.juzss.com:8000/address/13.html
//使用prefix()方法，可以省略掉分组地址里的控制器;
//Route::group('address',function (){
//    Route::rule(':id','details');
//    Route::rule(':name','read');
//})->ext('html')->prefix('Address/')->pattern(['id'=>'\d+','name'=>'\w+']);

//append()方法，可以额外传入参数
//Route::group('address',function (){
//    Route::rule(':id','details');
//    Route::rule(':name','read');
//})->ext('html')->prefix('Address/')->pattern(['id'=>'\d+','name'=>'\w+'])->append(['status'=>1]);


//路由规则(主要是分组和域名路由)定义的文件，加载时会解析消耗较多的资源;
//尤其是规则特别庞大的时候，延迟解析开启让你只有在匹配的时候才会注册解析;
//我们在route.php中开启延迟解析，多复制几组规则，然后来查看内存占用;
//'url_lazy_route' => true,

//MISS 路由
//Route::miss('public/miss');

//Route::group('address',function (){
//    Route::rule(':id','details');
////    Route::rule(':name','read');
//    Route::miss('miss');
//})->ext('html')->prefix('Address/')->pattern(['id'=>'\d+','name'=>'\w+'])->append(['status'=>1]);
//资源路由，采用固定的常用方法来实现简化URL的功能;
//Route::resource('ads','Address');

//使用 rest()方法，更改系统给予的默认方法，1.请求方式;2.地址;3.操作;
//Route::rest('create',['GET','/:id/add','index']);

//批量
//Route::rest([
//    'save' => ['POST', '', 'store'], 'update' => ['PUT', '/:id', 'save'], 'delete' => ['DELETE', '/:id', 'destory'],
//]);


//在路由定义文件下创建一个资源路由，资源名称可自定义;
//Route::resource('blog','Blog');
//使用嵌套资源路由，可以让上级资源对下级资源进行操作，创建 Comment 资源;
//Route::resource('blog.comment','Comment');

//资源嵌套生成的路由规则如下:
// http://localhost:8000/blog/:blog_id/comment/:id
//http://localhost:8000/blog/:blog_id/comment/:id/edit

//嵌套资源生成的上级资源默认 id 为:blog_id，可以通过 vars 更改;
// Route::resource('blog.comment', 'Comment')->vars(['blog'=>'blogid']);


//Route::resource('blog','Blog')->vars(['blog'=>'blog_id']);

//也可以通过 only()方法限定系统提供的资源方法，比如:
//Route::resource('blog','Blog')->only(['index','save','create']);


//还可以通过 except()方法排除系统提供的资源方法，比如:
//Route::resource('blog','Blog')->except(['read','delete','update']);

//使用 rest()方法，更改系统给予的默认方法，1.请求方式;2.地址;3.操作;



//这里的blog表示资源规则名，Blog表示路由的访问路径;
//资源路由注册成功后，会自动提供以下方法，无须手动注册;

//GET访问模式下:
//index(blog)，create(blog/create)，read(blog/:id)
//Route::resource('blog', 'Blog');
//edit(blog/:id/edit)

//POST访问模式下: save(blog);
//PUT方式模式下: update(blog/:id);
//DELETE方式模式下: delete(blog/:id);


//Route::rule('ds','Url/index');
//Route::rule('ds/:id','Url/details');

//Route::rule('ds/:id','Url/details')->cache(3600);
//有全局缓存,但是我们不要这条缓存应该怎么办
//Route::rule('ds/:id','Url/details')->cache(false);

//Route::rule('vr/:id', 'Verify/route')
//                ->validate(\app\validate\User::class, 'route');

//Route::rule('vr/:id', 'Verify/route')
//    ->validate([
//        'id'               =>      'number|between:1,10',
//        'email'            =>      \think\validate\ValidateRule::isEmail(null, '邮箱格式不正确')
//    ],null, [
//        'id.number'         =>      '编号必须是数字'
//    ], true);

//Route::rule('vc', 'Code/verify');
//Route::rule('ar/:id', 'Address/read')
//        ->middleware([Auth::class, Check::class]);

//Route::rule('ar/:id', 'Address/read')
//    ->middleware(['Auth', 'Check'], 'ok');

//Route::rule('ar/:id', 'Address/read')
//    ->middleware(function ($request, \Closure $next) {
//        if ($request->param('id') == 10) {
//            echo '管理员！';
//        }
//        return $next($request);
//    });




