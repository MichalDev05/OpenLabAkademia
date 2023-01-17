<?php

use Michal\Logovac\Models\Prichod;


Route::post("api/newRecord",function()
{

    if (!isset($_POST["name"])){
        die("error: name is null");
    }


    Prichod::create([
        'name' => $_POST["name"]
    ]);

    return("New record " . $_POST["name"] . " was added!");

});




Route::get("api/getAllRecords",function()
{


    return Prichod::get();


});



?>
