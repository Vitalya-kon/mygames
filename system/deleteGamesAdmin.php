<?
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $query =  $db -> query("DELETE FROM `game` WHERE id=$id");
}