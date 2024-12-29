
## (`eticaret/fonksiyon.php`)

### Yeni Fonksiyon: `UrunListeKartiOlustur`
- **Amaç**: Ürün bilgilerini dinamik olarak alıp bir ürün kartı oluşturur.
- **Kod Açıklaması**:
```php
function UrunListeKartiOlustur($satir) {
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
                        number_format($satir['urun_fiyat'], 2, ',', '.') . " TL</del><br>" .
                        number_format($satir['urun_fiyat'] - $satir['urun_fiyat'] * $satir['urun_indirim'] / 100, 2, ',', '.') . " TL";
                } else {
                    echo number_format($satir['urun_fiyat'], 2, ',', '.') . " TL";
                }
                ?>
            </h6>
            <p><?php echo $satir['urun_adi'] ?></p>
        </div>
    </div>
    <?php
}
```

#### Kullanılan Kavramlar:
1. **Fonksiyonlar**:
   - PHP'de tekrar eden işlemleri bir fonksiyon içinde tanımlayarak kolayca çağırabiliriz.
2. **Koşul Yapısı**:
   - İndirimli ürünleri ve normal fiyatlı ürünleri kontrol ederek uygun fiyatı gösterir.
3. **Dinamik İçerik**:
   - Veritabanından gelen `$satir` değişkeni kullanılarak içerik oluşturulur.

---

##  (`eticaret/index.php`)

### Ürünlerin Listelenmesi
- **Kod Açıklaması**:
```php
$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_vitrin=1 ORDER BY RAND() LIMIT 20');
$sorgu->execute();
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    UrunListeKartiOlustur($satir);
}
```
#### Detaylar:
- **PDO**: Veritabanı sorgularını çalıştırır.
- **`while` Döngüsü**: Tüm ürünleri gezerek her bir ürün için `UrunListeKartiOlustur` fonksiyonu çağrılır.
- **Filtreleme**: `urun_vitrin=1` koşulu ile yalnızca vitrin ürünleri alınır.

---

### Kategori Filtreleme
- **Kod Açıklaması**:
```php
$sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=0 ORDER BY kategori_sira');
$sorgu->execute();
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    echo '<li><a id="kat_' . $satir['kategori_id'] . '" href="javascript:KategoriDetay(' . $satir['kategori_id'] . ');">' . $satir['kategori_adi'] . '</a></li>';
}
```
#### Detaylar:
- **Kategori Menüsü**: Ana kategoriler listelenir.
- **JavaScript ile Etkileşim**:
    - `KategoriDetay` fonksiyonu, kategoriye tıklandığında ürün listesini günceller.

---

## (`eticaret/urun_listesi.php`)

### Alt Kategorilerin Getirilmesi
- **Fonksiyon: `AltKategoriListGetir`**
  - Alt kategorileri rekürsif olarak listeye ekler.
```php
function AltKategoriListGetir($KategoriID) {
    global $db, $ids;
    $sorgu = $db->prepare('SELECT kategori_id FROM urun_kategori WHERE kategori_ust_id=?');
    $sorgu->execute(array($KategoriID));
    while ($satir = $sorgu->fetch(PDO::FETCH_NUM)) {
        $ids .= "," . $satir[0];
        AltKategoriListGetir($satir[0]);
    }
}
```

#### Detaylar:
1. **Rekürsif Fonksiyon**:
   - Fonksiyon kendisini çağırarak alt kategorileri bulur.
2. **`global` Anahtar Kelimesi**:
   - Fonksiyon dışındaki değişkenlere erişmek için kullanılır.

---

### Ürünlerin Filtrelenmesi ve Gösterimi
```php
$sorgu = $db->prepare('SELECT * FROM urun WHERE urun_kategori_id IN (' . $ids . ') ORDER BY RAND() LIMIT 20');
$sorgu->execute();
while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="col-lg-3 col-sm-6">';
    UrunListeKartiOlustur($satir);
    echo '</div>';
}
```
- Seçilen kategori ve alt kategorilere ait ürünler listelenir.

---

## (`eticaret/ust.php`)

### Dinamik Menü Yapısı
- **Kod Açıklaması**:
```php
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
```
#### Detaylar:
- **Alt Menülerin Oluşturulması**:
   - Alt kategoriler kontrol edilip menüye eklenir.
- **Koşullu Yapı**:
   - Eğer alt kategori varsa, bir alt menü oluşturulur.

---

### JavaScript ile Kategori Etkileşimi
```javascript
function KategoriDetay(KategoriID) {
    $('.product-filter-menu li a').removeClass('bg-danger text-white');
    $('#kat_' + KategoriID).addClass('bg-danger text-white');
    $.ajax({
        method: "POST",
        url: "urun_listesi.php",
        data: { KategoriID: KategoriID }
    })
    .done(function(msg) {
        $('#UrunListesi').html(msg);
    });
}
```
- **AJAX**:
   - Sayfa yenilemeden kategoriye ait ürünler dinamik olarak gösterilir.

-------------------------------------------------------------------------------------------------------------------

### 1. **`ayar` Tablosu**

| Sütun Adı          | Veri Tipi       | Açıklama                                         |
|---------------------|-----------------|--------------------------------------------------|
| `ayar_id`           | `int(11)`       | Benzersiz ID (Primary Key)                       |
| `ayar_baslik`       | `varchar(100)`   | Web sitesinin başlık bilgisi                    |
| `ayar_aciklama`     | `varchar(255)`   | Web sitesinin açıklaması                        |
| `ayar_anahtarkelime`| `varchar(255)`   | SEO için anahtar kelimeler                       |
| `ayar_facebook`     | `varchar(100)`   | Facebook bağlantısı                              |
| `ayar_x`            | `varchar(100)`   | Twitter bağlantısı                              |
| `ayar_instagram`    | `varchar(100)`   | Instagram bağlantısı                            |
| `ayar_youtube`      | `varchar(100)`   | YouTube bağlantısı                              |
| `ayar_msunucu`      | `varchar(50)`    | Mail sunucusu                                    |
| `ayar_mport`        | `int(4)`         | Mail sunucusunun portu                          |
| `ayar_madres`       | `varchar(100)`   | Mail adresi                                     |
| `ayar_msifre`       | `varchar(20)`    | Mail şifresi                                    |

### 2. **`urun` Tablosu**

| Sütun Adı             | Veri Tipi        | Açıklama                                          |
|------------------------|------------------|---------------------------------------------------|
| `urun_id`              | `int(11)`        | Benzersiz ürün ID'si (Primary Key)                |
| `urun_kategori_id`     | `int(11)`        | Ürünün ait olduğu kategori ID'si                  |
| `urun_barkod`          | `varchar(15)`    | Ürünün barkod numarası                            |
| `urun_adi`             | `varchar(150)`   | Ürünün adı                                       |
| `urun_aciklama`        | `text`           | Ürün açıklaması                                  |
| `urun_fiyat`           | `decimal(8,2)`   | Ürün fiyatı (8 basamağa kadar, 2 ondalıklı)        |
| `urun_indirim`         | `tinyint(4)`     | Ürünün indirim oranı                              |
| `urun_marka`           | `varchar(15)`    | Ürünün markası                                    |
| `urun_vitrin`          | `tinyint(1)`     | Ürün vitrinde gösterilsin mi? (1: Evet, 0: Hayır)  |
| `urun_gorulmesayisi`   | `int(11)`        | Ürün kaç kez görüntülendi                        |
| `urun_eklemetarihi`    | `timestamp`      | Ürün eklenme tarihi (otomatik olarak ayarlanır)   |

### 3. **`urun_kategori` Tablosu**

| Sütun Adı           | Veri Tipi       | Açıklama                                          |
|---------------------|-----------------|---------------------------------------------------|
| `kategori_id`       | `int(11)`       | Benzersiz kategori ID'si (Primary Key)            |
| `kategori_ust_id`   | `int(11)`       | Ana kategori ID'si (0 ise üst kategori yok)       |
| `kategori_adi`      | `varchar(25)`   | Kategorinin adı                                   |
| `kategori_sira`     | `tinyint(4)`    | Kategorinin sırası                                |

### 4. **`urun_stok` Tablosu**

| Sütun Adı           | Veri Tipi       | Açıklama                                          |
|---------------------|-----------------|---------------------------------------------------|
| `stok_id`           | `int(11)`       | Benzersiz stok ID'si (Primary Key)                |
| `urun_id`           | `int(11)`       | İlgili ürünün ID'si                               |
| `stok_renk`         | `varchar(6)`    | Ürünün rengini belirten hex kodu (örneğin, #FFFFFF)|
| `stok_beden`        | `varchar(3)`    | Ürünün beden bilgisi (S, M, L gibi)               |
| `stok_adet`         | `smallint(6)`   | Mevcut stok miktarı                               |

## Tablo Veri Tiplerinin Açıklamaları

- **`int(11)`**: Tam sayı, 11 basamağa kadar (genellikle pozitif sayılar için kullanılır).
- **`varchar(x)`**: Değişken uzunluktaki karakter dizisi. X, bu dizinin maksimum uzunluğudur.
- **`text`**: Daha büyük metin verilerini depolamak için kullanılır.
- **`decimal(p, s)`**: Sayısal veri tipi, p toplam basamağı ve s ondalıklı basamağı belirtir.
- **`tinyint`**: 1 baytlık tam sayı, genellikle 0 ve 1 gibi küçük değerler için kullanılır (boolean değerler için uygundur).
- **`timestamp`**: Zaman damgası, genellikle tarih ve saati depolamak için kullanılır.

## İlişkiler ve Bağlantılar

- **`urun` ve `urun_kategori`**: Her ürün, bir kategoriye bağlıdır. `urun_kategori_id` sütunu, `urun_kategori` tablosundaki `kategori_id` ile ilişkilidir.
- **`urun_stok` ve `urun`**: Her stok kaydı, belirli bir ürüne aittir. `urun_id` sütunu, `urun` tablosundaki `urun_id` ile ilişkilidir.
