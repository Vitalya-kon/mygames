<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

// Если глобальная переменная $_POST['productid'] отсутвует , тогда выход.
if(empty($_POST['productid'])){
    exit;
}
// Запрос в бд (Выбрать все из game где id=глобальная переменная $_POST['productid'] )
$query = $db -> query("SELECT * FROM game WHERE id =$_POST[productid]");
// $result = $query -> fetch(PDO::FETCH_ASSOC);
// $arr = ["id"=>$result['id'], "name"=>$result['name'],"link_img" => $row['link_img']];



// Перебор переменной query как переменная row
foreach($query as $row){
    // без создания экземпляра класса создается переменная array как пустой массив
   static $array = [];
    // в массив записываем 
   $array[] = [ "id" => $row['id'],
                "name" => $row['name'],
                "link_img" => $row['link_img'],
                "link_img_two" => $row['link_img-2'],
                "link_img_three" => $row['link_img-3'],
                "video"=>$row['video'],
                "alt" => $row['alt'],
                "releaseGame" => $row['releaseGame'],
                "genres" => $row['genres'],
                "platform"=>$row['platform'],
                "description"=>$row['description'],
                ];


}
// переводим все в json
echo json_encode($array);
