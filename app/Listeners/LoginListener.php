<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  LoginEvent  $event
     * @return void
     */
    public function handle(LoginEvent $event)
    {
        /*
         * $event 里面包含了时间对象的属性
         */
        /*
         * 对用户的登录次数递增1
         */
        $event->user->login_number = $event->user->increment("login_number");
    }
}
