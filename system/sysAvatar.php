<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

//создаем переменную $avatar1 с функцией getAvatar с аргументом $_SESSION['login']
$avatar1 = getAvatar($_SESSION['login']);
// если переменная $avatar1 пуста то присваиваем переменной $avatar1 значение noavatar.png
if($avatar1 == '') $avatar1 = "noavatar.png";

// если была  установлена переменная со значением $_POST['set_avatar']
if (isset ($_POST['set_avatar'])) {
    // создаем переменную $avatar и присваиваем глобальнуб переменную $_FILES["fupload"]
    $avatar = $_FILES["fupload"];
    // если функция isSecurity с аргументом $avatar вернет true
    if (isSecurity($avatar)){
        // запускаем функцию loadAvatar с аргументами $avatar , $_SESSION['login']
       loadAvatar($avatar , $_SESSION['login']); 
    //    и перезагружаем страницу
       header("Refresh:0");
    } 
    // иначе переменной $message присваиваем "Error"
    else $message = "Error";
}   
// функция получения аватара getAvatar с аргументом $login
function getAvatar($login){
    // переменная $db присваиваем подключение к нашей бд
    $db = new PDO("mysql:dbhost=localhost;dbname=diplom","root","root");
    // делаем запрос в бд (выбрать колонку avatar из  таблицы users где `login` = '$login')
    $result_set = $db->query("SELECT `avatar` FROM `users` WHERE `login` = '$login'");
    // в перменную row записываем результат из бд в ассоциативном массиве
    $row = $result_set->fetch(PDO::FETCH_ASSOC);
    // возвращаем ответ из бд из колонки avatar в виде ассоциативного массива
    return $row["avatar"];

}
// функция для защиты загрузки аватара isSecurity с аргументом $avatar
function isSecurity($avatar){
    // переменная $name присваиваем имя загруженного аватара
    $name = $avatar["name"];
    // переменная $type присваиваем тип загруженного аватара
    $type = $avatar["type"];
    // переменная $size присваиваем размер загруженного аватара
    $size = $avatar["size"];
    // перменной $blacklist присваиваем массив со значениями
    $blacklist = array(".php" , ".phtml" , ".php3" , ".php4");
    // перебор массива $blacklist как $item
    foreach ($blacklist as $item){
        // если регулярное выражение совпадает с значениями из массива с нашем именем аватара то возвращаем false
        if(preg_match("/$item\$/i" , $name)) return false;
    }
    // если тип аватара не равен image/gif и image/png" и image/jpg и image/jpeg возвращаем false
    if(($type != "image/gif" ) && ($type != "image/png" ) && ($type != "image/jpg" ) && ($type != "image/jpeg" )) return false;
    // если размер аватара больше 5 мегабайт возвращаем false
    if($size > 5 * 1024 * 1024) return false;
    // возвращаем true
    return true;
}
// функция загрузки аватара loadAvatar с аргументами $avatar , $login
function loadAvatar($avatar , $login){
     // переменная $type присваиваем тип загруженного аватара
    $type = $avatar["type"];
    // перменной $uploaddir присваиваем путь загрузки аватара
    $uploaddir = "img/profile_photos/";
    // переменной $name присваиваем уникальное имя с помощью md5 в котором microtime() 
    //возвращает текущую метку времени Unix с микросекундами далее точка далее Возвращаем подстроку(тип ,возвращает длину строки)
    $name = md5(microtime()).".".substr($type , strlen("image/"));
    // перезаписываем переменную $uploadfile и присваиваем путь точка $name
    $uploadfile = $uploaddir.$name;
    // если Переместлся загруженный файл в нашу дерикторию
    if(move_uploaded_file($avatar["tmp_name"], $uploadfile)){
        // запускаем функцию setAvatar с аргументами $login , $name
        setAvatar($login , $name);
        // и возвращаем true
        return true;
    }
    // иначе false
    else return false;
}
// функция записи имени аватара в бд setAvatar с аргументами $login , $name
function setAvatar($login , $name){
//    подключаемся к нашей бд
    $db = new PDO("mysql:dbhost=localhost;dbname=diplom","root","root");
    // если $login пуст то возвращаем false
    if($login == "") return false;
    // записываем в бд (Обновляем значения в таблице users и записываем в колонку avatar наше имя загруженного аватара 
    //где логин $login)
    $db->query("UPDATE `users` SET `avatar`='$name' WHERE `login` = '$login'");

}