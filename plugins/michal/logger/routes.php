<?php

use Michal\Logger\Models\Log;


Route::post("api/newRecord",function(){

    if (!isset($_POST["name"])){
        die("error: name is null");
    }


    Log::create([
        'name' => $_POST["name"]
    ]);

    return("New record " . $_POST["name"] . " was added!");

});




Route::get("api/getAllRecords",function(){


    return Log::get();


});



?>
