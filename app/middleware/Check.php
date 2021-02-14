<?php
declare (strict_types = 1);

namespace app\middleware;

class Check
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
//        if ($request->param('name') == 'index') {
//            return redirect('../');
//        }
        echo 'check';
        $request->name = 'Mr.Lee';
        return $next($request);
        //中间件代码，前置
        //return $next($request);
        //$response = $next($request); //中间件代码，后置
        return $response;
    }

    public function end(Response $response)
    {
        //中间件执行到最后执行
        echo $response->getData();
    }
}
