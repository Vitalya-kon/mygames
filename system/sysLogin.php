<?$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";
session_start();
//  если была  установлена переменная со значением $_POST['send']
if (isset($_POST['send'])) {
  // переменная для ошибок = пустой массив
  $errors=[];
  // если значение в поле логин пустое 
  if ($_POST['login'] == "") {
    // записываем в переменную ошибки! Запись происходит в новый порядковый индекс
    $errors[] = "Введите логин";
  }
  // если значение в поле пароль пустое 
  if ($_POST['password'] == "") {
    // записываем в переменную ошибки! Запись происходит в новый порядковый индекс
    $errors[] = "Введите пароль";
  }
  // если переменная с ошибками пуста
  if (empty($errors)) {
    // переменная с запросом в бд (выбрать все из users где логин равен введенному значению в поле логин)
    $query = $db->prepare("SELECT * FROM users WHERE `login` = :login");
    $query->execute([":login"=>$_POST['login']]);

    // если  переменная $rowCount = Возвращает количество строк, затронутых последним SQL-запросом больше 0
    if ($query->rowCount()>0) {
      // переменная passwordInDb извлекает следующую строку из результирующего набора
      $passwordInDb = $query->fetch();
      // если пароль Проверяет, соответствует ли пароль хешу выводим ura
      if(password_verify($_POST['password'],$passwordInDb['password'])){
        $time = time();
        $time = $time + 60 * 60 * 24 * 7;


      
      // создаем глобальную переменную $_SESSION['auth'] = true
      $_SESSION['id'] = $passwordInDb['id'];
      $_SESSION['auth'] = true;
      // создаем глобальную переменную $_SESSION['login'] = значению из поля логин
      $_SESSION['login'] = $passwordInDb['login'];
      $_SESSION['email'] = $passwordInDb['email'];
       // создаем глобальную переменную $_SESSION['avatar'] = значению из поля avatar
      $_SESSION['avatar'] = $passwordInDb['avatar'];
       // создаем глобальную переменную $_SESSION['status'] = значению из поля status
      $_SESSION['status'] = $passwordInDb['status'];
      
      $keyCookie = random_int(10000,99999);
      if (isset($_POST['memory'])) {
        setcookie("login" , $_POST['login'] , $time);
        setcookie('key',$keyCookie,$time);
        $db->query("UPDATE `users` SET `cookie`=$keyCookie WHERE `login`='$_POST[login]'");
      }
      // переходим на start
       header("Location:/start");
    }
      
    }
      else echo $errors[0];
    }
    
  }
  // иначе выводим ошибки


?>