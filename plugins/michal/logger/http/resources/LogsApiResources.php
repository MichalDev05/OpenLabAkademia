<?php

namespace Michal\Logger\Http\Resources;

use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;

    class LogsApiResources{

        public static function allRecords()
        {


            return Log::get();
        }

        public static function userRecords()
        {
            return Log::where('user_id', auth()->user()->id)->get();

        }

        public static function newLog(){
            Log::create([
                'name' => auth()->user()->name,
                'user_id' => auth()->user()->id
            ]);
            return (auth()->user()->name);
        }


    }

?>
