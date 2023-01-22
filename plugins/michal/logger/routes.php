<?php

use Michal\Logger\Http\Controllers\LogController;
use Michal\Logger\Models\Log;
use October\Rain\Auth\Manager;

use Rainlab\User\Facades\Auth;
use Rainlab\User\Models\User;




Route::prefix('api/v1')->group(function () {

    // Route::get("getAllRecords",function()
    // {
    //     return Log::get();
    // });



    //Route::post("loginLog", [LogsApiController::class, 'loginLog']);

    Route::get("getAllRecords", [LogController::class, 'getAllRecords']);

    Route::middleware(['auth'])->group(function () {
        Route::get("getMyRecords", [LogController::class, 'getMyRecords']);
        Route::get("newLog", [LogController::class, 'newLog']);

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
