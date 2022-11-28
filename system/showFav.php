<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$query = $db->prepare("SELECT favorite.fav_game_id,favorite.login,game.id,game.name,game.releaseGame,game.genres,game.platform,game.link_img,game.alt,game.description
FROM `favorite`,`game` WHERE favorite.fav_game_id = game.id AND favorite.login = :login");
 $query->execute([
    ":login"=>$_SESSION['login']
]);

foreach($query as $row){
    // без создания экземпляра класса создается переменная array как пустой массив
   static $array = [];
    // в массив записываем 
   $array[] = [  "id" => $row['id'],
                "name" => $row['name'],
                "link_img" => $row['link_img'],
                "alt" => $row['alt'],
                "releaseGame" => $row['releaseGame'],
                "genres" => $row['genres'],
                "platform"=>$row['platform'],
                "description"=>$row['description']
                ];
}
// переводим все в json
echo json_encode($array);