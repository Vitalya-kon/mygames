// переменная enterModal = находим все элементы с классом enterModal
const enterModal = document.querySelectorAll(".enterModal");
const showModal = document.querySelectorAll(".showModal")
const searchHeader = document.querySelectorAll(".searchInput");
const modalHeader = document.querySelectorAll(".modalHeader");
const burger = document.querySelector(".header__burger");
const burgerClose = document.querySelector(".burgerModal__close");
const burgerModal = document.querySelector(".burger__modal");

// цикл (i= 0;пока i меньше длинны найденых элементов с классом enterModal; i++)
for (let i = 0; i < enterModal.length; i++) {
  // устанавливаем всем перебранным элементам с классом enterModal событие клик
  enterModal[i].onclick = () => {
    // при клике id showmodal становится блочным
    for (let i = 0; i < showModal.length; i++) {
      showModal[i].style.display = "block"
    }
    
  };
}
// при клике на searchHeader добавляем класс backgroundInput
for (let i = 0; i < searchHeader.length; i++) {
  searchHeader[i].onclick = () => searchHeader[i].classList.add("backgroundInput");
}
// при клике на документ
document.onclick = (event) => {
  // если клик произошел не на id searchHeader
  if (event.target.id != "searchHeader") {
    // удаляем у searchHeader класс backgroundInput
    for (let i = 0; i < searchHeader.length; i++) {
      searchHeader[i].classList.remove("backgroundInput");
      // и добавляем класс deleteBackgroundInput
      searchHeader[i].classList.add("deleteBackgroundInput"); 
    }
    
  }
  // или удаляем deleteBackgroundInput
  for (let i = 0; i < searchHeader.length; i++) {
    searchHeader[i].classList.remove("deleteBackgroundInput");
  }
  // если клик произошел не на id modalHeader
  if (event.target.className != "modalHeader") {
    // модальное окно исчезает
    for (let i = 0; i < modalHeader.length; i++) {
     modalHeader[i].style.display = "none"; 
    }
  }
  if (event.target.className != "enterModal") {
    // модальное окно исчезает
    for (let i = 0; i < showModal.length; i++) {
      showModal[i].style.display = "none";
    }
    
  }
};
for (let i = 0; i < searchHeader.length; i++) {
  // при заполнении инпута с id searchHeader
searchHeader[i].oninput = () => {
  // если длина значения заполнении инпута с id searchHeader больше 0
  if (searchHeader[i].value.length > 0) {
    // ассинхронный запрос на search_back.php с get выводом где $_GET(rowSearchAdvise)= значению заполнении инпута с id searchHeader
    fetch(`../system/search_back.php?rowSearchAdvise=${searchHeader[i].value}`)
      // ловим ответ с json
      .then((response) => response.json())
      // тело ответа
      .then((data) => {
        console.log(data)
        // модальное окно делаем видимым
        modalHeader[i].style.display = "grid";

        // переменной content присваиваем пустую строку
        var content = "";
        // перебераем тело ответа
        data.forEach((element) => {
          // добавляем в content div с именем элемента полученного через ассинхрон
          content += `<div>
                          <ul id="listGame">
                            <li class="listCardGame">
                              <a href="/cardGame?productid=${element.id}"class="linkCardModal" data-idproduct=${element.id}>${element.name}</a>
                            </li>
                          </ul>
                        </div>`;
        });
        // выводим в модальное окно результаты
        modalHeader[i].innerHTML = content;
      })
      //  ловим ошибки
      .catch((err) => {
        // прказываем модальное окно
        modalHeader[i].style.display = "grid";
        // с текстом Ошибка запроса"
        modalHeader[i].innerHTML = "Ошибка запроса";
      });
  } else {
    // иначе скрываем модальное окно
    modalHeader[i].style.display = "none";
  }
}
  
}
burger.onclick = () =>{
  burgerModal.classList.add("showAnimationModal");
  setTimeout(() => burgerModal.classList.remove('showAnimationModal'), 500); 
  burgerModal.style.display = 'block';
  burger.style.visibility = 'hidden';
}
burgerClose.onclick = () =>{
  burgerModal.classList.add("hideAnimationModal");
  setTimeout(() => burgerModal.classList.remove('hideAnimationModal'), 500); 
  setTimeout(() => burgerModal.style.display = 'none', 300);
  burger.style.visibility = 'visible';
}
