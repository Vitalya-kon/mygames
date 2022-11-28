// ##### ФУНКЦИЯ addToCard(id) при клике на div class = "favorite__cardGame"(ДОБАВЛЕНИЕ В ИЗБРАННОЕ)
function addToFav(id) {
  // переменная spanFavorite - выбираем класс spanFavorite
  let spanFavorite = document.querySelector(".spanFavorite");
  // fetch запрос на system/favToAdd.php с методом POST и передаем в body id которй присваиваем аргумент
  // функции id
  fetch("/system/favToAdd.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "id=" + id,
  })
    // ответ как текст
    .then((response) => response.text())
    // получаем ответ как data
    .then((data) => {
      // если data == added
      if (data == "added") {
        // записывем в localstorage (переданный аргумент функции id как ключ, "В избранном" как значение)
        localStorage.setItem(id, "В избранном");
        // если в localstorage при получении id == 'В избранном'
        if (localStorage.getItem(id) == "В избранном") {
          // меняем текст в spanFavorite на "В избранном"
          spanFavorite.innerText = "В избранном";
        }
      }
      // если data == exist
      if (data == "exist") {
        // удаляем из localstorage значение с переданным аргументом функции id
        localStorage.removeItem(id);
        // меняем текст в spanFavorite на "Добавить в избранное"
        spanFavorite.innerText = "Добавить в избранное";
        // fetch запрос на system/delFavGame.phpс методом POST и передаем в body id которй присваиваем аргумент
        // функции id
        fetch("/system/delFavGame.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "id=" + id,
        });
      }
    });
}
