<?php

namespace OkamiChen\TmsWechat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use OkamiChen\TmsWechat\Observer\WechatObserver;
use OkamiChen\TmsWechat\Entity\Wechat;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        'OkamiChen\TmsTask\Console\Command\ExecuteCommand',
    ];
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'tms-wechat');
        
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'tms-wechat-config');
            //$this->publishes([__DIR__.'/../resources/views' => resource_path('views/vendor/tms/wechat')],'tms-wechat-views');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'tms-wechat-migrations');
        }
        
        $this->registerRoute();
        $this->registerObserver();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //$this->commands($this->commands);
    }
    
    protected function registerRoute(){
        
        $attributes = [
            'prefix'     => config('admin.route.prefix'),
            'namespace'  => 'OkamiChen\TmsWechat\Controller',
            'middleware' => config('admin.route.middleware'),
        ];

        Route::group($attributes, function (Router $router) {
            $router->resource('wechat', 'WechatController',['as'=>'tms']);
        });
    }
    
        
    protected function registerObserver(){
        Wechat::observe(WechatObserver::class);
    }

}
