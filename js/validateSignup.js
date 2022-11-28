
	let validateLogin = false;
	let validatePassword = false;
	let validatePassword2 = false;
	let validateEmail = false;

	let regEmail = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
	//«^» и «$» обозначают начало и конец проверяемой строки.
	//«[\w-\.]+»разрешенные символы: «\w» — все латинские буквы, цифры и знак подчеркивания.
	// «-\.». «+»повторения символов — один или много раз.
	//«@[\w-]+». Исключаем только из набора символов точку.
 	// «\.[a-z]{2,4}». Для обозначения знака точки мы указываем её с обратным слешем «\.»
	// За точкой должно следовать доменное имя верхнего уровня. Это минимум 2 латинские буквы — «[a-z]{2,4}».

	function validateForms() {
		// Если длина значения в поле логин больше или равно 3
		if (login.value.length >= 3) {
			// делаем border 2px solid #00FF00
			login.style.border = "2px solid #00FF00";
			// переменной validateLogin присваиваем true
			validateLogin = true;
		}
		else{
			// иначе border убераем
			login.style.border = "none";
		}
		// если значение в поле email совпадает с рег выражением
		if (email.value.match(regEmail)) {
			// делаем border 2px solid #00FF00
			email.style.border = "2px solid #00FF00";
			// переменной validateEmail присваиваем true
			validateEmail = true;
		}
		else{
			// иначе border убераем
			email.style.border = "none";
		}
		// если длина значения введеное в поле password больше или равно 3 
		if (password.value.length >= 3) {
			// делаем border 2px solid #00FF00
			password.style.border = "2px solid #00FF00";
			// переменной validatePassword присваиваем true
			validatePassword = true;
		}
		else{
			// иначе border убераем
			password.style.border = "none";
		}
		// если значение в поле password равно с значением в поле password2 и password2 не равен 0
		if (password.value == password2.value && password2.value!= 0) {
			// делаем border 2px solid #00FF00
			password2.style.border = "2px solid #00FF00";
			// переменной validatePassword2 присваиваем true
			validatePassword2 = true;
			console.log(password.value);
			console.log(password2.value);
		}
		else{
			// иначе border убераем
			password2.style.border = "none";
		}
		// если validateLogin и validatePassword и validatePassword2 и true
		if (validateLogin && validatePassword && validatePassword2 && true) {
			// делаем кнопку активной
			signUp.disabled = false;
		}
	}
	// запускаем функцию через каждые 500мс
	setInterval(validateForms,500);
// при отправке формы
	formSignup.onsubmit=()=>{
		// перменная для ошибок countErrors = 0
		let countErrors = 0;
		// если длина значения в поле логин меньше 3
		if (login.value.length < 3) {
			// делаем border 2px solid red
			login.style.border = "2px solid red";
			// переменной validateLogin присваиваем true
			validateLogin = false;
			// добавляем ошибку
			countErrors++;
		}
		// если длина значения в поле пароль меньше 3
		if (password.value.length < 3) {
			// делаем border 2px solid red
			password.style.border = "2px solid red";
			// переменной validateLogin присваиваем true
			validatePassword = false;
			// добавляем ошибку
			countErrors++;
		}
	// если ошибок больше 0
		if (countErrors > 0) {
			// возвращаем false
			return false;
		}
		// возвращаем true
		return true;
	}

	