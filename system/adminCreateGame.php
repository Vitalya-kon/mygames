<?php

// session_start();
// $path=$_SERVER['DOCUMENT_ROOT'];
// require_once "$path/system/db.php";

// если существует переменная $_POST['createGame']
if(isset($_POST['createGame'])){
    // переменная $imgGame присваиваем $_FILES['imgAddGame']
    $imgGame = $_FILES['imgAddGame'];
    // переменная $imgGame присваиваем $_FILES['imgAddGame2']
    $imgGame2 = $_FILES['imgAddGame2'];
    // переменная $imgGame присваиваем $_FILES['imgAddGame3']
    $imgGame3 = $_FILES['imgAddGame3'];
    // если выполняется функция isSecurityGames($imgGame,$imgGame2,$imgGame3)
    if (isSecurityGames($imgGame,$imgGame2,$imgGame3)){
    // выполняем функцию loadImageGame($imgGame,$imgGame2,$imgGame3);
       loadImageGame($imgGame,$imgGame2,$imgGame3);     
    } 
 }   
//  ---------- ВАЛИДАЦИЯ ИЗОБРАЖЕНИЙ------------------------------- 
// ФУНКЦИЯ isSecurityGames($imgGame,$imgGame2,$imgGame3)
    function isSecurityGames($imgGame,$imgGame2,$imgGame3){
        $name = $imgGame["name"];
        $name2 = $imgGame2["name"];
        $name3 = $imgGame3["name"];
        $type = $imgGame["type"];
        $type2 = $imgGame2["type"];
        $type3 = $imgGame3["type"];
        $size = $imgGame["size"];
        $size2 = $imgGame2["size"];
        $size3 = $imgGame3["size"];
        // переменная $blacklist присваиваем массив с (".php" , ".phtml" , ".php3" , ".php4")
        $blacklist = array(".php" , ".phtml" , ".php3" , ".php4");
        // перебор массива $blacklist как $item
        foreach ($blacklist as $item){
            // если Выполняется проверка на соответствие регулярному выражению $item $-привязка к концу строки 
            // i - регистрозависимый поиск , применяем к $name ,тогда возвращаем false
            if(preg_match("/$item\$/i" , $name)) return false;
            // если Выполняется проверка на соответствие регулярному выражению $item $-привязка к концу строки 
            // i - регистрозависимый поиск , применяем к $name2 ,тогда возвращаем false
            if(preg_match("/$item\$/i" , $name2)) return false;
            // если Выполняется проверка на соответствие регулярному выражению $item $-привязка к концу строки 
            // i - регистрозависимый поиск , применяем к $name3 ,тогда возвращаем false
            if(preg_match("/$item\$/i" , $name3)) return false;
        }
        // если $type не равен gif и не равен png и не равен jpg и не равен jpeg и не равен webp возвращаем false
        if(($type != "image/gif" ) && ($type != "image/png" ) && ($type != "image/jpg" ) && ($type != "image/jpeg" ) && ($type != "image/webp" )) return false;
        // если $type2 не равен gif и не равен png и не равен jpg и не равен jpeg и не равен webp возвращаем false
        if(($type2 != "image/gif" ) && ($type2 != "image/png" ) && ($type2 != "image/jpg" ) && ($type2 != "image/jpeg" ) && ($type != "image/webp" )) return false;
        // если $type3 не равен gif и не равен png и не равен jpg и не равен jpeg и не равен webp возвращаем false
        if(($type3 != "image/gif" ) && ($type3 != "image/png" ) && ($type3 != "image/jpg" ) && ($type3 != "image/jpeg" ) && ($type != "image/webp" )) return false;
        // если размер аватара больше 5 мегабайт возвращаем false
        if($size > 5 * 1024 * 1024) return false;
        if($size2 > 5 * 1024 * 1024) return false;
        if($size3 > 5 * 1024 * 1024) return false;
        // возвращаем true
        return true;
    }
// ---------------ЗАГРУЗКА ИЗОБРАЖЕНИЙ---------------------
// ---ФУНКЦИЯ loadImageGame($imgGame,$imgGame2,$imgGame3)
    function loadImageGame($imgGame,$imgGame2,$imgGame3){
        // переменная $type присваиваем тип загруженного аватара
        $type = $imgGame["type"];
        $type2 = $imgGame2["type"];
        $type3 = $imgGame3["type"];
       // перменной $uploaddir присваиваем путь загрузки аватара
       $uploaddir = "img/image__games/";
       // переменной $name присваиваем уникальное имя с помощью md5 в котором microtime() 
       //возвращает текущую метку времени Unix с микросекундами далее точка далее Возвращаем подстроку(тип ,возвращает длину строки)
       $nameGame = md5(microtime()).".".substr($type , strlen("image/"));
       $nameGame2 = md5(microtime()).".".substr($type2 , strlen("image/"));
       $nameGame3 = md5(microtime()).".".substr($type3 , strlen("image/"));
       // перезаписываем переменную $uploadfile и присваиваем путь точка $name
       $uploadfile = $uploaddir.$nameGame;
       $uploadfile2 = $uploaddir.$nameGame2;
       $uploadfile3 = $uploaddir.$nameGame3;
       // если Переместися загруженный файл в нашу дерикторию
       if(move_uploaded_file($imgGame["tmp_name"], $uploadfile) &&
            move_uploaded_file($imgGame2["tmp_name"], $uploadfile2) &&
            move_uploaded_file($imgGame3["tmp_name"], $uploadfile3) ){
           // запускаем функцию setAvatar с аргументами $nameGame,$nameGame2,$nameGame3
           if ($_POST["listAdmin"] == 0) {
            setGame($nameGame,$nameGame2,$nameGame3,null);
           }
           if ($_POST["listAdmin"] == 1){
            setGame($nameGame,$nameGame2,$nameGame3,1);
           }
           if ($_POST["listAdmin"] == 2){
            setGame($nameGame,$nameGame2,$nameGame3,2);
           }
           if ($_POST["listAdmin"] == 3){
            setGame($nameGame,$nameGame2,$nameGame3,3);
           }
           
           // и возвращаем true
           return true;
       }
       // иначе false
       else return false;
   }
// ----------------Похожие игры --------------------------
//    function similar($similar){
//     if (in_array("Экшен" , $similar)) {
//         return "action";
//     }
//    }
// -------------------ЗАПИСЬ НОВОЙ ИГРЫ В БД-------------------
   
   function setGame($nameGame,$nameGame2,$nameGame3,$list){
    // если в select с name listAdmin наш option равен значению 1
        $db = new PDO("mysql:dbhost=localhost;dbname=diplom","root","root");
        // делаем запрос (Добавить в game (name,releaseGame,genres,platform,link_img,link_img-2,link_img-3,description ,best2022)
        // значения (:name,:dataAdd, :genres, :platform, :link_img,:link_img2,:link_img3, :desc,1))
        $newStyle = $db -> prepare("INSERT INTO `game` (`name`,`releaseGame`,`genres`,`platform`,`video`,`alt`,`link_img`,`link_img-2`,`link_img-3`,`description`,`best2022`)
                         VALUES (:name,:dataAdd, :genres, :platform,:video,:alt,:link_img,:link_img2,:link_img3, :desc,:list)");
                $newStyle -> execute([
                    ":name" => $_POST['nameAddGame'],
                    ":dataAdd" => $_POST['dataAddGame'],
                    ":genres" => $_POST['genresAddGame'],
                    ":platform" => $_POST['platformsAddGame'],
                    ":video" => $_POST['videoAddGame'],
                    ":alt" => $_POST['nameAddGame'],
                    ":link_img" => $nameGame,
                    ":link_img2" => $nameGame2,
                    ":link_img3" => $nameGame3,
                    ":desc" => $_POST['descriptionAddGame'],
                    ":list" => $list
                ]);  
   }
    


?>