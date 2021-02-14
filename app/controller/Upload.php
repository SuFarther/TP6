<?php


namespace app\controller;



use think\facade\Filesystem;
use think\facade\Request;
use think\facade\Validate;


class Upload
{
  public function index(){
      //获取表单的上传数据
      //$file = Request::file('image');
      //上传后返回的结果$info，可以输出当前上传文件的地址;
      //目录在 runtime/storage/toppic/时间/文件
      //$info = Filesystem::putFile('topic', $file);
      //$info = Filesystem::putFile('topic', $file, 'md5');

      //批量上传，使用image[]作为名称，并使用foreach()遍历上传
      //$files = Request::file('image');
      //$info = [];
      // ($files as $file)
      //{
         // $info[] = Filesystem::putFile('topic',$file,'md5');
     // }
     // dump($info);

       //上传图片文件
      $file = Request::file('image');

      //编写上传规则，必须是上传文件，必须是 jpg.png.gif 后缀
      $validate = Validate::rule([
          'image' => 'file|fileExt:jpg,png,gif'
      ]);

      //得到上传文件和规则比对
      $result = $validate->check([
         'image' => $file
      ]);

      //通过输出地址,否则输出错误
      if ($result) {
          $info = Filesystem::putFile('topic', $file);
          dump($info);
      } else {
          dump($validate->getError());
      }
  }
}