
<?php 

$suborPath = "log.txt";
date_default_timezone_set("Europe/Bratislava");

NapisCasDatum();
Main();
PrintPrichodyJson();
PrintStudentiJson();



function Main(){

    //Vyberie meno 1. z POST, 2. z query meno, 3 z query name
    if (isset($_POST["student-name"])){
        $studentName = $_POST["student-name"];
    } else if (isset($_GET["meno"])){
        $studentName =$_GET["meno"];
    } else {
        $studentName =$_GET["name"];

    }
    
    //ZapisStudentovDoJson($studentName);
    Studenti::ZapisDoJson($studentName);
    ZapisPrichodovDoJson();
}



function ZapisPrichodovDoJson(){
    $prichod = new Prichod();
    
    
  
    

    //Načítanie starého Jsonu
    $jsonPpath = 'prichody.json';
    $jsonfile =  file_get_contents($jsonPpath);
    $celyZaznamArr = json_decode($jsonfile);
    

    //Prvé miesto v Jsone sa určí číslo počtu študentov
    if (empty($celyZaznamArr)){

        $celyZaznamArr[0]=1;
    } else {
        $celyZaznamArr[0] = sizeof($celyZaznamArr);

    }
    
    
    array_push($celyZaznamArr, $prichod->get_data());
    $celyZaznamJson = json_encode($celyZaznamArr);
    
    
  


    file_put_contents($jsonPpath, $celyZaznamJson);
}



class Studenti{
    
    
    public static function ZapisDoJson($studentName)
    {
        static $jsonPath = 'studenti.json';
        $jsonfile =  file_get_contents($jsonPath);
        $celyZaznamArr = json_decode($jsonfile);
        //Prvé miesto v Jsone sa určí číslo počtu študentov
        if (empty($celyZaznamArr)){
            
            $celyZaznamArr =  array();
            $novePoradie = 1;
        } else {
            $novePoradie = sizeof($celyZaznamArr) + 1;

        }

        $novyStudent = $novePoradie . ". " . $studentName;
        //$novyStudent = new Student($studentName, $novePoradie);


        array_push($celyZaznamArr, $novyStudent);

        $celyZaznamJson = json_encode($celyZaznamArr);
        file_put_contents($jsonPath, $celyZaznamJson);
    }
}


class Prichod{
    public $datumcas;
    public $meskanie;

    function __construct() {
        $this->datumcas = date("d/m/y-H:i:s");
        if (IsMeskanie()) {$this->meskanie = " meskanie";}
        
    }

    function get_data(){
        return $this->datumcas . $this->meskanie . $this->chanceForHearth();
    }

    //Privatna feature
    private function chanceForHearth(){
        if (mt_rand(0,1) == 1){
            return " <3";
        } else {
            return "";

        }
        
    }

}


function PrintStudentiJson(){
    //Načítanie Jsonu
    $jsonPpath = 'studenti.json';
    $jsonfile =  file_get_contents($jsonPpath);
    $celyZaznamArr = json_decode($jsonfile);
    
    print "<pre>";
    print_r($celyZaznamArr);
    print "</pre>";

}
function PrintPrichodyJson(){
    //Načítanie Jsonu
    $jsonPpath = 'prichody.json';
    $jsonfile =  file_get_contents($jsonPpath);
    $celyZaznamArr = json_decode($jsonfile);
    
    print "<pre>";
    print_r($celyZaznamArr);
    print "</pre>";

}




function IsMeskanie(){
    $hodina = date("H");
    
 
    //Meškanie
    if ($hodina >= 20 && $hodina<=24){
        die("To je nemožné!");
    }

    if ($hodina == 8){
        if (date("i") > 0){
            //Meškanie
            return true;
        }
    }
    if ($hodina > 8 ){
        
        //Meškanie
        return true;
        
    }
    return false;
}



function NapisCasDatum(){
    echo("Dátum: " . date("d/m/y"));
    echo("<br>");
    echo("Čas: " . date("H:i:s"));
    echo("<br>");
}

?>