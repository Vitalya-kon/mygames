<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$fav_time_add = date("Y-m-d H:i:s");


$checkFavorite = $db->prepare("SELECT `fav_game_id`,`login` FROM `favorite` WHERE `fav_game_id` = :fav_gameId AND `login` = :login");
$checkFavorite->execute([
    ":fav_gameId"=>$_POST['id'],
    ":login" => $_SESSION['login']
]);
$rowCount=$checkFavorite->rowCount();
// Тут с помощью rowCount() мы показываем кол-во строк.

if($rowCount>0){
    echo "exist";
}

else {
    $checkFavorite = $db->prepare("INSERT INTO `favorite`(`fav_game_id`,`fav_time_add`,`amount`,`login`) VALUES (:fav_gameId,:fav_time_add,1,:login)");
    $checkFavorite->execute([
    ":fav_gameId" => $_POST['id'],
    ":fav_time_add" => $fav_time_add,
    ":login" => $_SESSION['login']
    ]);
    echo "added"; 
} 

