<?php
include "ust.php";
?>
<!-- Hero section -->
<section class="hero-section">
	<div class="hero-slider owl-carousel">
		<div class="hs-item set-bg" data-setbg="img/bg.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-7 text-white">
						<span>New ArrivalsXXXXXXXX</span>
						<h2>denim jackets</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
						<a href="#" class="site-btn sb-line">DISCOVER</a>
						<a href="#" class="site-btn sb-white">ADD TO CART</a>
					</div>
				</div>
				<div class="offer-card text-white">
					<span>from</span>
					<h2>$29</h2>
					<p>SHOP NOW</p>
				</div>
			</div>
		</div>
		<div class="hs-item set-bg" data-setbg="img/bg-2.jpg">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-7 text-white">
						<span>New Arrivals</span>
						<h2>denim jackets</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
						<a href="#" class="site-btn sb-line">DISCOVER</a>
						<a href="#" class="site-btn sb-white">ADD TO CART</a>
					</div>
				</div>
				<div class="offer-card text-white">
					<span>from</span>
					<h2>$29</h2>
					<p>SHOP NOW</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="slide-num-holder" id="snh-1"></div>
	</div>
</section>
<!-- Hero section end -->



<!-- Features section -->
<section class="features-section">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="img/icons/1.png" alt="#">
					</div>
					<h2>Fast Secure Payments</h2>
				</div>
			</div>
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="img/icons/2.png" alt="#">
					</div>
					<h2>Premium Products</h2>
				</div>
			</div>
			<div class="col-md-4 p-0 feature">
				<div class="feature-inner">
					<div class="feature-icon">
						<img src="img/icons/3.png" alt="#">
					</div>
					<h2>Free & fast Delivery</h2>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Features section end -->


<!-- letest product section -->
<section class="top-letest-product-section">
	<div class="container">
		<div class="section-title">
			<h2>VİTRİN ÜRÜNLERİ</h2>
		</div>
		<div class="product-slider owl-carousel">
			<?php
			include "fonksiyon.php";

			$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_vitrin=1 ORDER BY RAND() LIMIT 20');
			$sorgu->execute();

			while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
				UrunListeKartiOlustur($satir);
			}
			?>
		</div>
	</div>
</section>
<!-- letest product section end -->



<!-- Product filter section -->
<section class="product-filter-section">
	<div class="container">
		<ul class="product-filter-menu text-center">
			<?php
			$sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=0 ORDER BY kategori_sira');
			$sorgu->execute();

			while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC))
				echo '<li><a id="kat_' . $satir['kategori_id'] . '" 
							href="javascript:KategoriDetay(' . $satir['kategori_id'] . ');">'
					. $satir['kategori_adi'] . '</a></li>';
			?>
		</ul>
		<div class="row" id="UrunListesi">
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/5.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Product filter section end -->

<script>
	function KategoriDetay(KategoriID) {
		//console.log(KategoriID);
		$('.product-filter-menu li a').removeClass('bg-danger text-white');
		$('#kat_' + KategoriID).addClass('bg-danger text-white');

		$.ajax({
				method: "POST",
				url: "urun_listesi.php",
				data: {
					KategoriID: KategoriID
				}
			})
			.done(function(msg) {
				$('#UrunListesi').html(msg);
			});
	}
</script>

<?php
include "alt.php";
?>