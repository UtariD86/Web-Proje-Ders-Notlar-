<?php
include "ust.php";

$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_id=?');
$sorgu->execute(array($_GET['ID']));
if ($sorgu->rowCount() == 0) {
	header("Location:./");
	exit;
}

$satir = $sorgu->fetch(PDO::FETCH_ASSOC);

$sorguStok = $db->prepare('SELECT * FROM urun_stok WHERE urun_id=? AND stok_adet>0');
$sorguStok->execute(array($_GET['ID']));

$satirStoks = $sorguStok->fetchAll(PDO::FETCH_ASSOC);

$bedenler = array_unique(array_column($satirStoks, "stok_beden"));
$renkler = array_unique(array_column($satirStoks, "stok_renk"));
/*
echo "<pre>";
print_r($satirStoks);
echo "</pre>";

echo "<pre>";
print_r($bedenler);
echo "</pre>";

echo "<pre>";
print_r($renkler);
echo "</pre>";
*/
?>
<!-- product section -->
<section class="product-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="product-pic-zoom">
					<img class="product-big-img" src="img/single-product/1.jpg" alt="">
				</div>
				<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
					<div class="product-thumbs-track">
						<div class="pt active" data-imgbigurl="img/single-product/1.jpg"><img src="img/single-product/thumb-1.jpg" alt=""></div>
						<div class="pt" data-imgbigurl="img/single-product/2.jpg"><img src="img/single-product/thumb-2.jpg" alt=""></div>
						<div class="pt" data-imgbigurl="img/single-product/3.jpg"><img src="img/single-product/thumb-3.jpg" alt=""></div>
						<div class="pt" data-imgbigurl="img/single-product/4.jpg"><img src="img/single-product/thumb-4.jpg" alt=""></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 product-details">
				<h2 class="p-title"><?php echo $satir['urun_adi'] ?></h2>
				<h3 class="p-price">
					<?php
					if ($satir['urun_indirim'] > 0) {
						echo "<del>" .
							number_format($satir['urun_fiyat'], 2, ',', '.') . "TL</del><br>" .
							number_format($satir['urun_fiyat'] - $satir['urun_fiyat'] * $satir['urun_indirim'] / 100, 2, ',', '.') . "TL";
					} else
						echo number_format($satir['urun_fiyat'], 2, ',', '.') . "TL";
					?>
				</h3>
				<h4 class="p-stock">Stok: <span><?php echo ($sorguStok->rowCount() > 0 ? "Var" : "Yok") ?></span></h4>
				<?php
				if ($sorguStok->rowCount() > 0) {
				?>
					<div class="fw-size-choose">
						<p>Beden</p>
						<?php
						foreach ($bedenler as $value) {
						?>
							<div class="sc-item">
								<input type="radio" name="beden" id="beden-<?php echo $value ?>" value="<?php echo $value ?>">
								<label for="beden-<?php echo $value ?>"><?php echo $value ?></label>
							</div>
						<?php } ?>
					</div>
					<div class="fw-size-choose">
						<p>Renk</p>
						<?php
						foreach ($renkler as $value) {
						?>
							<div class="sc-item">
								<input type="radio" name="renk" id="renk-<?php echo $value ?>" value="<?php echo $value ?>">
								<label for="renk-<?php echo $value ?>" style="background-color: #<?php echo $value ?>"></label>
							</div>
						<?php } ?>
					</div>
					<div class="quantity">
						<p>MİKTAR</p>
						<div class="pro-qty"><input type="number" value="1" id="miktar"></div>
					</div>
					<a href="javascript:SepeteEkle()" class="site-btn">Sepete Ekle</a>
					<p id="SepetSonuc"></p>
				<?php
				}
				?>
				<div id="accordion" class="accordion-area">
					<div class="panel">
						<?php echo $satir['urun_aciklama'] ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- product section end -->

<script>
	function SepeteEkle() {
		var beden = $('input[name=beden]:checked').val();
		var renk = $('input[name=renk]:checked').val();
		var miktar = $('#miktar').val();
		console.log(beden);
		$.ajax({
				method: "POST",
				url: "sepet_ekle.php",
				data: {
					urun_id: <?php echo $_GET['ID'] ?>,
					beden: beden,
					renk: renk,
					miktar: miktar
				}
			})
			.done(function(msg) {
				$('#SepetSonuc').html("Eklendi");
				$('#SepetAdet').html(msg);
			});
	}
</script>
<?php
include "alt.php";
?>