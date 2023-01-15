<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$queryShowRev = $db -> query("SELECT reviews.login, reviews.uid,reviews.text,reviews.date,game.id FROM `reviews`,`game` WHERE reviews.uid=game.id ORDER BY reviews.id DESC ")  ;

foreach($queryShowRev as $row){
    // без создания экземпляра класса создается переменная array как пустой массив
   static $array = [];
    // в массив записываем 
   $array[] = [ "id" => $row['id'],
                "text" => $row['text'],
                "login"=>$row['login'],
                "date" => $row['date']
                ];
  

}
// while($row=$queryShowRev->fetch()){
//     echo "<p>Отправитель: $_SESSION[login]</p>
//     <p>$row[text]</p>"; 
//     echo $row['id'];
// }
// переводим все в json
echo json_encode($array);