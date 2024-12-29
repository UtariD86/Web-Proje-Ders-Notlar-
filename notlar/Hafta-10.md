

### `urun_detay.php`

#### Değişiklikler:
- Ürün stok bilgilerinin gösterimi ve düzenlenmesi için bir bölüm eklendi.
- Dinamik kategori listesi oluşturuldu.

#### Kod Açıklamaları:
```php
<li class="nav-item">
    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Genel Bilgiler</a>
</li>
```
- **class="nav-link active":** Bootstrap'te aktif sekmeyi belirtir.
- **data-toggle="pill":** Sekmeler arasında geçiş sağlar.

---

```php
if ($satir['urun_id'] > 0) {
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Stok Bilgileri</a>
    </li>
}
```
- **$satir['urun_id'] > 0:** Ürünün mevcut olup olmadığını kontrol eder. Mevcutsa stok sekmesi eklenir.

---

#### Dinamik Kategori Listesi
```php
function KategoriListesiOlustur($UstID = 0, $ayrac = '> ') {
    global $db, $VarolanKategoriID;
    $sorgu = $db->prepare('SELECT * FROM urun_kategori WHERE kategori_ust_id=? ORDER BY kategori_sira');
    $sorgu->execute(array($UstID));
    while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $satir['kategori_id'] . '">' . $ayrac . $satir['kategori_adi'] . '</option>';
        KategoriListesiOlustur($satir['kategori_id'], '---' . $ayrac);
    }
}
```
- **KategoriListesiOlustur:** Kategorileri hiyerarşik olarak listeleyen bir fonksiyon.
- **global $db:** Veritabanı bağlantısını global olarak kullanır.
- **PDO::FETCH_ASSOC:** Sorgudan dönen verileri sütun adlarına göre bir dizi olarak alır.

---

#### Stok Bilgisi Tablosu
```php
<table class="table">
    <tr>
        <th>#</th>
        <th>Renk</th>
        <th>Beden</th>
        <th>Adet</th>
        <th></th>
    </tr>
    <?php
    $stoks = $db->prepare('SELECT * FROM urun_stok WHERE urun_id=?');
    $stoks->execute(array($satir['urun_id']));
    while ($stok = $stoks->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <tr>
        <td><?php echo ++$sira; ?></td>
        <td><input type="text" id="stok_renk_<?php echo $stok['stok_id']; ?>" value="<?php echo $stok['stok_renk']; ?>"></td>
        <td><input type="text" id="stok_beden_<?php echo $stok['stok_id']; ?>" value="<?php echo $stok['stok_beden']; ?>"></td>
        <td><input type="text" id="stok_adet_<?php echo $stok['stok_id']; ?>" value="<?php echo $stok['stok_adet']; ?>"></td>
    </tr>
    <?php } ?>
</table>
```
- **$db->prepare:** Güvenli bir SQL sorgusu hazırlar.
- **$stoks->fetch:** Stok bilgilerini döngüyle çeker.

---

#### AJAX ile Veri Güncelleme
```javascript
function StokKaydet(stok_id) {
    var stok_renk = $('#stok_renk_' + stok_id).val();
    var stok_beden = $('#stok_beden_' + stok_id).val();
    var stok_adet = $('#stok_adet_' + stok_id).val();
    $.ajax({
        method: "POST",
        url: "urun_stok_kaydet.php",
        data: { stok_id, stok_renk, stok_beden, stok_adet },
    })
    .done(function(msg) {
        if (msg === 'true') alert("Stok kaydedildi");
        else alert("Hata oluştu");
    });
}
```
- **AJAX:** Form verisini `urun_stok_kaydet.php` dosyasına gönderir ve sonucu kontrol eder.

---

### `urun_kategori.php`

#### Değişiklikler:
- Kategoriler, hiyerarşik yapıda listelenmiştir.

#### Kod Açıklamaları:
```php
echo $ayrac . $satir['kategori_adi'] . '<a href="urun_kategori_ekle.php?ust_id=' . $satir['kategori_id'] . '"><i class="fas fa-plus"></i></a><br>';
```
- **$satir['kategori_adi']:** Kategori adı.
- **<a href="urun_kategori_ekle.php">:** Alt kategori ekleme bağlantısı.

---

### `yonet/urun_kategori_ekle.php`

#### Değişiklikler:
- Kategori adı ve sırası form ile alınır ve veritabanına eklenir.

#### Kod Açıklamaları:
```php
if (isset($_POST['kategori_adi'], $_POST['kategori_sira'])) {
    $sorgu = $db->prepare('INSERT INTO urun_kategori(kategori_ust_id,kategori_adi,kategori_sira) VALUES(?,?,?)');
    $sorgu->execute(array($_GET['ust_id'], $_POST['kategori_adi'], $_POST['kategori_sira']));
    header("Location:urun_kategori.php");
}
```
- **header("Location:urun_kategori.php"):** İşlem tamamlandıktan sonra kategori listesine yönlendirir.

---------------------------------------------------------------------------------------------------------------------------------------------


### 1. Tablo: `ayar`
**Açıklama:** Sistem ayarlarını ve bağlantı bilgilerini tutar.

| Sütun Adı        | Veri Tipi      | Açıklama                                         |
|-------------------|----------------|-------------------------------------------------|
| `ayar_id`         | `int(11)`      | Birincil anahtar.                               |
| `ayar_baslik`     | `varchar(100)` | Site başlığı.                                   |
| `ayar_aciklama`   | `varchar(255)` | Site açıklaması.                                |
| `ayar_anahtarkelime` | `varchar(255)` | Anahtar kelimeler.                              |
| `ayar_facebook`   | `varchar(100)` | Facebook adresi.                                |
| `ayar_x`          | `varchar(100)` | X platformu adresi (ör. Twitter).              |
| `ayar_instagram`  | `varchar(100)` | Instagram adresi.                               |
| `ayar_youtube`    | `varchar(100)` | YouTube kanalı adresi.                          |
| `ayar_msunucu`    | `varchar(50)`  | Mail sunucu adresi.                             |
| `ayar_mport`      | `int(4)`       | Mail sunucu port numarası.                      |
| `ayar_madres`     | `varchar(100)` | Mail adresi.                                    |
| `ayar_msifre`     | `varchar(20)`  | Mail şifresi.                                   |

---

### 2. Tablo: `urun`
**Açıklama:** Ürün bilgilerini tutar.

| Sütun Adı            | Veri Tipi        | Açıklama                            |
|-----------------------|------------------|--------------------------------------|
| `urun_id`            | `int(11)`        | Birincil anahtar.                   |
| `urun_kategori_id`   | `int(11)`        | Kategori ID (ürünün kategorisi).    |
| `urun_barkod`        | `varchar(15)`    | Barkod numarası.                    |
| `urun_adi`           | `varchar(150)`   | Ürün adı.                           |
| `urun_aciklama`      | `text`           | Ürün açıklaması.                    |
| `urun_fiyat`         | `decimal(8,2)`   | Ürün fiyatı.                        |
| `urun_indirim`       | `tinyint(4)`     | İndirim oranı (yüzde olarak).       |
| `urun_marka`         | `varchar(15)`    | Ürün markası.                       |
| `urun_gorulmesayisi` | `int(11)`        | Görüntülenme sayısı.                |
| `urun_eklemetarihi`  | `timestamp`      | Eklenme tarihi.                     |

---

### 3. Tablo: `urun_kategori`
**Açıklama:** Ürün kategorilerini tutar.

| Sütun Adı       | Veri Tipi       | Açıklama                          |
|------------------|-----------------|------------------------------------|
| `kategori_id`    | `int(11)`       | Birincil anahtar.                 |
| `kategori_ust_id`| `int(11)`       | Üst kategori ID'si (hiyerarşi).   |
| `kategori_adi`   | `varchar(25)`   | Kategori adı.                     |
| `kategori_sira`  | `tinyint(4)`    | Sıralama bilgisi.                 |

---

### 4. Tablo: `urun_stok`
**Açıklama:** Ürün stok bilgilerini tutar.

| Sütun Adı    | Veri Tipi       | Açıklama                           |
|--------------|-----------------|-------------------------------------|
| `stok_id`    | `int(11)`       | Birincil anahtar.                  |
| `urun_id`    | `int(11)`       | Ürün ID (stok bilgisi hangi ürüne ait). |
| `stok_renk`  | `varchar(6)`    | Renk bilgisi.                      |
| `stok_beden` | `varchar(3)`    | Beden bilgisi.                     |
| `stok_adet`  | `smallint(6)`   | Stok adedi.                        |

---

### Örnek Veriler

**Tablo: `ayar`**
| `ayar_id` | `ayar_baslik`               | `ayar_aciklama`                | `ayar_facebook`                |
|-----------|-----------------------------|--------------------------------|---------------------------------|
| 1         | KTUN TBMYO Web Proje Yönetimi | Web Proje Yönetimi dersi için kodlanmıştır. | https://www.facebook.com/KTUNEDU/ |

**Tablo: `urun`**
| `urun_id` | `urun_adi`          | `urun_fiyat` | `urun_marka` |
|-----------|---------------------|--------------|--------------|
| 1         | Deneme Ürün Adı 1  | 123.00       | ABC          |
| 2         | Deneme Ürün Adı 2  | 2123.00      | ABC          |

**Tablo: `urun_kategori`**
| `kategori_id` | `kategori_adi`    | `kategori_ust_id` |
|---------------|-------------------|-------------------|
| 1             | Elektronik        | 0                 |
| 2             | Giyim             | 0                 |

**Tablo: `urun_stok`**
| `stok_id` | `urun_id` | `stok_renk` | `stok_beden` | `stok_adet` |
|-----------|-----------|-------------|--------------|-------------|
| 1         | 1         | 000001      | L            | 55          |

