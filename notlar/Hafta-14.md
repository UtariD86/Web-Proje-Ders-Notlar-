
## 1. **PHP Kodunun Açıklaması**
### 1.1 **Veritabanı Bağlantısı ve Sorgu Hazırlığı**
```php
$sorgu = $db->prepare('SELECT sepet.sepet_id,sepet.urun_id,sepet.sepet_miktar,
urun.urun_adi,urun.urun_fiyat,urun.urun_indirim,urun_stok.stok_renk,
urun_stok.stok_beden,urun_stok.stok_adet FROM sepet 
LEFT JOIN urun ON sepet.urun_id=urun.urun_id 
LEFT JOIN urun_stok ON sepet.urun_stok_id=urun_stok.stok_id
WHERE sepet.kullanici_id=?');
$sorgu->execute(array(1));
```
- **`$db->prepare()`**: Veritabanına sorgu göndermek için hazırlanan bir komut. Burada, `sepet` tablosu ile `urun` ve `urun_stok` tablosu birleştirilmiştir (`LEFT JOIN`).
- **`$sorgu->execute()`**: Sorgu çalıştırılır. Parametre olarak kullanıcı ID'si (1) gönderilir.

### 1.2 **HTML ve PHP ile Dinamik Sepet İçeriği**
```php
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    // Sepet elemanları döngü içinde işleniyor
    <tr>
        <td class="product-col">
            <h4><?php echo $satir['urun_adi'] ?></h4>
            <p><?php
                if ($satir['urun_indirim'] > 0) {
                    $urunFiyat = $satir['urun_fiyat'] - $satir['urun_fiyat'] * $satir['urun_indirim'] / 100;
                    echo "<del>" . number_format($satir['urun_fiyat'], 2, ',', '.') . "TL</del><br>" . number_format($urunFiyat, 2, ',', '.') . "TL";
                } else {
                    $urunFiyat = $satir['urun_fiyat'];
                    echo number_format($satir['urun_fiyat'], 2, ',', '.') . "TL";
                }
            ?></p>
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
```
- **`while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC))`**: Veritabanından dönen satırları işleyerek sepetteki ürünleri görüntüler.
- **`$urunFiyat`**: Ürün fiyatı, indirim varsa indirimli fiyat olarak hesaplanır.
- **`number_format()`**: Sayıyı Türk Lirası formatında (örn: 1000,00 TL) yazdırır.

### 1.3 **JavaScript ile Sepet Güncelleme**
```javascript
function SepetiGuncelle(sepetID, miktar) {
    $.ajax({
        method: "POST",
        url: "sepet_guncelle.php",
        data: { sepetID: sepetID, miktar: miktar }
    })
    .done(function(msg) {
        var dizi = msg.split('*');
        $('#tutar_' + sepetID).html(parseFloat(dizi[0]).toLocaleString(undefined, { minimumFractionDigits: 2 }) + "TL");
        $('#genelToplam').html("Toplam <span>" + parseFloat(dizi[1]).toLocaleString(undefined, { minimumFractionDigits: 2 }) + "TL</span>");
        $('#SepetAdet').html(dizi[2]);
    });
}
```
- **`SepetiGuncelle()`**: Sepet miktarı değiştirildiğinde çağrılır.
- **`$.ajax()`**: Sepet güncelleme işlemini arka planda çalıştırır.
- **`msg.split('*')`**: Gelen cevabı parçalara ayırarak her bir bilgiyi kullanır. (Tutar, genel toplam, sepet adedi)
- **`toLocaleString()`**: Sayıyı yerel para birimi formatında görüntüler.

## 2. **Sepet Güncelleme PHP Dosyası (`sepet_guncelle.php`)**

Bu dosya, sepet miktarı güncellendiğinde çalışır.

### 2.1 **Veritabanı Güncelleme**
```php
if (isset($_POST['sepetID'], $_POST['miktar'])) {
    // Sepet miktarını güncelleme
    $sorgu = $db->prepare('UPDATE sepet SET sepet_miktar=? WHERE sepet_id=? AND kullanici_id=?');
    $sorgu->execute(array($_POST['miktar'], $_POST['sepetID'], 1));
```
- **`UPDATE`**: `sepet` tablosundaki miktar bilgisi, gönderilen yeni miktar ile güncellenir.

### 2.2 **İndirimli Fiyat Hesaplama ve Cevap Gönderme**
```php
    $sorgu = $db->prepare('SELECT sepet.sepet_miktar*urun.urun_fiyat*(100-urun.urun_indirim)/100
        FROM sepet LEFT JOIN urun ON urun.urun_id=sepet.urun_id WHERE sepet_id=? AND kullanici_id=?');
    $sorgu->execute(array($_POST['sepetID'], 1));
    echo $sorgu->fetch(PDO::FETCH_NUM)[0] . "*";
```
- **Fiyat Hesaplama**: Sepet miktarı ve ürün fiyatı, varsa indirim oranı ile birlikte hesaplanır.

### 2.3 **Genel Toplam ve Sepet Adedi Hesaplama**
```php
    $sorgu = $db->prepare('SELECT SUM(sepet.sepet_miktar*urun.urun_fiyat*(100-urun.urun_indirim)/100), 
    SUM(sepet_miktar) FROM sepet LEFT JOIN urun ON urun.urun_id=sepet.urun_id WHERE kullanici_id=?');
    $sorgu->execute(array(1));
    $satir = $sorgu->fetch(PDO::FETCH_NUM);
    echo $satir[0] . "*";
    echo $satir[1];
}
```
- **Genel Toplam**: Kullanıcının sepetindeki tüm ürünlerin fiyatları, indirimler ve miktarlar göz önünde bulundurularak toplam tutar hesaplanır.
- **Sepet Adedi**: Sepetteki toplam ürün adedi hesaplanır.

---

## 3. **CSS ve Stiller**
```css
.renkEtiketi {
    border-radius: 50px;
    width: 25px;
    height: 25px;
}
```
- **`border-radius`**: Renk etiketinin yuvarlak olmasını sağlar.
- **`width` ve `height`**: Etiketin boyutlarını ayarlar.

------------------------------------------------------------------------

#### 1. **Tablo: `ayar`**
Bu tablo, sistem ayarlarıyla ilgili bilgileri tutar. İçeriği, çeşitli sosyal medya linkleri ve sunucu bilgilerini içerir.

| Kolon Adı         | Veri Tipi              | Açıklama                         |
|-------------------|------------------------|----------------------------------|
| `ayar_id`         | `int(11)`              | Ayar ID'si (Birincil anahtar)    |
| `ayar_baslik`     | `varchar(100)`         | Ayar başlığı                    |
| `ayar_aciklama`   | `varchar(255)`         | Açıklama                        |
| `ayar_anahtarkelime` | `varchar(255)`         | Anahtar kelimeler               |
| `ayar_facebook`   | `varchar(100)`         | Facebook linki                  |
| `ayar_instagram`  | `varchar(100)`         | Instagram linki                 |
| `ayar_youtube`    | `varchar(100)`         | Youtube linki                   |
| `ayar_msunucu`    | `varchar(50)`          | Mail sunucu adresi              |
| `ayar_mport`      | `int(4)`               | Mail portu                      |
| `ayar_madres`     | `varchar(100)`         | Mail adresi                     |
| `ayar_msifre`     | `varchar(20)`          | Mail şifresi                    |

#### 2. **Tablo: `sepet`**
Kullanıcıların alışveriş sepeti bilgilerini tutar.

| Kolon Adı         | Veri Tipi              | Açıklama                         |
|-------------------|------------------------|----------------------------------|
| `sepet_id`        | `int(11)`              | Sepet ID'si (Birincil anahtar)  |
| `kullanici_id`    | `int(11)`              | Kullanıcı ID'si                 |
| `urun_id`         | `int(11)`              | Ürün ID'si                      |
| `urun_stok_id`    | `int(11)`              | Ürün stok ID'si                 |
| `sepet_miktar`    | `int(11)`              | Sepetteki ürün miktarı          |
| `sepet_tarih`     | `timestamp`            | Sepet oluşturulma tarihi        |

#### 3. **Tablo: `urun`**
Ürünlerle ilgili bilgiler içerir.

| Kolon Adı          | Veri Tipi               | Açıklama                              |
|--------------------|-------------------------|---------------------------------------|
| `urun_id`          | `int(11)`               | Ürün ID'si (Birincil anahtar)         |
| `urun_kategori_id` | `int(11)`               | Ürün kategorisi ID'si                 |
| `urun_barkod`      | `varchar(15)`           | Ürün barkodu                          |
| `urun_adi`         | `varchar(150)`          | Ürün adı                              |
| `urun_aciklama`    | `text`                  | Ürün açıklaması                       |
| `urun_fiyat`       | `decimal(8,2)`          | Ürün fiyatı (8 basamaklı, 2 ondalıklı)|
| `urun_indirim`     | `tinyint(4)`            | Ürün indirimi                         |
| `urun_marka`       | `varchar(15)`           | Ürün markası                          |
| `urun_vitrin`      | `tinyint(1)`            | Vitrinde olup olmadığı                |
| `urun_gorulmesayisi` | `int(11)`              | Görülme sayısı                        |
| `urun_eklemetarihi`| `timestamp`             | Ürün eklenme tarihi                   |

#### 4. **Tablo: `urun_kategori`**
Ürün kategorilerini tutar.

| Kolon Adı         | Veri Tipi            | Açıklama                                |
|-------------------|----------------------|-----------------------------------------|
| `kategori_id`     | `int(11)`            | Kategori ID'si (Birincil anahtar)      |
| `kategori_ust_id` | `int(11)`            | Üst kategori ID'si                     |
| `kategori_adi`    | `varchar(25)`        | Kategori adı                           |
| `kategori_sira`   | `tinyint(4)`         | Kategorinin sırası                     |

#### 5. **Tablo: `urun_stok`**
Ürünlerin stok bilgilerini içerir.

| Kolon Adı         | Veri Tipi             | Açıklama                                |
|-------------------|-----------------------|-----------------------------------------|
| `stok_id`         | `int(11)`             | Stok ID'si (Birincil anahtar)          |
| `urun_id`         | `int(11)`             | Ürün ID'si                             |
| `stok_renk`       | `varchar(6)`          | Ürün renginin kodu (hexadecimal)       |
| `stok_beden`      | `varchar(3)`          | Ürün bedeni (S, M, L, vb.)             |
| `stok_adet`       | `smallint(6)`         | Stokta kalan ürün adedi               |
