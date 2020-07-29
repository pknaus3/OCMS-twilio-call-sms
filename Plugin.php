<?php namespace Knaus\Twilio;

use Illuminate\Support\Facades\Config;
use System\Classes\PluginBase;
use App;
use Illuminate\Foundation\AliasLoader;

class Plugin extends PluginBase
{

    public function pluginDetails()
    {
        return [
            'name'        => 'twilio',
            'description' => 'No description provided yet...',
            'author'      => 'knaus',
            'icon'        => 'icon-leaf'
        ];
    }

    public function register()
    {
        $this->app->register('Aloha\Twilio\Support\Laravel\ServiceProvider');
    }

    public function bootPackages()
    {
        $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));
        $aliasLoader = AliasLoader::getInstance();
        $packages = Config::get($pluginNamespace . '::packages');

        foreach ($packages as $name => $options) {
            if (!empty($options['config']) && !empty($options['config_namespace'])) {
                Config::set($options['config_namespace'], $options['config']);
            }

            if (!empty($options['providers'])) {
                foreach ($options['providers'] as $provider) {
                    App::register($provider);
                }
            }

            if (!empty($options['aliases'])) {
                foreach ($options['aliases'] as $alias => $path) {
                    $aliasLoader->alias($alias, $path);
                }
            }
        }
    }

    public function boot()
    {
//        $this->bootPackages();
    }


}
