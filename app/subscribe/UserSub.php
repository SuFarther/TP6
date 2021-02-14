<?php
declare (strict_types = 1);

namespace app\subscribe;

class UserSub
{
    public function onUserLogin(){
        echo '处理登录后的监听!';
    }
    public function onUserLogout(){
        echo '处理退出后的监听!';
    }
}
