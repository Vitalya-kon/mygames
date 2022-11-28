<?
	session_start();
    $path=$_SERVER['DOCUMENT_ROOT'];
    require_once "$path/system/db.php";
    //  если была  установлена переменная со значением $_POST['send']
	if (isset($_POST['send'])) {
		// значение в поле логин присваивается значение логина и Удаляет пробелы (или другие символы) из начала и конца строки
		$_POST['send'] = trim($_POST['send']);
		// переменная $query с запросом в бд (выбрать логин из users где логин =:login )
		$query = $db->prepare("SELECT `login` FROM users WHERE `login`=:login");
		// Запускается подготовленный запрос на выполнение
		$query->execute([
			// :login присваивается значение из поля логин
			":login"=>$_POST['login']
		]);
		// переменная $rowCount = Возвращает количество строк, затронутых последним SQL-запросом
		$rowCount = $query->rowcount();
		// если $rowCount больше 0
		if ($rowCount>0) {
			// выводим сообщение
			echo "Данный пользователь есть  в базе данных";
		}
		else{
			// создаем пустой массив для ошибок
			$errors=[];
			if ($_POST['email'] == "") {
				$errors[]="Введите email!";
			}
			if ($_POST['login']=="") {
				$errors[]="Пустой логин";
				// записываем в переменную ошибки! Запись происходит в новый порядковый индекс
			}
			else{
				// используем регуляр. выражение для подбора логина! 
            	// использовать можно только символы лат. алфавита, числа, а так же "_" "-"
				$reg = "/[a-z0-9_-]{3,10}/ui";
				// если введеныое значение не совпадает с рег выражением
				if (!preg_match($reg,$_POST['login'])) {
					// записываем в переменную ошибки! Запись происходит в новый порядковый индекс
					$errors[]="Логин должен состоять из символов лат. алфавита чисел, а так же символов _ -";
				}
			}
			// если введеное значение в поле password пустая строка
			if ($_POST['password']=="") {
				// записываем в переменную ошибки! Запись происходит в новый порядковый индекс
				$errors[]="Введите пароль!";
			}
			// если введеное значение в поле password не равно введеное значение в поле password2
			if ($_POST['password']!=$_POST['password2']) {
				// записываем в переменную ошибки! Запись происходит в новый порядковый индекс
				$errors[]="Пароли не совпадают!";
			}
			
			
			// если массив с ошибками равен null
			if ($errors[0]==NULL) {
				// хэшируем значение введенное в password; 
				$_POST['password'] = password_hash($_POST['password'],FALSE);
				// переменная $querySave с запрсом (добавить в usrs в поле login,password,status,avatar) значение :login,:password,:status,:avatar
				$querySave = $db->prepare("INSERT INTO `users`(`login`,`email`,`password`,`status`,`avatar`)VALUES(:login,:email,:password,:status,:avatar)");
				// Запускается подготовленный запрос на выполнение
				$querySave->execute([
					// :login = введеное значение в поле логин
					":login"=>$_POST['login'],
					// :password = введеное значение в поле пароль
					":email"=>$_POST['email'],
					":password"=>$_POST['password'],
					// :status = Пользователь
					":status"=>"Пользователь",
					// :avatar = noavatar.png
					":avatar"=>"noavatar.png"
					
				]);
				// регистрация успешна
				$_SESSION['signup']=true;
				// перенаправление на авторизацию
				header("Location:/login");
				
			}
			else{
				// иначе выводим ошибки
				echo $errors[0];
			}
		}
	}