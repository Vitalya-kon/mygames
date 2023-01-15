<!DOCTYPE html>
<html lang="ru">
<? include "$path/private/head.php";
include "$path/system/addReviews.php" ?>

<body>
    <div class="_container">
        <? include "$path/private/header.php" ?>
        <main class="startPage">
            <div class="main__column">
                <!-- ===========menu-bar============================== -->

                <? include_once "$path/public/menuBar.php" ?>

                <!-- =========main content==================================== -->
                <div class="content">
                    <div class="theiaStickySidebar">
                        <div class="cardGame">

                            <div class="main__cardGame">

                            </div>
                            <div class="right__cardGame">
                                <div class="img__cardGame"></div>
                                <div class="similar__cardGame">
                                    <h3 class="similar__title">Похожие игры</h3>
                                    <div class="schowSimilar"></div>
                                </div>
                            </div>
                            <div class="comment__cardGame" id="comment">
                                <div class="reviews__cardGame">
                                    <h3 class="reviews__cardGame-title">Отзывы</h3>
                                    <form method = 'post' class='form__reviews'>
                                        <div class="rating-area">
                                            <input type="radio" id="star-5" name="rating" value="5">
                                            <label for="star-5" title="Оценка «5»"></label>	
                                            <input type="radio" id="star-4" name="rating" value="4">
                                            <label for="star-4" title="Оценка «4»"></label>    
                                            <input type="radio" id="star-3" name="rating" value="3">
                                            <label for="star-3" title="Оценка «3»"></label>  
                                            <input type="radio" id="star-2" name="rating" value="2">
                                            <label for="star-2" title="Оценка «2»"></label>    
                                            <input type="radio" id="star-1" name="rating" value="1">
                                            <label for="star-1" title="Оценка «1»"></label>
                                        </div>
                                        <span class="ratingShow"></span>
                                        <textarea class="reviewsText" placeholder="Напиши отзыв" name='reviewsText'></textarea>
                                        <button  class='reviewsSend' name='reviewsSend'>Отправить</button>
                                    </form>
                                </div>
                                <div class="feedBack__cardGame"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
   <script type="text/javascript" src="../js/sidbar.js"></script>
    <script>
        // ассинхронный запрос с sysCardGame.php методом POST с телом где productid = $_GET['productid'];
        setTimeout(() => {
            fetch('/system/sysCardGame.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `productid=<? echo $_GET['productid']; ?>`
            })
            // выполняется ответ с json
            .then(response => response.json())
            // ответ для выполнения кода
            .then(data => {
                // let cardGameMain = document.querySelector(".content");
                // переменная с обращением к классу main__cardGame
                let mainCardgame = document.querySelector(".main__cardGame");
                // переменная с обращением к классу img__cardGame
                let imgCardGame = document.querySelector(".img__cardGame");
                // переменная с обращением к классу whereToBuy
                let buy = document.querySelector(".whereToBuy");
                // перебор ответа в переменную row
                for (let row of data) {
                    // вывод карточки  
                    mainCardgame.innerHTML = `  
                                            <div onload="saveFav(${row.id})" class='main__description-cardGame'  >    
                                                <h1 class="title__cardGame">${row.name}</h1>
                                                <? if (isset($_SESSION['login'])) { ?>
                                                   <div class = "favorite__cardGame" id="fav" data-favid="${row.id}" onclick = "addToFav(${row.id})" >
                                                        <img src="../img/icons/favorite.png" alt="favorite">
                                                        <span data-game-favid=${row.id} class="spanFavorite"></span>
                                                    </div> 
                                                <? } ?>
                                                    
                                                <article class="desc__cardGame">
                                                    <div class ="desc__aboutGame">Об игре</div>   
                                                    <div class ="desc__info" >${row.description}</div> 
                                                    <button id="btn" class="desc__btnMore">Читать далее</button>
                                                </article> 
                                                <div class ="info__cardGame"> 
                                                    <div class ="cardGame__info releaseGame__cardGame">
                                                        <span class ="info__definition">Дата релиза:</span>
                                                        <span class="info__value">${row.releaseGame}</span>
                                                    </div>   
                                                    <div class ="cardGame__info platform__cardGame">
                                                        <p class ="info__definition">Платформы:</p>
                                                        <p class="info__value">${row.platform}</p>
                                                    </div> 
                                                    <div class ="cardGame__info genres__CardGame">
                                                        <p class ="info__definition">Жанр:</p>
                                                        <p class="info__value">${row.genres}</p>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class='video__cardGame'>
                                                <h2 class='video__cardGame-title'>Видео обзор</h2>
                                                 <div class='video__cardGame-link'>
                                                    <iframe width="650" height="366" src="${row.video}" 
                                                    frameborder="0" allowfullscreen ></iframe>
                                                 </div>
                                            </div>
                                            
                                         `;
                    imgCardGame.innerHTML = ` 
                                                    <div class="imgCardGame__item_1">
                                                        <a href="../img/image__games/${row.link_img}" data-fancybox='gallery' alt="${row.alt}">
                                                            <img width="92%" src ="../img/image__games/${row.link_img}">
                                                        </a>
                                                    </div>                                               
                                                    <div class="imgCardGame__item_2">
                                                        <a href="../img/image__games/${row.link_img_two}" data-fancybox='gallery' alt="${row.alt}">
                                                            <img src ="../img/image__games/${row.link_img_two}">
                                                        </a>
                                                    </div>    
                                                    <div class="imgCardGame__item_3">
                                                        <a href="../img/image__games/${row.link_img_three}" data-fancybox='gallery' alt="${row.alt}">
                                                            <img src ="../img/image__games/${row.link_img_three}">
                                                        </a>
                                                    </div>
                                                
                                                
                                             `
                    readMore();
                }

                let spanFavorite = document.querySelector(".spanFavorite");
                // если в localstorage при получении id == 'В избранном'
                if (localStorage.getItem(fav.dataset.favid) == "В избранном") {
                    // меняем текст в spanFavorite на "В избранном"  
                    spanFavorite.innerText = "В избранном"
                }
                // иначе
                else {
                    // меняем текст в spanFavorite на "Добавить в избранное" 
                    spanFavorite.innerText = "Добавить в избранное"
                }
            })
        }, 0);
        
            setTimeout(() => {
                
                    fetch('/system/addReviews.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        })
                        .then(response => response.text())
                        // получаем ответ как data
                        .then(data => {
                            console.log(data);
                        })
                 }, 30); 
                        
            setTimeout(() => {
                 
                        fetch('/system/showReviews.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    }
                            })
                        .then(response => response.json())
                        // получаем ответ как data
                        .then(data => {
                            let feedBack = document.querySelector(".feedBack__cardGame");
                            console.log(data);
                            for (let row of data) {
                                if (row.id == <?echo $_GET['productid'];?>) {
                                    feedBack.innerHTML += `<div>
                                                                        <span class="reviwsSender">Отправитель : ${row.login}</span>
                                                                        <span class="reviwsDate">отправлено : ${row.date}</span>
                                                                        <p class="reviwsComment">${row.text}</p>
                                                                    </div>`
                                }
                            }
                        })
                 
            }, 40);
            setTimeout(() => {
                 
                    fetch('/system/showRatingAll.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: `productid=<? echo $_GET['productid']; ?> `
                        })
                        .then(response => response.json())
                        // получаем ответ как data
                        .then(data => {
                            let ratingShow = document.querySelector(".ratingShow");
                            console.log(data);
                            for (let row of data) {
                                if (row.rating == null) {
                                    ratingShow.innerHTML = `<span class="rating__res-false"> Нет голосов</span>`
                                } else {
                                    ratingShow.innerHTML = `Средний балл :<span class="rating__res-true"> ${row.rating}</span>`
                                }

                            }
                        })
                 
            }, 10);
       


        // ассинхронный запрос с sysCardGame.php методом POST с телом где productid = $_GET['productid'];
        fetch('/system/sysSimilar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `id=<? echo $_GET['productid']; ?>`
            })
            // выполняется ответ с json
            .then(response => response.json())
            .then(data => {
                let schowSimilar = document.querySelector(".schowSimilar");
                for (let row of data) {
                    schowSimilar.innerHTML += `<div>
                                                    <a class="link__similar" href="/cardGame?productid=${row.id}">
                                                        <img width="35%" src ="../img/image__games/${row.link_img}" alt="${row.alt}">
                                                        <span class="name__similar">${row.name}</span>
                                                    </a>    
                                                </div>`
                }
            })
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="../js/favorite.js"></script>
</html>