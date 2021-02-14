<?php


namespace app\controller;


class HelloWorld
{
  public  function  index(){
      return 'index';
  }

  //http://www.juzss.com/tp6/public/helloworld/arrayoutput
  public function arrayOutput()
  {
    $arr = ['a'=>1,'b'=>2,'c'=>3];
    halt('中断输出');
    return json($arr);
  }
}