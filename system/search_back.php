<?
session_start();
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";

// Переменная с query запросом (выбрать все из game где name находит любые значения, которые имеют «$_GET[rowSearchAdvise]» в любой позиции)
// сортировка по name с начала
$searchQueryProducts=$db->query("SELECT * FROM `game` WHERE `name` LIKE '%$_GET[rowSearchAdvise]%' ORDER BY `name` ASC");
// если  переменная с query запросом Возвращает количество строк больше 0 то
if($searchQueryProducts->rowCount()>0){
// перебор значений переменная с query запросом как $row 
   foreach($searchQueryProducts as $row){
    //статическое свойство переменной $array присваивается пустой массив
    static $array=[];
    // переменной $array присваивается значения 
    $array[]=["id"=>$row["id"],"name"=>$row["name"]];
   }
}
else{
    // иначе переменной $array присваивается значения
    $array[]=["name"=>"Совпадений не найдено"];
}
// Возвращает JSON-представление данных
echo json_encode($array);