<?php
function UrunListeKartiOlustur($satir)
{
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
