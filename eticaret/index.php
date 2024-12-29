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
			$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_vitrin=1 ORDER BY RAND() LIMIT 20');
			$sorgu->execute();

			while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/1.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>Sepet</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
					<h6>
						<?php
						if ($satir['urun_indirim'] > 0) {
							echo "<del>" .
								number_format($satir['urun_fiyat'], 2, ',', '.') . "TL</del><br>" .
								number_format($satir['urun_fiyat'] - $satir['urun_fiyat'] * $satir['urun_indirim'] / 100, 2, ',', '.') . "TL";
						} else
							echo number_format($satir['urun_fiyat'], 2, ',', '.') . "TL";
						?>
						</h6>
						<p><?php echo $satir['urun_adi'] ?></p>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</section>
<!-- letest product section end -->



<!-- Product filter section -->
<section class="product-filter-section">
	<div class="container">
		<div class="section-title">
			<h2>BROWSE TOP SELLING PRODUCTS</h2>
		</div>
		<ul class="product-filter-menu">
			<li><a href="#">TOPS</a></li>
			<li><a href="#">JUMPSUITS</a></li>
			<li><a href="#">LINGERIE</a></li>
			<li><a href="#">JEANS</a></li>
			<li><a href="#">DRESSES</a></li>
			<li><a href="#">COATS</a></li>
			<li><a href="#">JUMPERS</a></li>
			<li><a href="#">LEGGINGS</a></li>
		</ul>
		<div class="row">
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
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<div class="tag-sale">ON SALE</div>
						<img src="./img/product/6.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Black and White Stripes Dress</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/7.jpg" alt="">
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
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/8.jpg" alt="">
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
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/9.jpg" alt="">
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
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/10.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>$35,00</h6>
						<p>Black and White Stripes Dress</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/11.jpg" alt="">
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
			<div class="col-lg-3 col-sm-6">
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/12.jpg" alt="">
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
		<div class="text-center pt-5">
			<button class="site-btn sb-line sb-dark">LOAD MORE</button>
		</div>
	</div>
</section>
<!-- Product filter section end -->

<?php
include "alt.php";
?>