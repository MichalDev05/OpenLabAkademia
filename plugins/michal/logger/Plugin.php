<?php namespace Michal\Logger;

use Backend;
use System\Classes\PluginBase;

/**
 * logger Plugin Information File
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
            'name'        => 'logger',
            'description' => 'No description provided yet...',
            'author'      => 'Michal',
            'icon'        => 'icon-leaf'
        ];
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
            'Michal\Logger\Components\MyComponent' => 'myComponent',
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
            'michal.logger.some_permission' => [
                'tab' => 'logger',
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
        //return []; // Remove this line to activate

        return [
            'logger' => [
                'label'       => 'logger',
                'url'         => Backend::url('michal/logger/logs'),
                'icon'        => 'icon-leaf',
                'permissions' => ['michal.logger.*'],
                'order'       => 500,
            ],
        ];
    }
}
