<?

session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$query = $db->query("SELECT * FROM `game` WHERE genres LIKE '%Ролевые%'");

foreach($query as $row){
    // без создания экземпляра класса создается переменная array как пустой массив
   static $array = [];
    // в массив записываем 
   $array[] = [ "id" => $row['id'],
                "name" => $row['name'],
                "link_img" => $row['link_img'],
                "alt" => $row['alt'],
                "releaseGame" => $row['releaseGame'],
                "genres" => $row['genres'],
                "platform"=>$row['platform'],
                ];
  
}
echo json_encode($array);