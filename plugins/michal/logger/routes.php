<?php

use Michal\Logger\Controllers\Logs;
use Michal\Logger\Models\Log;
use October\Rain\Auth\Manager;

use Rainlab\User\Facades\Auth;
use Rainlab\User\Models\User;




Route::prefix('api/v1')->group(function () {

    // Route::get("getAllRecords",function()
    // {
    //     return Log::get();
    // });

    Route::get("getAllRecords", [Logs::class, 'getAllRecords']);


    Route::post("loginLog", [Logs::class, 'loginLog']);

    Route::middleware(['auth'])->group(function () {
        Route::get("getMyRecords", [Logs::class, 'getMyRecords']);
        Route::get("newLog", [Logs::class, 'newLog']);

    });
    // Route::post("loginLog",function()
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



    // });

    // Route::post("newRecord",function()
    // {

    //     request()->validate(['name' => 'required']);


    //     Log::create([
    //         'name' => $_POST["name"]
    //     ]);

    //     return("New record " . $_POST["name"] . " was added!");

    // });

});

?>
