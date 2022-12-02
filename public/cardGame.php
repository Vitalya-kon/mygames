<?
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<?include "$path/private/head.php"; 
    include "$path/system/addReviews.php"?>
<body >
    <div class="_container">
        <?include "$path/private/header.php"?>
        <main class="startPage">
            <div class="main__column">
                <!-- ===========menu-bar============================== -->
                
                    <?include_once "$path/public/menuBar.php"?>
                
                <!-- =========main content==================================== -->
                <div class="content">
                    <div class="theiaStickySidebar">
                        <div class="cardGame" >
                            
                            <div class="main__cardGame" >
                                
                            </div>
                            <div class="right__cardGame">
                            
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


<script type="text/javascript" src="../js/sidbar.js"></script>
    <script>
        
        // ассинхронный запрос с sysCardGame.php методом POST с телом где productid = $_GET['productid'];
        fetch('/system/sysCardGame.php',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
            body: `productid=<?echo $_GET['productid'];?>`
        })
        // выполняется ответ с json
        .then(response => response.json())
        // ответ для выполнения кода
        .then(data => {
            // let cardGameMain = document.querySelector(".content");
            // переменная с обращением к классу main__cardGame
            let mainCardgame = document.querySelector(".main__cardGame");
            // переменная с обращением к классу img__cardGame
            let rightCardGame = document.querySelector(".right__cardGame");
            // переменная с обращением к классу whereToBuy
            let buy = document.querySelector(".whereToBuy");
            // перебор ответа в переменную row
            for(let row of data){
                // вывод карточки  
                mainCardgame.innerHTML = `  
                                            <div onload="saveFav(${row.id})" class='main__description-cardGame'  >    
                                                <h1 class="title__cardGame">${row.name}</h1>
                                                <?if (isset($_SESSION['login'])) {?>
                                                   <div class = "favorite__cardGame" id="fav" data-favid="${row.id}" onclick = "addToFav(${row.id})" >
                                                        <img src="../img/icons/favorite.png">
                                                        <span data-game-favid=${row.id} class="spanFavorite"></span>
                                                    </div> 
                                                <?}?>
                                                    
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
                                                    <iframe width="560" height="315" src="${row.video}" 
                                                    frameborder="0" allowfullscreen ></iframe>
                                                 </div>
                                            </div>
                                            <div class="comment__cardGame" id='comment' data-revid="${row.id}">
                                                <div class="reviews__cardGame">
                                                    <h3 class="reviews__cardGame-title">Отзывы</h3>
                                                    <form method = 'post' class='form__reviews'>
                                                        <textarea class="reviewsText" placeholder="Напиши отзыв" name='reviewsText'></textarea>
                                                        <button  class='reviewsSend' name='reviewsSend'>Отправить</button>
                                                    </form>
                                                </div>
                                                <div class="feedBack__cardGame"></div>
                                            </div>
                                         `;
                rightCardGame.innerHTML = ` <div class="img__cardGame">
                                                <div class="imgCardGame__item_1"><a href="../img/image__games/${row.link_img}" data-fancybox='gallery'><img width="92%" src ="../img/image__games/${row.link_img}"></a></div>
                                                
                                                <div class="imgCardGame__item_2"><a href="../img/image__games/${row.link_img_two}" data-fancybox='gallery'><img src ="../img/image__games/${row.link_img_two}"></a></div>    
                                                <div class="imgCardGame__item_3"><a href="../img/image__games/${row.link_img_three}" data-fancybox='gallery'><img src ="../img/image__games/${row.link_img_three}"></a></div>
                                            </div>
                                             ` 
            
            }  
            let btnMore = document.querySelector(".desc__btnMore");
            let descInfo = document.querySelector(".desc__info");
            
            btn.onclick = () =>{
                if (btn.classList.contains("hide")) {
                    descInfo.style.maxHeight = "15rem";
                    descInfo.style.overflow = "hidden";
                    btn.innerText = "Читать дплее";
                    btn.classList.remove("hide");

                    window.scrollTo({
                        top: 0,
                        left: 0,
                        behavior: 'smooth'
                    });
                } 
                else{
                    descInfo.style.maxHeight = "100%";
                    descInfo.style.overflow = "none";
                    btn.innerText = "Скрыть";
                    btn.classList.add("hide"); 
                }    
            }
            


            let spanFavorite = document.querySelector(".spanFavorite");
            // если в localstorage при получении id == 'В избранном'
            if (localStorage.getItem(fav.dataset.favid)=="В избранном") {
                // меняем текст в spanFavorite на "В избранном"  
                spanFavorite.innerText= "В избранном"
            }  
            // иначе
            else{
                // меняем текст в spanFavorite на "Добавить в избранное" 
                spanFavorite.innerText= "Добавить в избранное" 
            } 

            function addReviews(){
                fetch('/system/addReviews.php', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'}   
                })
                .then(response => response.text())
                    // получаем ответ как data
                    .then(data => {
                        console.log(data);
                    })
                showReviews();
            }

            function showReviews(){
                fetch('/system/showReviews.php', {
                    method: 'POST',
                    headers: {'Content-Type':'application/x-www-form-urlencoded'}   
                })
                .then(response => response.json())
                // получаем ответ как data
                .then(data => {
                    let feedBack = document.querySelector(".feedBack__cardGame");
                    console.log(data);
                    for(let row of data){
                        if (comment.dataset.revid == row.id) {
                        feedBack.innerHTML +=`<div>
                                                <p>Отправитель:${row.login}</p>
                                                <p>${row.text}</p> 
                                            </div>`  
                        }                            
                    }
                })
            }    
            showReviews()
               
        })
       
            
        
    </script>
<script  src="../js/favorite.js"></script>	
</body>

</html>