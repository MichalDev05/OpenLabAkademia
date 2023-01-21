<?php

namespace Michal\Logger\Classes\Extend;


class UserExtend{
    public static function extendUser(){
        \RainLab\User\Models\User::extend(function($model) {
            $model->hasMany['logs'] = [\Michal\Logger\Models\Log::class];
        });
    }
}




?>
