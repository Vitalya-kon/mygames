<?
if(isset($_SESSION['status'])){
    if($_SESSION['status']!='admin'){
     header("Location: /start");
     } 
}