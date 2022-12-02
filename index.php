<?php session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

// если $_SESSION['login'] не пустой 
if(!empty($_SESSION['login'])){
     // если была  установлена переменная со значением $_COOKIE['login']
     if(isset($_COOKIE['login'])){
     //     переменная $cookieSQL с запросом в бд (выбрать все из users где login`='$_COOKIE[login])
        $cookieSQL =  $db -> query("SELECT * FROM `users` WHERE `login`='$_COOKIE[login]'");
     //    переменная $countCookie = Возвращает количество строк, затронутых последним SQL-запросом
        $countCookie = $cookieSQL ->rowCount();
          // если $countCookie больше 0 
        if($countCookie>0):
          // переменная $cookieSQL = $cookieSQL Извлечение следующей строки из результирующего набора как ассоциативный массив
          $cookieSQL = $cookieSQL->fetch(PDO::FETCH_ASSOC);
          // если $cookieSQL['cookie'] равен $_COOKIE['key']
           if($cookieSQL['cookie'] == $_COOKIE['key']){
               // тогда $_SESSION['login'] присваивается $_COOKIE['login']
               $_SESSION['login'] = $_COOKIE['login'];
           }
        endif;
         

     }
     
}

switch(@$_SERVER['REDIRECT_URL']){

    case "":
         require_once "$path/public/start.php";
    break;

    case "/start":
         require_once "$path/public/start.php";
    break;

    case "/signup":
        require_once "$path/public/signup.php";
    break;

    case "/login":
         require_once "$path/public/login.php";
    break;
    case "/menuBar":
         require_once "$path/public/menuBar.php";
    break;
    case "/best2022":
         require_once "$path/public/best2022.php";
    break;
    case "/best2021":
         require_once "$path/public/best2021.php";
    break;
    case "/top250":
         require_once "$path/public/top250.php";
    break;
    case "/cardGame":
          require_once "$path/public/cardGame.php";
     break;
    case "/profile":
          require_once "$path/public/profile.php";
     break;
    case "/admin":
          require_once "$path/public/admin.php";
     break;
    case "/editProfile":
          require_once "$path/public/editProfile.php";
     break;
    case "/favorite":
          require_once "$path/public/favorite.php";
     break;
    case "/action":
          require_once "$path/public/genres/genres-action.php";
     break;
    case "/strategies":
          require_once "$path/public/genres/genres-strategies.php";
     break;
    case "/role-playing":
          require_once "$path/public/genres/genres-rolePlaying.php";
     break;
    case "/shooters":
          require_once "$path/public/genres/genres-shooters.php";
     break;
    case "/adventure":
          require_once "$path/public/genres/genres-adventure.php";
     break;
    case "/races":
          require_once "$path/public/genres/genres-races.php";
     break;
    case "/puzzles":
          require_once "$path/public/genres/genres-puzzles.php";
     break;
    case "/sport":
          require_once "$path/public/genres/genres-sport.php";
     break;
    case "/pc":
          require_once "$path/public/platform/platform-pc.php";
     break;
    case "/ps4":
          require_once "$path/public/platform/platform-ps4.php";
     break;
    case "/ps5":
          require_once "$path/public/platform/platform-ps5.php";
     break;
    case "/xboxone":
          require_once "$path/public/platform/platform-xboxone.php";
     break;
    case "/xboxx":
          require_once "$path/public/platform/platform-xboxx.php";
     break;
    case "/nintendo":
          require_once "$path/public/platform/platform-nintendo.php";
     break;
     default:
           require_once "$path/public/404.php";
}
