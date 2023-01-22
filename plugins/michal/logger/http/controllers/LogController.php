<?php

namespace Michal\Logger\Http\Controllers;

use Michal\Logger\Http\Resources\LogResource;
use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;
use Illuminate\Support\Facades\Event;


    class LogController{

        public function getAllRecords()
        {


            return LogResource::collection(Log::all());
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
            Event::fire("customEvent");

            return LogResource::collection(Log::where("user_id", auth()->user()->id)->get());


        }



        public function newLog(){

            Log::create([
                'name' => auth()->user()->name,
                'user_id' => auth()->user()->id
            ]);

            return;

        }
    }

?>
