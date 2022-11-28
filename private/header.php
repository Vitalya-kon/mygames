<header class="header">
    <div class="header__content">
        <div class="logo">
            <div class="logo__header">
                <a class="gradient-text" href="/start">myGames</a>
            </div>
        </div>
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
                        } ?>
                        <form action="" method="post">
                            <input type="submit" name="logOut" value="выход">
                        </form>
                        <?
                        // если нажата кнопка $_POST['logOut']
                        if (isset($_POST['logOut'])) {
                            // удаляем $_SESSION['login']
                            $_SESSION['login'] = NULL;
                            // удаляем $_SESSION['auth']
                            $_SESSION['auth'] = NULL;
                            // переменная time()
                            $time2 = time();
                            // вычитаем время для удалении кук
                            $time2 = $time2 - 60 * 60 * 24 * 7;
                            setcookie("login", $_POST['login'], $time);
                            setcookie('key', $keyCookie, $time);
                            header("Location:/start");
                        } ?>
                    </div>
            <? }
            } ?>
        </div>
    </div>
</header>
<script src="../js/header.js">

</script>