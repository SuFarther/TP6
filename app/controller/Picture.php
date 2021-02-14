<?php


namespace app\controller;


use think\Image;

class Picture
{
  public function index()
  {
      //创建图像处理对象
      $image = Image::open('image.png');
      //dump($image);
      //图片宽度
      echo $image->width(); //图片高度
      echo $image->height(); //图片类型
      echo $image->type(); //图片 mime
      echo $image->mime(); //图片大小 dump($image->size());
      //裁剪图片
      $image->crop(550,400)->save('crop1.png');
      //生成缩略图
      $image->thumb(500,500)->save('thumb1.png');
      //使用 rotate()方法，可以旋转图片，默认是 90 度，参数可以设置;
      $image->rotate(180)->save('rotate1.png');
      //save('路径',['类型','质量','   '])，追踪到方法查看;
      //save($pathname, $type = null, $quality = 80, $interlace = true)
      //water()方法，可以给图片增加一个图片水印，默认位置为右下角，可看源码常量;
      $image->water('mr.lee.png')->save('water1.png');
      //text()方法，可以给图片增加一个文字水印，具体如下:
      $image->text('Mr.Lee',getcwd().'/1.ttf',20,'#ffffff')->save('text1.png');
  }
}