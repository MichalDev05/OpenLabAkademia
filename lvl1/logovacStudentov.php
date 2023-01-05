<?php 

$suborPath = "log.txt";
date_default_timezone_set("Europe/Bratislava");

NapisCasDatum();
HlavnyProces();
PrintSubor();


function HlavnyProces(){
    $hodina = date("H");
    
    

    
    if ($hodina >= 20 && $hodina<=24){
        die("To je nemožné!");
    }

    if ($hodina == 8){
        if (date("i") > 0){
            //Meškanie
            $meskanie = "meskanie";
        }
    }
    if ($hodina > 8 ){
        
        //Meškanie
        $meskanie = "meskanie";
        
    }


    
    ZapisDoSuboru($meskanie);
}


function ZapisDoSuboru($meskanie = ""){
    $datumcas = date("d/m/y-H:i:s");
    global $suborPath;
    $subor = fopen($suborPath, "a");
    

    fwrite($subor, $datumcas  . " " . $meskanie. "\n");
}

function PrintSubor(){
    global $suborPath;
    $subor = fopen($suborPath, "r");
    $pageTxt = fread($subor, filesize($suborPath));
    echo(nl2br($pageTxt));
}


function NapisCasDatum(){
    echo("Dátum: " . date("d/m/y"));
    echo("<br>");
    echo("Čas: " . date("H:i:s"));
    echo("<br>");
}

?>