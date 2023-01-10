<?php 

$filePath = "log.txt";
date_default_timezone_set("Europe/Bratislava");

writeTimeDate();
main();
printFile();


function main()
{
    $hour = date("H");
    
    

    $isLate = false;
    if ($hour >= 20 && $hour<=24){
        die("To je nemožné!");
    }

    if ($hour == 8){
        if (date("i") > 0){
            //Meškanie
            $isLate = true;
        }
    }
    if ($hour > 8 ){
        
        //Meškanie
        $isLate = true;
        
    }


    
    writeToFile($isLate);
}


function writeToFile($isLate = "")
{
    $timedate = date("d/m/y-H:i:s");
    global $filePath;
    $file = fopen($filePath, "a");
    

    if ($isLate){
        fwrite($file, $timedate  . " meškanie \n");
    } else {
        fwrite($file, $timedate  . "\n");
    }
}

function printFile()
{
    global $filePath;
    $file = fopen($filePath, "r");
    $pageTxt = fread($file, filesize($filePath));
    echo(nl2br($pageTxt));
}


function writeTimeDate()
{
    echo("Dátum: " . date("d/m/y"));
    echo("<br>");
    echo("Čas: " . date("H:i:s"));
    echo("<br>");
}

?>