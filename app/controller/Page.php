<?php


namespace app\controller;


use app\model\User;
use think\facade\View;

class Page
{
  public function index()
  {
      //获取分页显示
      $list = User::paginate([
         'list_rows' => 4,
         'var_page' => 'page',
      ]);
      //查找 user 表所有数据，每页显示 5 条
//      return View::fetch('index', [
//          'list' => User::paginate(5) ]);
//      return View::fetch('index', [
//          'list' => $list ]);
      //获取分页显示
      //$page = $list->render();
      //获取总记录数量
     // $total = $list->total();
//      return View::fetch('index', [
//          'list' => $list,'page'=>$page]);
      $list = User::paginate(3)->each(function ($item) {
          $item['gender'] = '【'.$item['gender'].'】';
          return $item;
      });

      return View::fetch('index', [
          'list'  =>  $list
      ]);
      //可以限定总记录数，比如，限定总记录数只有10条的页码;
      //->paginate(5, 10);
      // 也可以设置分页的页码为简洁分页，就是没有1，2，3，4这种，只有上下页;
      //->paginate(5, true);
  }
}