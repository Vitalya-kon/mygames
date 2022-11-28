<?
require_once "$path/system/sysSignup.php";
?>
<!DOCTYPE html>
<html lang="ru">
<? require_once "$path/private/head.php"; ?>

<body>
    <div class="wrapper__autorization">
        <img src="../img/back/backsignup.jpg" alt="" srcset="">
        <div class="_container">
            <? require_once "$path/private/header.php" ?>
            <main class="startPage">
                <div class="entry-window__inner">
                    <div class="entry-window__item">
                        <div class="entry-window__title">Регистрация</div>
                        <div class="entry-window__form">
                            <form action="" method="post" class="formSignup">
                                <input class="entry__login" type="text" name="login" id="login" placeholder="ЛОГИН" />
                                <input class="entry__email" type="email" name="email" id="email" placeholder="EMAIL" />
                                <input class="entry__password" type="password" name="password" id="password" placeholder="ПАРОЛЬ" />
                                <input class="entry__password2" type="password" name="password2" id="password2" placeholder="ПОВТОРИТЕ ПАРОЛЬ" />
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
                                    <defs>
                                        <filter id="gooey">
                                            <!-- in="sourceGraphic" -->
                                            <feGaussianBlur in="SourceGraphic" stdDeviation="5" result="blur" />
                                            <feColorMatrix in="blur" type="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="highContrastGraphic" />
                                            <feComposite in="SourceGraphic" in2="highContrastGraphic" operator="atop" />
                                        </filter>
                                    </defs>
                                </svg>

                                <button id="gooey-button" name="send">
                                    Регистрация
                                    <span class="bubbles">
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                        <span class="bubble"></span>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
<script src="../js/validateSignup.js"></script>

</html>