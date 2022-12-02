
  // ============= ФУНКЦИЯ ДЛЯ ОТОБРАЖЕНИИ ИНФОРМАЦИИ ОБ ИГРЕ ПРИ НАВЕДЕНИИ НА СТР START.PHP=======================
  function displayInfo() {
    let linkGameInfo = document.querySelectorAll(".content__item");
    // переменная gameInfo = классу .info
    let gameInfo = document.querySelectorAll(".info");
    console.log(linkGameInfo);

    for (let i = 0; i < linkGameInfo.length; i++) {
      //  при наведение на элемент с классом .content__item"
      linkGameInfo[i].onmouseover = function () {
        // элементу с классом info меняем display block
        gameInfo[i].style.display = "block";
        // элементу с классом .content__item меняем scale (1.1)
        linkGameInfo[i].style.transform = "scale(1.1)";
        // элементу с классом .content__item меняем z-index = 777
        linkGameInfo[i].style.zIndex = "777";
      };
      // если увели мышку с элемента с классом .content__item
      linkGameInfo[i].onmouseout = function () {
        // элементу с классом info меняем display none
        gameInfo[i].style.display = "none";
        // элементу с классом .content__item меняем transform none
        linkGameInfo[i].style.transform = "none";
        // элементу с классом .content__item меняем z-index = 0
        linkGameInfo[i].style.zIndex = "0";
      };
    }
  }
  
 // переменная linkGameInfo = классу .content__item
