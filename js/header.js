// переменная enterModal = находим все элементы с классом enterModal
let enterModal = document.querySelectorAll(".enterModal");
// цикл (i= 0;пока i меньше длинны найденых элементов с классом enterModal; i++)
for (let i = 0; i < enterModal.length; i++) {
  // устанавливаем всем перебранным элементам с классом enterModal событие клик
  enterModal[i].addEventListener("click", function () {
    // при клике id showmodal становится блочным
    showModal.style.display = "block";
  });
}
// при клике на searchHeader добавляем класс backgroundInput
searchHeader.onclick = () => searchHeader.classList.add("backgroundInput");
// при клике на документ
document.onclick = (event) => {
  // если клик произошел не на id searchHeader
  if (event.target.id != "searchHeader") {
    // удаляем у searchHeader класс backgroundInput
    searchHeader.classList.remove("backgroundInput");
    // и добавляем класс deleteBackgroundInput
    searchHeader.classList.add("deleteBackgroundInput");
  }
  // или удаляем deleteBackgroundInput
  searchHeader.classList.remove("deleteBackgroundInput");
  // если клик произошел не на id modalHeader
  if (event.target.id != "modalHeader") {
    // модальное окно исчезает
    modalHeader.style.display = "none";
  }
  // если клик произошел не на id enterModal
  if (event.target.className != "enterModal") {
    // модальное окно исчезает
    showModal.style.display = "none";
  }
};

// при заполнении инпута с id searchHeader
searchHeader.oninput = () => {
  // если длина значения заполнении инпута с id searchHeader больше 0
  if (searchHeader.value.length > 0) {
    // ассинхронный запрос на search_back.php с get выводом где $_GET(rowSearchAdvise)= значению заполнении инпута с id searchHeader
    fetch(`../system/search_back.php?rowSearchAdvise=${searchHeader.value}`)
      // ловим ответ с json
      .then((response) => response.json())
      // тело ответа
      .then((data) => {
        // модальное окно делаем видимым
        modalHeader.style.display = "grid";

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
        modalHeader.innerHTML = content;
      })
      //  ловим ошибки
      .catch((err) => {
        // прказываем модальное окно
        modalHeader.style.display = "grid";
        // с текстом Ошибка запроса"
        modalHeader.innerHTML = "Ошибка запроса";
      });
  } else {
    // иначе скрываем модальное окно
    modalHeader.style.display = "none";
  }
};
