<?php namespace Michal\ArrivalHook;

use Backend;
use Michal\Logger\Models\Log;
use System\Classes\PluginBase;

/**
 * ArrivalHook Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'ArrivalHook',
            'description' => 'No description provided yet...',
            'author'      => 'Michal',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        Log::extend(function ($model) {
            $model->bindEvent('model.afterCreate', function () use ($model) {
                echo("Hooker Reacted! ");
            });
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Michal\ArrivalHook\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'michal.arrivalhook.some_permission' => [
                'tab' => 'ArrivalHook',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'arrivalhook' => [
                'label'       => 'ArrivalHook',
                'url'         => Backend::url('michal/arrivalhook/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['michal.arrivalhook.*'],
                'order'       => 500,
            ],
        ];
    }
}
