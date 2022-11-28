<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

if (isset($_POST['editSend'])) {
    if( isset($_POST['name']) )
{
    $username= $_POST['name'];
    $id  = $_SESSION['id'];
    $sql  =$db->query( "UPDATE users SET login='$username' WHERE id=$id");
    $sql->fetch();
    var_dump($sql) ;
}
}