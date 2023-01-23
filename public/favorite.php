<?
$path=$_SERVER['DOCUMENT_ROOT'];
require_once "$path/system/db.php";
?>
<!DOCTYPE html>
<html lang="en">
<?include_once "$path/private/head.php"; ?>
<body>
	 <div class="_container">
		<?include_once "$path/private/header.php";?>
		<main class="startPage">
			<div class="main__column">
				<!-- ===========menu-bar============================== -->
				
					<?include_once "$path/public/menuBar.php"?>
				
				<!-- =========main content==================================== -->
				<div class="content">
					<div class="theiaStickySidebar">
						<div class="favorite main__content">
							<h2 class="hello__content">
								<span>Привет</span> <span class='profile__long'><? echo $_SESSION['login']?></span>
							</h2>
							<h3 class="subtitle__mainContent">Здесь избранные игры</h3>
							<div class="content__block">
								<div class="content__items" id="contentFav">		
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</main>
	 </div>
</body>

<script>
	 fetch('/system/showFav.php',{
            method:'POST',
            headers:{'Content-Type':'application/x-www-form-urlencoded'},
        })
        // выполняется ответ с json
        .then(response => response.json())
        // ответ для выполнения кода
        .then(data => {
            console.log(data);
            for(let row of data){
                // вывод карточки  
                contentFav.innerHTML +=`
										<div class="content__item favGame" data-content="">
											<!-- ссылка на cardGame с productid равное id из бд -->
											<a href="/cardGame?productid=${row.id}"  class="linkCard" data-idproduct=${row.id}>
												<div class="image__item">
													<img src="../img/image__games/${row.link_img}" alt="${row.alt}">
												</div>
												<div class="name__item">${row.name}</div>
											</a>
											<div class="info infoFav" data-info="" >
												<div class="info__item release-content">
													<span class="key">Дата выхода:</span>
													<span class="value">${row.releaseGame}</span>
												</div>
												<div class="info__item genres-content">
													<span class="key">Жанры:</span>
													<span class="value">${row.genres}</span>
												</div>
												<div class="info__item platform-content">
													<span class="key">Платформа:</span>
													<span class="value">${row.platform}</span>
												</div>
											</div>
										</div>
				`
				displayInfo();
            }      
        })
</script>
<script >
			
</script>
<script type="text/javascript" src="../js/sidbar.js"></script>

</html>