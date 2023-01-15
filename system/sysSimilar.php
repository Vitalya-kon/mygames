<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$query = $db -> query("SELECT * FROM `game` WHERE `id` = '$_POST[id]'") ;
foreach ($query as $row){

    function similar($s){
        $db = new PDO("mysql:dbhost=localhost;dbname=diplom","root","root");
        $res = $db -> query("SELECT * FROM `game` WHERE similar LIKE '%$s%' AND id NOT IN ('$_POST[id]') ORDER BY RAND() LIMIT 5") ;
        foreach($res as $rows){
            // без создания экземпляра класса создается переменная array как пустой массив
           static $array = [];
            // в массив записываем 
           $array[] = [ "id" => $rows['id'],
                        "name" => $rows['name'],
                        "link_img" => $rows['link_img'],
                        "alt" => $rows['alt']
                        ];
          
        }
        echo json_encode($array);
    }
    if ($row['similar'] == "action") {
        similar('action');
    }
    if ($row['similar'] == "adventure" ) {
        similar('adventure');
    }
    if ($row['similar'] == "rolePlaying" ) {
        similar('rolePlaying');
    }
    if ($row['similar'] == "sport" ) {
        similar('sport');
    }
    if ($row['similar'] == "strategies" ) {
        similar('strategies');
    }
    if ($row['similar'] == "races" ) {
        similar('races');
    }
}