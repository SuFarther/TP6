<?php
declare (strict_types = 1);

namespace app\event;

class UserEvent
{
    public function __construct()
    {
        echo '我是事件类!';
    }
}
