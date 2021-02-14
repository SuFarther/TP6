<?php
declare (strict_types = 1);

namespace app\listener;


class TestOne
{
    /**
     * 事件监听处理
     *
     * @return mixed
     */
    public function handle($event)
    {
        echo '我是监听类1!'.$event;
    }
}