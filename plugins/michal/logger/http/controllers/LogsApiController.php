<?php

namespace Michal\Logger\Http\Controllers;

use Michal\Logger\Http\Resources\LogsApiResources;
use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;
use Illuminate\Support\Facades\Event;


    class LogsApiController{

        public function getAllRecords()
        {


            return LogsApiResources::allRecords();
        }

        // public function loginLog()
        // {
        //     $user = Auth::authenticate([
        //         'login' => post('login'),
        //         'password' =>  post('password')
        //     ]);


        //     Log::create([
        //         'name' => $user["name"],
        //         'user_id' => $user["id"]
        //     ]);

        //     return ($user["name"]);
        // }

        public function getMyRecords()
        {
            echo(Event::fire("customEvent")[0] . " <br>");

            return LogsApiResources::userRecords();

        }



        public function newLog(){
            return LogsApiResources::newLog();
        }
    }

?>
