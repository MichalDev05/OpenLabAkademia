<?php

namespace Michal\Logger\Http\Controllers;

use Michal\Logger\Http\Resources\LogResource;
use Rainlab\User\Facades\Auth;
use Michal\Logger\Models\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Routing\Controller;


class LogController extends Controller{

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

        $log = new Log;
        $log->user_id =auth()->user()->id;
        $log->name =auth()->user()->name;
        $log->save();
        return LogResource::make($log);


    }
}

?>
