<?

session_start();
$path = $_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<? include_once "$path/private/head.php"; ?>
<body>
	<div class="_container">
		<? include_once "$path/private/header.php"; ?>
		<main class="startPage">
			<div class="main__column">
				<!-- ===========menu-bar============================== -->
				<? include_once "$path/public/menuBar.php" ?>
				<!-- =========main content==================================== -->
				<div class="content">
					<div class="theiaStickySidebar">
						<h2 class="title__content">Новое и актуальное </h2>
						<h4 class="subtitle__content">На основе количества игроков и даты релиза</h4>

						<div class="content__block">
							<div class="content__items" id="contentItems">
								<?

								// переменная $gameItemQuery с запросом в бд (выбрать все из game где id больше 0 сортировка по id)
								$gameItemQuery = $db->query("SELECT * FROM `game` WHERE id>0  ORDER BY `id` DESC");
								// // переменная $numRows = Возвращает количество строк, затронутых последним SQL-запросом
								$numRows = $gameItemQuery->rowCount();
								// перебор $gameItemQuery как $row
								foreach ($gameItemQuery as $rows) {

								?>
									<div class="content__item" data-content="" onload='displayInfo()'>
										<!-- ссылка на cardGame с productid равное id из бд -->
										<a href="/cardGame?productid=<? echo $rows['id'] ?>" class="linkCard" data-idproduct=<? echo $rows['id'] ?>>
											<div class="image__item">
												<img src="../img/image__games/<? echo $rows['link_img']; ?>" alt="<? echo $rows['alt'] ?>">
											</div>
											<div class="name__item"><? echo $rows['name']; ?></div>
										</a>
										<div class="info" data-info="">
											<div class="info__item release-content">
												<span class="key">Дата выхода:</span>
												<span class="value"><? echo $rows['releaseGame']; ?></span>
											</div>
											<div class="info__item genres-content">
												<span class="key">Жанры:</span>
												<span class="value"><? echo $rows['genres']; ?></span>
											</div>
											<div class="info__item platform-content">
												<span class="key">Платформа:</span>
												<span class="value"><? echo $rows['platform']; ?></span>
											</div>
										</div>
									</div>
								<? } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>

<script>displayInfo();</script>
<scriptt type="text/javascript" src="../js/sidbar.js"></scriptt>
</html>