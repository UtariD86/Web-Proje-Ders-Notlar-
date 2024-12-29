<?php
include "ust.php";

$sorgu = $db->prepare('SELECT sepet.sepet_id,sepet.urun_id,sepet.sepet_miktar,
urun.urun_adi,urun.urun_fiyat,urun.urun_indirim,urun_stok.stok_renk,
urun_stok.stok_beden,urun_stok.stok_adet FROM sepet 
LEFT JOIN urun ON sepet.urun_id=urun.urun_id 
LEFT JOIN urun_stok ON sepet.urun_stok_id=urun_stok.stok_id
WHERE sepet.kullanici_id=?');
$sorgu->execute(array(1));
?>
<style>
    .renkEtiketi {
        border-radius: 50px;
        width: 25px;
        height: 25px;
    }
</style>
<!-- cart section end -->
<section class="cart-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    <div class="cart-table-warp">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-th">Ürün</th>
                                    <th class="quy-th">Adet</th>
                                    <th class="size-th">Beden</th>
                                    <th class="size-th">Renk</th>
                                    <th class="total-th">Tutar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $genelToplam = 0;
                                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td class="product-col">
                                            <img src="img/cart/1.jpg" alt="">
                                            <div class="pc-title">
                                                <h4><?php echo $satir['urun_adi'] ?></h4>
                                                <p><?php
                                                    if ($satir['urun_indirim'] > 0) {
                                                        $urunFiyat = $satir['urun_fiyat'] - $satir['urun_fiyat'] * $satir['urun_indirim'] / 100;
                                                        echo "<del>" .
                                                            number_format($satir['urun_fiyat'], 2, ',', '.') . "TL</del><br>" .
                                                            number_format($urunFiyat, 2, ',', '.') . "TL";
                                                    } else {
                                                        $urunFiyat = $satir['urun_fiyat'];
                                                        echo number_format($satir['urun_fiyat'], 2, ',', '.') . "TL";
                                                    }
                                                    ?></p>
                                            </div>
                                        </td>
                                        <td class="quy-col">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="<?php echo $satir['sepet_miktar'] ?>" onchange="SepetiGuncelle(<?php echo $satir['sepet_id'] ?>,this.value)">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="size-col">
                                            <h4><?php echo $satir['stok_beden'] ?></h4>
                                        </td>
                                        <td class="size-col">
                                            <label class="renkEtiketi" style="background-color: #<?php echo $satir['stok_renk'] ?>"></label>
                                        </td>
                                        <td class="total-col">
                                            <h4 id="tutar_<?php echo $satir['sepet_id'] ?>"><?php
                                                                                            $tutar = $urunFiyat * $satir['sepet_miktar'];
                                                                                            echo number_format($tutar, 2, ',', '.') . "TL";

                                                                                            $genelToplam += $tutar;
                                                                                            ?></h4>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-cost">
                        <h6 id="genelToplam">Toplam <span><?php echo number_format($genelToplam, 2, ',', '.') . "TL" ?></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <form class="promo-code-form">
                    <input type="text" placeholder="Enter promo code">
                    <button>Submit</button>
                </form>
                <a href="" class="site-btn">Proceed to checkout</a>
                <a href="" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->

<script>
    function SepetiGuncelle(sepetID, miktar) {
        console.log(sepetID)
        console.log(miktar)
        $.ajax({
                method: "POST",
                url: "sepet_guncelle.php",
                data: {
                    sepetID: sepetID,
                    miktar: miktar
                }
            })
            .done(function(msg) {
                console.log(msg);
                var dizi = msg.split('*');
                $('#tutar_' + sepetID).html(parseFloat(dizi[0]).toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }) + "TL")
                $('#genelToplam').html("Toplam <span>" + parseFloat(dizi[1]).toLocaleString(undefined, {
                    minimumFractionDigits: 2
                }) + "TL</span>")
                $('#SepetAdet').html(dizi[2])
            });
    }
</script>

<?php
include "alt.php";
?>