

#### `eticaret/alt.php`: Footer Bölümü

**Kodun Amacı:**  
Bu dosyada web sitesinin altbilgi (footer) bölümü tanımlanmıştır. Footer, ziyaretçilere hakkında bilgi, sık sorulan sorular, iletişim bilgileri ve sosyal medya bağlantıları sunar.

##### Öne Çıkan Kodlar ve Açıklamalar:

```html
<section class="footer-section">
    <div class="footer-logo text-center">
        <a href="index.html"><img src="./img/logo-light.png" alt=""></a>
    </div>
    <!-- Footer'da logonun gösterildiği alan -->
</section>
```

- **`<section>` etiketi:** Sayfanın bölümlerini tanımlar. Burada footer için kullanılmış.
- **`<img src="./img/logo-light.png"`:** Logonun yerini gösterir. `src` özniteliği dosyanın konumunu belirtir.

```php
<?php
if ($ayar['ayar_instagram'] != "") {
?>
    <a href="<?php echo $ayar['ayar_instagram'] ?>" target="_blank" class="instagram">
        <i class="fa fa-instagram"></i><span>instagram</span>
    </a>
<?php
}
?>
```

- **Dinamik Sosyal Medya Bağlantıları:**  
  PHP ile ayar tablosundan sosyal medya bağlantıları kontrol edilir. Eğer boş değilse bağlantılar oluşturulur.  

**Yorum Satırlarıyla Örnek:**

```php
<?php
// Eğer Instagram bağlantısı boş değilse
if ($ayar['ayar_instagram'] != "") {
?>
    <!-- Instagram bağlantısı oluşturuluyor -->
    <a href="<?php echo $ayar['ayar_instagram'] ?>" target="_blank" class="instagram">
        <i class="fa fa-instagram"></i><span>instagram</span>
    </a>
<?php
}
?>
```

---

#### `eticaret/index.php`: Ana Sayfa

**Kodun Amacı:**  
Ana sayfada ürün tanıtımları, kampanyalar ve öne çıkan özellikler sunulmaktadır.

##### Öne Çıkan Kodlar:

```php
<?php
$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_vitrin=1 ORDER BY RAND() LIMIT 20');
$sorgu->execute();
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
?>
    <div class="product-item">
        <div class="pi-pic">
            <img src="./img/product/1.jpg" alt="">
        </div>
        <div class="pi-text">
            <p><?php echo $satir['urun_adi'] ?></p>
        </div>
    </div>
<?php
}
?>
```

- **`$db->prepare` ve `PDO::FETCH_ASSOC`:** Veritabanı sorgusu oluşturulur ve ürün bilgileri çekilir. `PDO::FETCH_ASSOC`, veriyi sütun adıyla ilişkilendirir.
- **Dinamik Ürün Listeleme:** PHP döngüsüyle ürünler HTML içinde otomatik oluşturulur.

**Yorum Satırlarıyla Örnek:**

```php
<?php
// Vitrin ürünlerini veritabanından çekiyoruz
$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_vitrin=1 ORDER BY RAND() LIMIT 20');
$sorgu->execute();
// Her ürün için HTML elemanları oluşturuluyor
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
?>
    <!-- Ürün bilgilerini göstermek için oluşturulan HTML -->
    <div class="product-item">
        <div class="pi-pic">
            <img src="./img/product/1.jpg" alt="Ürün resmi">
        </div>
        <div class="pi-text">
            <p><?php echo $satir['urun_adi'] ?></p>
        </div>
    </div>
<?php
}
?>
```

---

#### `eticaret/ust.php`: Üst Bilgi ve Başlıklar

**Kodun Amacı:**  
Bu dosyada sayfanın üst kısmında yer alacak meta bilgiler, CSS dosyaları ve genel ayarlar yüklenmiştir.

##### Öne Çıkan Kodlar:

```php
<?php
include "../yonet/baglan.php";
$ayar = $db->prepare("SELECT * FROM ayar");
$ayar->execute();
$ayar = $ayar->fetch(PDO::FETCH_ASSOC);
?>
```

- **Veritabanı Bağlantısı:** `baglan.php` dosyası, PHP uygulamasının veritabanıyla iletişim kurmasını sağlar.
- **Ayarları Yükleme:** Siteye ait başlık, açıklama gibi bilgiler veritabanından çekilir.

**Yorum Satırlarıyla Örnek:**

```php
<?php
// Veritabanı bağlantı dosyasını dahil ediyoruz
include "../yonet/baglan.php";
// Siteye ait genel ayarları veritabanından çekiyoruz
$ayar = $db->prepare("SELECT * FROM ayar");
$ayar->execute();
// Sonuçları bir dizi olarak kaydediyoruz
$ayar = $ayar->fetch(PDO::FETCH_ASSOC);
?>
```
------------------------------------------------------------------------------------------------


## Tablolar

### `ayar` Tablosu

Bu tablo, uygulama ayarlarını saklamak için kullanılır.

| Sütun Adı           | Veri Tipi    | Açıklama                                   |
|----------------------|--------------|-------------------------------------------|
| `ayar_id`           | `int(11)`    | Birincil anahtar, ayar ID'si.             |
| `ayar_baslik`       | `varchar(100)` | Web sitesi başlığı.                       |
| `ayar_aciklama`     | `varchar(255)` | Web sitesi açıklaması.                    |
| `ayar_anahtarkelime`| `varchar(255)` | SEO anahtar kelimeleri.                   |
| `ayar_facebook`     | `varchar(100)` | Facebook sayfa bağlantısı.                |
| `ayar_x`            | `varchar(100)` | Twitter sayfa bağlantısı.                 |
| `ayar_instagram`    | `varchar(100)` | Instagram sayfa bağlantısı.               |
| `ayar_youtube`      | `varchar(100)` | YouTube kanal bağlantısı.                 |
| `ayar_msunucu`      | `varchar(50)`  | Mail sunucu adı.                          |
| `ayar_mport`        | `int(4)`      | Mail sunucu portu.                        |
| `ayar_madres`       | `varchar(100)` | Mail adresi.                              |
| `ayar_msifre`       | `varchar(20)`  | Mail şifresi.                             |

---

### `urun` Tablosu

Bu tablo, ürün bilgilerini tutar.

| Sütun Adı           | Veri Tipi      | Açıklama                                   |
|----------------------|----------------|-------------------------------------------|
| `urun_id`           | `int(11)`      | Birincil anahtar, ürün ID'si.             |
| `urun_kategori_id`  | `int(11)`      | Ürünün kategorisinin ID'si.               |
| `urun_barkod`       | `varchar(15)`  | Ürünün barkod numarası.                   |
| `urun_adi`          | `varchar(150)` | Ürünün adı.                               |
| `urun_aciklama`     | `text`         | Ürün açıklaması.                          |
| `urun_fiyat`        | `decimal(8,2)` | Ürünün fiyatı.                            |
| `urun_indirim`      | `tinyint(4)`   | Ürüne uygulanan indirim yüzdesi.          |
| `urun_marka`        | `varchar(15)`  | Ürün markası.                             |
| `urun_vitrin`       | `tinyint(1)`   | Vitrinde gösterim durumu (0 veya 1).      |
| `urun_gorulmesayisi`| `int(11)`      | Görüntülenme sayısı.                      |
| `urun_eklemetarihi` | `timestamp`    | Ürünün eklenme tarihi.                    |

---

### `urun_kategori` Tablosu

Bu tablo, ürün kategorilerini organize etmek için kullanılır.

| Sütun Adı           | Veri Tipi      | Açıklama                                   |
|----------------------|----------------|-------------------------------------------|
| `kategori_id`       | `int(11)`      | Birincil anahtar, kategori ID'si.         |
| `kategori_ust_id`   | `int(11)`      | Üst kategorinin ID'si.                    |
| `kategori_adi`      | `varchar(25)`  | Kategori adı.                             |
| `kategori_sira`     | `tinyint(4)`   | Kategori sıralama değeri.                 |

---

### `urun_stok` Tablosu

Bu tablo, ürünlerin stok bilgilerini saklar.

| Sütun Adı           | Veri Tipi      | Açıklama                                   |
|----------------------|----------------|-------------------------------------------|
| `stok_id`           | `int(11)`      | Birincil anahtar, stok ID'si.             |
| `urun_id`           | `int(11)`      | İlgili ürünün ID'si.                      |
| `stok_renk`         | `varchar(6)`   | Ürünün rengi (hex kodu).                  |
| `stok_beden`        | `varchar(3)`   | Ürünün bedeni.                            |
| `stok_adet`         | `smallint(6)`  | Stoktaki adet sayısı.                     |

---
