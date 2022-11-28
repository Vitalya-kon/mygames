<?php

session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

$db->query("DELETE FROM `favorite` WHERE `fav_game_id` = '$_POST[id]'");