<!-- Footer section -->
<section class="footer-section">
	<div class="container">
		<div class="footer-logo text-center">
			<a href="index.html"><img src="./img/logo-light.png" alt=""></a>
		</div>
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>About</h2>
					<p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
					<img src="img/cards.png" alt="">
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>Questions</h2>
					<ul>
						<li><a href="">About Us</a></li>
						<li><a href="">Track Orders</a></li>
						<li><a href="">Returns</a></li>
						<li><a href="">Jobs</a></li>
						<li><a href="">Shipping</a></li>
						<li><a href="">Blog</a></li>
					</ul>
					<ul>
						<li><a href="">Partners</a></li>
						<li><a href="">Bloggers</a></li>
						<li><a href="">Support</a></li>
						<li><a href="">Terms of Use</a></li>
						<li><a href="">Press</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>Questions</h2>
					<div class="fw-latest-post-widget">
						<div class="lp-item">
							<div class="lp-thumb set-bg" data-setbg="img/blog-thumbs/1.jpg"></div>
							<div class="lp-content">
								<h6>what shoes to wear</h6>
								<span>Oct 21, 2018</span>
								<a href="#" class="readmore">Read More</a>
							</div>
						</div>
						<div class="lp-item">
							<div class="lp-thumb set-bg" data-setbg="img/blog-thumbs/2.jpg"></div>
							<div class="lp-content">
								<h6>trends this year</h6>
								<span>Oct 21, 2018</span>
								<a href="#" class="readmore">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget contact-widget">
					<h2>Questions</h2>
					<div class="con-info">
						<span>C.</span>
						<p>Your Company Ltd </p>
					</div>
					<div class="con-info">
						<span>B.</span>
						<p>1481 Creekside Lane Avila Beach, CA 93424, P.O. BOX 68 </p>
					</div>
					<div class="con-info">
						<span>T.</span>
						<p>+53 345 7953 32453</p>
					</div>
					<div class="con-info">
						<span>E.</span>
						<p>office@youremail.com</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="social-links-warp">
		<div class="container">
			<div class="social-links text-center">
				<?php
				if ($ayar['ayar_instagram'] != "") {
				?>
					<a href="<?php echo $ayar['ayar_instagram'] ?>" target="_blank" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
				<?php
				}
				if ($ayar['ayar_facebook'] != "") {
				?>
					<a href="<?php echo $ayar['ayar_facebook'] ?>" target="_blank" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
				<?php
				}
				if ($ayar['ayar_x'] != "") {
				?>
					<a href="<?php echo $ayar['ayar_x'] ?>" target="_blank" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
				<?php
				}
				if ($ayar['ayar_youtube'] != "") {
				?>
					<a href="<?php echo $ayar['ayar_youtube'] ?>" target="_blank" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
				<?php
				}
				?>
			</div>

			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			<p class="text-white text-center mt-5">Copyright &copy;<script>
					document.write(new Date().getFullYear());
				</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
			<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

		</div>
	</div>
</section>
<!-- Footer section end -->



<!--====== Javascripts & Jquery ======-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slicknav.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.nicescroll.min.js"></script>
<script src="js/jquery.zoom.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/main.js"></script>

</body>

</html>