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

				</div>

			</div>
		</main>
	</div>
</body>
<script type="text/javascript" src="../js/sidbar.js"></script>

</html>