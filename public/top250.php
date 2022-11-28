<?

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
				<section class="section__menu sectionMenuStikyTop" id="sectionMenu">
					<? include_once "$path/public/menuBar.php" ?>
				</section>
				<!-- =========main content==================================== -->
				<section class="content">
					<h1 class="title__content">Топ 250 игр</h1>
					<h4 class="subtitle__content"></h4>

					<div class="content__block">
						<div class="content__items">
							<? $gameItemQuery = $db->query("SELECT * FROM `game` WHERE id>0 AND `top250`=1 ORDER BY `id`");
							$numRows = $gameItemQuery->rowCount();
							foreach ($gameItemQuery as $rows) { ?>
								<div class="content__item" data-content="">
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
				</section>
			</div>
		</main>
	</div>
</body>
</html>