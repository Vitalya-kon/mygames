<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$query = $db -> query("SELECT AVG(rating) as rating FROM `reviews` WHERE uid =$_POST[productid]")  ;

foreach($query as $row){
    // без создания экземпляра класса создается переменная array как пустой массив
   static $array = [];
    // в массив записываем 
   $array[] = [ 
                "rating" =>$row['rating']
                ];
  

}
// while($row=$queryShowRev->fetch()){
//     echo "<p>Отправитель: $_SESSION[login]</p>
//     <p>$row[text]</p>"; 
//     echo $row['id'];
// }
// переводим все в json
echo json_encode($array);