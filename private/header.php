<?if(isset($_POST['logOut'])){
    $_SESSION['login']=NULL; // Ставим значение 0
    $_SESSION['auth']=NULL; // Ставим значение 0
    $_SESSION['status']=NULL;
    @header("Location: /start");
}?><header class="header ">
    <div class="header__content ">
        <div class="logo">
            <div class="logo__header">
                <a class="gradient-text" href="/start">myGames</a>
            </div>
        </div>
       
        <div class="header__search search">
            <form action="" method="get">
                <input class="searchInput searchInput__header" type="text" name="searchHeader" id="searchHeader" autocomplete="off" placeholder="найти игру">
                <!-- МОДАЛЬНОЕ ОКНО ДЛЯ ВЫВОДА ИНФОРМАЦИИ ИЗ БАЗЫ ДАННЫХ!  -->
                <div class="modalHeader modalHeader__header">

                </div>
                <!-- КОНЕЦ: МОДАЛЬНОЕ ОКНО ДЛЯ ВЫВОДА ИНФОРМАЦИИ ИЗ БАЗЫ ДАННЫХ!  -->
            </form>
        </div>
        <div class="header__authorization">
            <!-- МЕНЯЕМ НАДПИСИ В HEDERE ДЛЯ(ПРИ) АВТОРИЗАЦИИ -->
            <?
            // если не существует $_SESSION['auth']
            if (!isset($_SESSION['auth'])) { ?>
                <ul>
                    <li class="login__header">
                        <a class="" href="/login">войти</a>
                    </li>
                    <li class="signup__header">
                        <a class="" href="/signup">регистрация</a>
                    </li>
                </ul>
                <?
                }
                // иначе
                else {
                    // если $_SESSION['auth'] == true
                    if ($_SESSION['auth'] == true) {
                    echo "<div class='hello'><span id='spanHello' class='enterModal'>Привет:</span><span id='spanLogin' class='enterModal'>$_SESSION[login]</span></div>"; ?>
                    <div class="showModal">
                        <a class="modal" href="/profile">Профиль</a> 
                        <a class="modal" href="/favorite">Избранное</a>
                        <?
                        // если существует $_SESSION['login'] и $_SESSION['status'] == "admin"
                        if (isset($_SESSION['login']) && $_SESSION['status'] == "admin") {
                            echo "<a class='modal' href='/admin'>Admin</a>";
                        }?>
                        <form action="" method="post">
                            <input type="submit" name="logOut" value="выход">
                        </form>
                    </div>
            <? }
            } ?>
        </div>
        <div class="header__burger">
            <img src="../img/icons/burger.svg" alt="">
        </div>
        <div class="burger__modal burgerModal">
            <div class="burgerModal__icons">
                <div class="burgerModal__autorization">
                    
                            <!-- МЕНЯЕМ НАДПИСИ В HEDERE ДЛЯ(ПРИ) АВТОРИЗАЦИИ -->
            <?
            // если не существует $_SESSION['auth']
            if (!isset($_SESSION['auth'])) { ?>
                <ul>
                    <li class="signup__header">
                        <a class="" href="/signup">
                            <img src="../img/icons/login.svg" alt="">
                        </a>
                    </li>
                </ul>
                <?
                }
                // иначе
                else {
                    // если $_SESSION['auth'] == true
                    if ($_SESSION['auth'] == true) {
                    echo "<div class='hello hello__burger'>
                                <span class='enterModal' >Привет:</span><span class='enterModal'>$_SESSION[login]</span>
                        </div>"; ?>
                    <div class="showModal showModal__burger">
                        <a class="modal" href="/profile">Профиль</a> 
                        <a class="modal" href="/favorite">Избранное</a>
                        <?
                        // если существует $_SESSION['login'] и $_SESSION['status'] == "admin"
                        if (isset($_SESSION['login']) && $_SESSION['status'] == "admin") {
                            echo "<a class='modal' href='/admin'>Admin</a>";
                        }?>
                        <form action="" method="post">
                            <input type="submit" name="logOut" value="выход">
                        </form>
                    </div>
            <? }
            } ?>
                </div>
                <div class="burgerModal__close">
                    <img src="../img/icons/close.svg" alt="close" srcset="">
                </div> 
            </div>
            
            <div class="burgerModal__search search">               
                <form action="" method="get">
                    <input class="searchInput searchInput__burger" type="text" name="searchHeader"  autocomplete="off" placeholder="найти игру">
                    <!-- МОДАЛЬНОЕ ОКНО ДЛЯ ВЫВОДА ИНФОРМАЦИИ ИЗ БАЗЫ ДАННЫХ!  -->
                    <div class="modalHeader modalHeader__burger">
                    </div>
                    <!-- КОНЕЦ: МОДАЛЬНОЕ ОКНО ДЛЯ ВЫВОДА ИНФОРМАЦИИ ИЗ БАЗЫ ДАННЫХ!  -->
                </form>       
            </div>
            <div class="burgermodal__menuBar">
                <div class="menu__bar-burger ">					
                    <div class="major__link">
                        <span class="title__menu">
                            <a href="/start">Главная</a>
                        </span>
                    </div>
                    <div class="best">
                        <details>
                           <summary><span class="title__menu">Лучшее</span></summary> 
                            <ul>
                                <li><a href="/best2022">Лучшее в 2022</a></li>
                                <li><a href="/best2021">Лучшее в 2021</a></li>
                                <li><a href="/top250">Топ 250 игр</a></li>
                            </ul>  
                        </details>                      
                    </div>
                    <div class="genres">
                        <details>
                           <summary><span class="title__menu">Жанры</span></summary> 
                            <ul>
                                <li><a href="/action">Экшены</a></li>
                                <li><a href="/strategies">Стратегии</a></li>
                                <li><a href="/role-playing">Ролевые</a></li>
                                <li><a href="/shooters">Шутеры </a></li>
                                <li><a href="/adventure">Приключения </a></li>
                                <li><a href="/puzzles">Головоломки</a></li>
                                <li><a href="/races">Гонки</a></li>
                                <li><a href="/sport">Спорт</a></li>
                            </ul>
                        </details>                            
                    </div>
                    <div class="platform">
                        <details>
                           <summary><span class="title__menu">Платформа</span></summary> 
                            <ul>
                                <li><a href="/pc">PC</a></li>
                                <li><a href="/ps4">PlayStation 4</a></li>
                                <li><a href="/ps5">PlayStation 5</a></li>
                                <li><a href="/xboxone">Xbox One</a></li>
                                <li><a href="/xboxx">Xbox Series X</a></li>
                                <li><a href="/nintendo">Nintendo Switch</a></li>
                                <li><a href="">IOS</a></li>
                                <li><a href="">Android</a></li>
                            </ul> 
                        </details>                      
                    </div>
                </div>          
            </div>
        </div>
    </div>
</header>
<script src="../js/header.js">

</script>