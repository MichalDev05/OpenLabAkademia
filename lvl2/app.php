
<?php 

date_default_timezone_set("Europe/Bratislava");

writeTimeDate();
main();
printArrivalsJson();
printStudentsJson();



function main()
{

    //Vyberie meno 1. z POST, 2. z query meno, 3 z query name
    if (isset($_POST["student-name"])){
        $studentName = $_POST["student-name"];
    } else if (isset($_GET["meno"])){
        $studentName =$_GET["meno"];
    } else {
        $studentName =$_GET["name"];

    }
    
    //ZapisStudentovDoJson($studentName);
    Students::writeToJSON($studentName);
    writeArrivalsJSON();
}



function writeArrivalsJSON()
{
    $arrival = new Arrival();
    
    
  
    

    //Načítanie starého Jsonu
    $jsonPath = 'prichody.json';
    $jsonfile =  file_get_contents($jsonPath);
    $fullRecordArr = json_decode($jsonfile);
    

    //Prvé miesto v Jsone sa určí číslo počtu študentov
    if (empty($fullRecordArr)){

        $fullRecordArr[0]=1;
    } else {
        $fullRecordArr[0] = sizeof($fullRecordArr);

    }
    
    
    // array_push($fullRecordArr, $arrival->get_data());
    $fullRecordArr[] = $arrival->get_data();
    $fullRecordJSON = json_encode($fullRecordArr);
    
    
  


    file_put_contents($jsonPath, $fullRecordJSON);
}



class Students
{
    
    
    public static function writeToJSON($studentName)
    {
        static $jsonPath = 'studenti.json';
        $jsonfile =  file_get_contents($jsonPath);
        $fullRecordArr = json_decode($jsonfile);
        //Prvé miesto v Jsone sa určí číslo počtu študentov
        if (empty($fullRecordArr)){
            
            $fullRecordArr =  array();
            $newOrder = 1;
        } else {
            $newOrder = sizeof($fullRecordArr) + 1;

        }

        $newStudent = $newOrder . ". " . $studentName;
        //$newStudent = new Student($studentName, $newOrder);


        // array_push($fullRecordArr, $newStudent);
        $fullRecordArr[] = $newStudent;

        $fullRecordJSON = json_encode($fullRecordArr);
        file_put_contents($jsonPath, $fullRecordJSON);
    }
}


class Arrival{
    public $dateTime;
    public $lateTxt;

    function __construct() 
    {
        $this->dateTime = date("d/m/y-H:i:s");
        if (IsLate()) {
            $this->lateTxt = " meskanie";
        }
        
    }

    function get_data()
    {
        return $this->dateTime . $this->lateTxt . $this->chanceForHearth();
    }

    //Privatna feature
    private function chanceForHearth()
    {
        if (mt_rand(0,1) == 1){
            return " <3";
        } else {
            return "";

        }
        
    }

}


function printStudentsJson()
{
    //Načítanie Jsonu
    $jsonPath = 'studenti.json';
    $jsonfile =  file_get_contents($jsonPath);
    $fullRecordArr = json_decode($jsonfile);
    
    print "<pre>";
    print_r($fullRecordArr);
    print "</pre>";

}
function printArrivalsJson()
{
    //Načítanie Jsonu
    $jsonPath = 'prichody.json';
    $jsonfile =  file_get_contents($jsonPath);
    $fullRecordArr = json_decode($jsonfile);
    
    print "<pre>";
    print_r($fullRecordArr);
    print "</pre>";

}




function IsLate()
{
    $hour = date("H");
    
 
    //Meškanie
    if ($hour >= 20 && $hour<=24){
        die("To je nemožné!");
    }

    if ($hour == 8){
        if (date("i") > 0){
            //Meškanie
            return true;
        }
    }
    if ($hour > 8 ){
        
        //Meškanie
        return true;
        
    }
    return false;
}



function writeTimeDate()
{
    echo("Dátum: " . date("d/m/y"));
    echo("<br>");
    echo("Čas: " . date("H:i:s"));
    echo("<br>");
}

?>
