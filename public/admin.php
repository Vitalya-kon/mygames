<?
session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";
require_once "$path/system/status.php";
require_once "$path/system/adminCreateGame.php";
require_once "$path/system/deleteGamesAdmin.php";
?>
<!DOCTYPE html>
<html lang="ru">
<? include "$path/private/head.php"; ?>

<body>
    <div class="_container">
        <? include "$path/private/header.php" ?>

        <main class="startPage">
            <div class="main__column">
                <!-- ===========menu-bar============================== -->

                <? include_once "$path/public/menuBar.php" ?>

                <!-- =========main content==================================== -->
                <div class="content">
                    <div class="admin main__content">
                        <div class="admin__hello hello__content">

                            <span>Привет: </span> <span class='admin__long'><? echo $_SESSION['login'] ?></span>
                        </div>
                        <div class="content__admin">

                            <div class="content__admin-left">
                                <h3 class="subtitle__mainContent">Давай добавим игру</h3>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div>Название</div>
                                    <input type="text" name="nameAddGame" id="nameAddGame">
                                    <div>Описание</div>
                                    <textarea name="descriptionAddGame" id="" cols="30" rows="10"></textarea>
                                    <div>Жанры</div>
                                    <input type="text" name="genresAddGame" id="genresAddGame">
                                    <div>Платформы</div>
                                    <input type="text" name="platformsAddGame" id="platformsAddGame">
                                    <div>Дата выхода</div>
                                    <input type="date" name="dataAddGame" id="dataAddGame">
                                    <div>Ссылка на видео игры</div>
                                    <input type="text" name="videoAddGame" id="videoAddGame">
                                    <div>Выберите категорию</div>
                                    <select name="listAdmin" id="list__admin-left">
                                        <option value="Выберете из списка">Выберете из списка</option>
                                        <option value="0">(нет)</option>
                                        <option value="1">Лучшее в 2022</option>
                                        <option value="2">Лучшее в 2021</option>
                                        <option value="3">Топ 250 игр</option>
                                    </select>
                                    <div>Основная картинка</div>
                                    <label class="input-file adminFile">
                                        <input type="file" name="imgAddGame" id="">
                                        <span>Выберите файл</span>
                                    </label>
                                    <div>Дополнительная картинка</div>
                                    <label class="input-file">
                                        <input type="file" name="imgAddGame2" id="">
                                        <span>Выберите файл</span>
                                    </label>
                                    <div>Добавь еще одну</div>
                                    <label class="input-file">
                                        <input type="file" name="imgAddGame3" id="">
                                        <span>Выберите файл</span>
                                    </label>
                                    <input type="submit" id="sendAddGame" name="createGame" value="Отправить">
                                </form>
                            </div>
                            <div class="content__admin-right">
                                <script>
                                    // 
                                    fetch('/system/getGamesAdmin.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded'
                                            },
                                            body: `productid=<? echo $_POST['productid']; ?>`
                                        })
                                        // выполняется ответ с json
                                        .then(response => response.json())
                                        .then(data => {

                                            let rightGames = document.querySelector(".content__admin-right");
                                            for (let row of data) {
                                                rightGames.innerHTML += `
                                                                        <div class = "listGamesAdmin">
                                                                            <div>
                                                                                <img class = 'listGamesAdmin_img' src="../img/image__games/${row.link_img}" alt="${row.alt}">
                                                                                <span class = 'listGamesAdmin_name'>${row.name}</span>
                                                                            </div>
                                                                            <a href='?del=${row.id}' class = 'listGamesAdmin_delete'><img src="../img/icons/delete.png" alt="удалить"></a>
                                                                        </div>

                                                                         `
                                                }
                                        })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
<script type="text/javascript" src="../js/sidbar.js"></script>
<script src="../js/inputFile.js"></script>

</html>