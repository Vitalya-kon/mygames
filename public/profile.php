<?
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";
require_once "$path/system/sysAvatar.php";
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
                    <h2 class="profile__hello">
                        <span>Привет</span> <span class='profile__long'><? echo $_SESSION['login'] ?></span>
                    </h2>
                    <div class="profile">
                        <div class="profile__avatar">
                            <img src="../img/profile_photos/<? echo $avatar1 ?>" width="92%" alt="" srcset="" class="avatar">
                            <form action="/profile" method="post" enctype="multipart/form-data">
                                <!-- <label class="input__file-profile">
	   	                                <input type="file" name="fupload" id="inputFileProfile">	
	                                	<span id="inputFileProfile-span">Выберите файл</span>
 	                                </label> -->
                                <label class="input-file">
                                    <input type="file" name="fupload" id="inputFileProfile">
                                    <span>Выберите файл</span>
                                </label>
                                <input type="submit" class="avatar__submit" name="set_avatar" value="Загрузить">
                            </form>
                        </div>
                        <div class="profile__info">
                            <p class="profile__info-p">Твое Имя : <span> <? echo $_SESSION["login"] ?></span></p>
                            <p class="profile__info-p">Твой email : <span><? echo $_SESSION["email"] ?></span></p>
                            <p class="profile__info-p">Твой статус :<span> <? echo $_SESSION["status"] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

<script src="../js/inputFile.js"></script>

</html>