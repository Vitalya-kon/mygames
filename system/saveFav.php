<?
// $checkFavorite = $db->prepare("SELECT `fav_game_id`,`login` FROM `favorite` WHERE `fav_game_id` = :fav_gameId AND `login` = :login");
// $checkFavorite->execute([
//     ":fav_gameId"=>$_POST['id'],
//     ":login" => $_SESSION['login']
// ]);
// $rowCount=$checkFavorite->rowCount();
// // Тут с помощью rowCount() мы показываем кол-во строк.

// if($rowCount>0){
//     echo "В избранном";
// }
// else{
//     echo "Добавить в избранное";
// }