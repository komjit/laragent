<?php

namespace KomjIT\LarAgent;

use Illuminate\Support\ServiceProvider;

class LarAgentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laragent');
    }

    public function register()
    {
    }
}

?>
