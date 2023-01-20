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
        <!-- <div class="header__burger">
            <img src="../img/icons/burger.svg" alt="">
        </div>
        <div class="burger__modal burgerModal">
            <div class="burgerModal__header">
                <div class="burgerModal__search">
                   
                <div class="burgerModal__close">
                    <img src="../img/icons/close.svg" alt="close" srcset="">
                </div>
            </div>
            <div class="burgerModal__autorization"></div>
            <div class="burgermodal__menuBar"></div>
        </div> -->
        <div class="header__search">
            <form action="" method="get">
                <input class="searchInput" type="text" name="searchHeader" id="searchHeader" autocomplete="off" placeholder="найти игру">
                <!-- МОДАЛЬНОЕ ОКНО ДЛЯ ВЫВОДА ИНФОРМАЦИИ ИЗ БАЗЫ ДАННЫХ!  -->
                <div id="modalHeader">

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
                    <div id="showModal">
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
    </div>
</header>
<script src="../js/header.js">

</script>