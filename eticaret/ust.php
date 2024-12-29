<?php
include "../yonet/baglan.php";

$ayar = $db->prepare("SELECT * FROM ayar");
$ayar->execute();
$ayar = $ayar->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
	<title><?php echo $ayar['ayar_baslik'] ?></title>
	<meta charset="UTF-8">
	<meta name="description" content="<?php echo $ayar['ayar_aciklama'] ?>">
	<meta name="keywords" content="<?php echo $ayar['ayar_anahtarkelime'] ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon" />

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css" />
	<link rel="stylesheet" href="css/flaticon.css" />
	<link rel="stylesheet" href="css/slicknav.min.css" />
	<link rel="stylesheet" href="css/jquery-ui.min.css" />
	<link rel="stylesheet" href="css/owl.carousel.min.css" />
	<link rel="stylesheet" href="css/animate.css" />
	<link rel="stylesheet" href="css/style.css" />


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search on divisima ....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="#">Sign</a> In or <a href="#">Create Account</a>
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span id="SepetAdet">0</span>
								</div>
								<a href="#">Shopping Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="./">Ana sayfa</a></li>
					<?php
					$sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=0 ORDER BY kategori_sira');
					$sorgu->execute();

					while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
						echo '<li><a href="#">' . $satir['kategori_adi'] . '</a>';
						$sorgu2 = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=? ORDER BY kategori_sira');
						$sorgu2->execute(array($satir['kategori_id']));

						if ($sorgu2->rowCount() > 0) {
							echo '<ul class="sub-menu">';
							while ($satir2 = $sorgu2->fetch(PDO::FETCH_ASSOC)) {
								echo '<li><a href="#">' . $satir2['kategori_adi'] . '</a></li>';
							}
							echo '</ul>';
						}
						echo '</li>';
					}
					?>
					<li><a href="iletisim.php">İletişim</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->