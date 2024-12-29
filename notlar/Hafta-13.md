

## **eticaret/fonksiyon.php**

```php
<div class="product-item">
    <div class="pi-pic">
        <a href="urun_detay.php?ID=<?php echo $satir['urun_id'] ?>">
            <img src="./img/product/1.jpg" alt="">
        </a>
        <div class="pi-links">
            <a href="#" class="add-card"><i class="flaticon-bag"></i><span>Sepet</span></a>
            <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
        </div>
    </div>
    <div class="pi-text">
        <a href="urun_detay.php?ID=<?php echo $satir['urun_id'] ?>">
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
        </a>
    </div>
</div>
```

**Açıklama:**
- Bu kod, bir ürünün **görselini** ve **detaylarını** görüntüleyen bir HTML bloğu oluşturur.
- `urun_id` ile ürün detay sayfasına yönlendirme yapılır.
- Ürünün fiyatı, **indirimli fiyat varsa** gösterilir. Eğer indirim yoksa, orijinal fiyat gösterilir.
- Ürüne ait **resim**, **sepete ekle** ve **favorilere ekle** seçenekleri de bulunmaktadır.

---

## **eticaret/sepet_ekle.php**

```php
<?php
include "../yonet/baglan.php";

// Kullanıcının seçtiği ürünün stoğunun yeterli olup olmadığını kontrol et
if (isset($_POST['urun_id'], $_POST['beden'], $_POST['renk'], $_POST['miktar'])) {
    $sorgu = $db->prepare('SELECT stok_id FROM urun_stok 
        WHERE urun_id=? AND stok_renk=? AND stok_beden=? AND stok_adet>?');
    $sorgu->execute(array($_POST['urun_id'], $_POST['renk'], $_POST['beden'], $_POST['miktar']));

    // Yeterli stok yoksa uyarı ver
    if ($sorgu->rowCount() == 0) {
        echo "Yeterli Stok Yok";
        exit;
    }
    // Stok ID'si alınır
    $stokID = $sorgu->fetch(PDO::FETCH_NUM)[0];

    // Sepette bu ürün varsa silinir ve yeni miktar ile eklenir
    $sorgu = $db->prepare('DELETE FROM sepet WHERE kullanici_id=? AND urun_id=? AND urun_stok_id=?');
    $sorgu->execute(array(1, $_POST['urun_id'], $stokID));
    
    // Yeni ürün sepete eklenir
    $sorgu = $db->prepare('INSERT INTO sepet(kullanici_id,urun_id,urun_stok_id,sepet_miktar) 
    VALUES(?,?,?,?)');
    $sorgu->execute(array(1, $_POST['urun_id'], $stokID, $_POST['miktar']));

    // Sepet miktarını günceller
    $sorgu = $db->prepare('SELECT SUM(sepet_miktar) FROM sepet WHERE kullanici_id=?');
    $sorgu->execute(array(1));
    echo $sorgu->fetch(PDO::FETCH_NUM)[0];
}
?>
```

**Açıklama:**
- Bu dosya, kullanıcının sepetine ürün ekler. `urun_id`, `beden`, `renk`, ve `miktar` parametreleriyle gönderilen veriyi alır.
- İlk olarak, seçilen ürün için yeterli stok olup olmadığı kontrol edilir. Eğer stok yeterli değilse, kullanıcıya "Yeterli Stok Yok" mesajı gösterilir.
- Eğer stok varsa, önceki sepetteki ürün silinir, ardından yeni ürün eklenir ve sepetin toplam miktarı güncellenir.

---

## **eticaret/urun_detay.php**

```php
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
```

**Açıklama:**
- Ürünün detayları gösterilir. **Beden** ve **Renk** seçenekleri dinamik olarak veritabanından çekilir.
- Kullanıcı ürün detayları sayfasında **beden**, **renk**, ve **miktar** seçtikten sonra sepete ekleyebilir.
- **Sepete Ekle** butonuna tıklandığında, seçilen ürün sepete eklenir ve sepetteki toplam ürün miktarı güncellenir.

---

## **eticaret/ust.php**

```php
<div class="up-item">
    <div class="shopping-card">
        <i class="flaticon-bag"></i>
        <span id="SepetAdet">0</span>
    </div>
    <a href="#">Shopping Cart</a>
</div>
```

**Açıklama:**
- Bu bölüm, sayfanın üst kısmında yer alan sepetin **toplam adetini** gösteren bir kart içerir.
- Sepet simgesi ve içerik, kullanıcının sepetinde bulunan ürünlerin sayısını gösterir.

---------------------------------------------------------------------

### 1. **ayar Tablosu**
Bu tablo, site ayarlarını tutar. Aşağıda `ayar` tablosunun yapısı ve açıklamalarına bakabilirsiniz:

| Sütun Adı         | Veri Tipi           | Açıklama                                  |
|-------------------|---------------------|-------------------------------------------|
| `ayar_id`         | `int(11)`           | Ayar kimliği, birincil anahtar            |
| `ayar_baslik`     | `varchar(100)`       | Ayar başlığı                              |
| `ayar_aciklama`   | `varchar(255)`       | Ayar açıklaması                           |
| `ayar_anahtarkelime` | `varchar(255)`    | Anahtar kelimeler                         |
| `ayar_facebook`   | `varchar(100)`       | Facebook adresi                           |
| `ayar_x`          | `varchar(100)`       | X adresi                                  |
| `ayar_instagram`  | `varchar(100)`       | Instagram adresi                          |
| `ayar_youtube`    | `varchar(100)`       | YouTube adresi                            |
| `ayar_msunucu`    | `varchar(50)`        | Mail sunucusu                             |
| `ayar_mport`      | `int(4)`             | Mail portu                                |
| `ayar_madres`     | `varchar(100)`       | Mail adresi                               |
| `ayar_msifre`     | `varchar(20)`        | Mail şifresi                              |

### 2. **sepet Tablosu**
Bu tablo, kullanıcıların sepet bilgilerini tutar.

| Sütun Adı         | Veri Tipi           | Açıklama                                  |
|-------------------|---------------------|-------------------------------------------|
| `sepet_id`        | `int(11)`           | Sepet kimliği, birincil anahtar           |
| `kullanici_id`    | `int(11)`           | Kullanıcı kimliği                         |
| `urun_id`         | `int(11)`           | Ürün kimliği                              |
| `urun_stok_id`    | `int(11)`           | Ürün stok kimliği                         |
| `sepet_miktar`    | `int(11)`           | Sepetteki ürün miktarı                    |
| `sepet_tarih`     | `timestamp`         | Sepete eklenme tarihi                     |

### 3. **urun Tablosu**
Bu tablo, ürün bilgilerini tutar.

| Sütun Adı         | Veri Tipi           | Açıklama                                  |
|-------------------|---------------------|-------------------------------------------|
| `urun_id`         | `int(11)`           | Ürün kimliği, birincil anahtar            |
| `urun_kategori_id`| `int(11)`           | Ürün kategorisi                           |
| `urun_barkod`     | `varchar(15)`        | Ürün barkodu                              |
| `urun_adi`        | `varchar(150)`       | Ürün adı                                  |
| `urun_aciklama`   | `text`               | Ürün açıklaması                           |
| `urun_fiyat`      | `decimal(8,2)`       | Ürün fiyatı                               |
| `urun_indirim`    | `tinyint(4)`         | Ürün indirimi                             |
| `urun_marka`      | `varchar(15)`        | Ürün markası                              |
| `urun_vitrin`     | `tinyint(1)`         | Vitrinde görünme durumu                   |
| `urun_gorulmesayisi` | `int(11)`         | Ürün görünme sayısı                       |
| `urun_eklemetarihi` | `timestamp`        | Ürünün eklenme tarihi                     |

### 4. **urun_kategori Tablosu**
Bu tablo, ürün kategorilerini tutar.

| Sütun Adı         | Veri Tipi           | Açıklama                                  |
|-------------------|---------------------|-------------------------------------------|
| `kategori_id`     | `int(11)`           | Kategori kimliği, birincil anahtar        |
| `kategori_ust_id` | `int(11)`           | Üst kategori kimliği                      |
| `kategori_adi`    | `varchar(25)`        | Kategori adı                              |
| `kategori_sira`   | `tinyint(4)`         | Kategorinin sırası                        |

### 5. **urun_stok Tablosu**
Bu tablo, ürünlerin stok bilgilerini tutar.

| Sütun Adı         | Veri Tipi           | Açıklama                                  |
|-------------------|---------------------|-------------------------------------------|
| `stok_id`         | `int(11)`           | Stok kimliği, birincil anahtar            |
| `urun_id`         | `int(11)`           | Ürün kimliği                              |
| `stok_renk`       | `varchar(6)`         | Stok rengini belirtir                     |
| `stok_beden`      | `varchar(3)`         | Stok bedeni                               |
| `stok_adet`       | `smallint(6)`        | Stok adedi                                |

---

**Veri Tipleri Özetle:**
- `int(11)`: Sayısal veriler için kullanılır (örneğin kimlikler).
- `varchar(n)`: Değişken uzunlukta metin verisi (örneğin ürün isimleri veya açıklamaları).
- `text`: Uzun metin verisi (örneğin ürün açıklamaları).
- `decimal(8,2)`: Sayısal değerler için hassasiyetli veri tipidir, genellikle fiyatlar için kullanılır.
- `tinyint(1)`: 1 veya 0 gibi küçük sayılar için kullanılır (örneğin, bir şeyin aktif olup olmadığı).

