<?php

namespace Michal\Logger\Http\Controllers;

use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;

    class LogsApiController{

        public function getAllRecords()
        {


            return Log::get();
        }

        public function loginLog()
        {
            $user = Auth::authenticate([
                'login' => post('login'),
                'password' =>  post('password')
            ]);


            Log::create([
                'name' => $user["name"],
                'user_id' => $user["id"]
            ]);

            return ($user["name"]);
        }

        public function getMyRecords()
        {


            return Log::where('user_id', auth()->user()->id)->get();

        }

        public function newLog(){
            Log::create([
                'name' => auth()->user()->name,
                'user_id' => auth()->user()->id
            ]);
            return (auth()->user()->name);
        }
    }

?>
