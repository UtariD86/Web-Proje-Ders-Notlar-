
####  **`urun_detay.php`**


##### **Genel Bilgiler Sekmesi**
- **Tab Yapısı:** 
  - Kullanıcı, "Genel Bilgiler" ve "Stok Bilgileri" sekmeleri arasında geçiş yapabilir.
  - Sekme yapısı, Bootstrap ile oluşturulmuştur.

```php
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home">Genel Bilgiler</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile">Stok Bilgileri</a>
  </li>
</ul>
```

**Kavramlar:**
- **Sekme (Tab):** Bir web sayfasında birden fazla içeriği aynı alanda göstermek için kullanılan düzenleme yöntemi.
- **Bootstrap:** Modern web arayüzleri oluşturmak için kullanılan bir CSS framework'üdür.

##### **Ürün Detay Formu**
- Form, ürün bilgilerini almak ve `urun_kaydet.php` dosyasına göndermek üzere hazırlanmıştır.

```php
<form action="urun_kaydet.php" method="POST">
  <input type="hidden" name="urun_id" value="<?php echo $satir['urun_id'] ?>">
  <div class="form-group row">
    <label for="urun_kategori_id" class="col-sm-2 col-form-label">Kategori ID</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="urun_kategori_id" name="urun_kategori_id" value="<?php echo $satir['urun_kategori_id'] ?>">
    </div>
  </div>
</form>
```

**Kavramlar:**
- **Form:** Kullanıcıdan bilgi toplamak için kullanılan HTML elemanıdır.
- **`POST` Yöntemi:** Form verilerinin sunucuya güvenli bir şekilde gönderilmesini sağlar.
- **Gizli Girdi (`hidden`):** Formda kullanıcı tarafından görülmeyen, ama sunucuya gönderilen verileri saklamak için kullanılır.

##### **Açıklama Alanı**
- Ürün açıklaması, zengin metin düzenleyicisi (Summernote) kullanılarak düzenlenebilir.

```php
<textarea class="form-control" rows="15" id="urun_aciklama" name="urun_aciklama"><?php echo $satir['urun_aciklama'] ?></textarea>
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
```

**Kavramlar:**
- **Zengin Metin Düzenleyici:** Kullanıcıların HTML bilgisi olmadan metni biçimlendirmesine olanak tanır.

---

#### **Stok Bilgileri Sekmesi**

- Bu sekmede ürünün stok bilgileri (renk, beden, adet) listelenir ve düzenlenebilir.

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
      <td><?php echo ++$sira ?></td>
      <td><input type="text" id="stok_renk_<?php echo $stok['stok_id'] ?>" value="<?php echo $stok['stok_renk'] ?>"></td>
      <td><input type="text" id="stok_beden_<?php echo $stok['stok_id'] ?>" value="<?php echo $stok['stok_beden'] ?>"></td>
      <td><input type="text" id="stok_adet_<?php echo $stok['stok_id'] ?>"></td>
      <td>
        <button type="button" onclick="StokKaydet(<?php echo $stok['stok_id'] ?>)" class="btn btn-outline-primary btn-sm">
          Kaydet
        </button>
      </td>
    </tr>
  <?php } ?>
</table>
```

**Kavramlar:**
- **`while` Döngüsü:** PHP'de bir listeyi dolaşmak için kullanılır.
- **AJAX:** Sayfa yenilemeden veri gönderip almak için kullanılan bir tekniktir.

##### **Stok Güncelleme İşlevi**
- **AJAX Kullanımı:**
  - Stok bilgileri güncellendiğinde, sunucuya AJAX isteği gönderilir.

```javascript
function StokKaydet(stok_id) {
  var stok_renk = $('#stok_renk_' + stok_id).val();
  var stok_beden = $('#stok_beden_' + stok_id).val();
  var stok_adet = $('#stok_adet_' + stok_id).val();

  $.ajax({
    method: "POST",
    url: "urun_stok_kaydet.php",
    data: {
      stok_id: stok_id,
      stok_renk: stok_renk,
      stok_beden: stok_beden,
      stok_adet: stok_adet
    }
  }).done(function(msg) {
    $('#StokKaydetSonuc_' + stok_id).html(msg);
  });
}
```

---

#### **`urun_stok_kaydet.php`**

- **Sunucu Tarafı Kontrol:**
  - Sunucu, AJAX isteği ile gönderilen stok bilgilerini kontrol eder.

```php
if (isset($_POST['stok_id'], $_POST['stok_renk'], $_POST['stok_beden'], $_POST['stok_adet'])) {
    echo "veriler geldi";
} else {
    echo "Yetkisiz erişim";
}
```

**Kavramlar:**
- **`isset`:** Değişkenin tanımlı olup olmadığını kontrol eder.
- **POST Verisi:** Form veya AJAX ile sunucuya gönderilen verilerdir.

------------------------------------------------------------------------------------------------------------------------------

## Tablolar ve Yapıları

### Tablo: `ayar`
Bu tablo, sistem ayarları ve genel bilgileri tutar.

| Sütun Adı         | Veri Tipi      | Uzunluk | Açıklama                                 |
|--------------------|---------------|---------|------------------------------------------|
| ayar_id           | int           | 11      | Birincil anahtar (Primary Key)          |
| ayar_baslik       | varchar       | 100     | Ayar başlığı                             |
| ayar_aciklama     | varchar       | 255     | Ayar açıklaması                          |
| ayar_anahtarkelime| varchar       | 255     | Anahtar kelimeler                        |
| ayar_facebook     | varchar       | 100     | Facebook bağlantısı                      |
| ayar_x            | varchar       | 100     | Twitter bağlantısı                       |
| ayar_instagram    | varchar       | 100     | Instagram bağlantısı                     |
| ayar_youtube      | varchar       | 100     | YouTube bağlantısı                       |
| ayar_msunucu      | varchar       | 50      | Mail sunucusu                            |
| ayar_mport        | int           | 4       | Mail sunucusu port numarası              |
| ayar_madres       | varchar       | 100     | Mail adresi                              |
| ayar_msifre       | varchar       | 20      | Mail şifresi                             |

---

### Tablo: `urun`
Ürünlerle ilgili temel bilgileri saklar.

| Sütun Adı           | Veri Tipi     | Uzunluk | Açıklama                                     |
|----------------------|--------------|---------|----------------------------------------------|
| urun_id             | int          | 11      | Birincil anahtar (Primary Key)              |
| urun_kategori_id    | int          | 11      | Ürünün ait olduğu kategori kimliği          |
| urun_barkod         | varchar      | 15      | Ürün barkod numarası                        |
| urun_adi            | varchar      | 150     | Ürün adı                                    |
| urun_aciklama       | text         | -       | Ürün açıklaması                             |
| urun_fiyat          | decimal      | 8,2     | Ürün fiyatı                                 |
| urun_indirim        | tinyint      | 4       | İndirim yüzdesi                             |
| urun_marka          | varchar      | 15      | Ürün markası                                |
| urun_gorulmesayisi  | int          | 11      | Görüntülenme sayısı                         |
| urun_eklemetarihi   | timestamp    | -       | Ürünün eklenme tarihi                       |

---

### Tablo: `urun_stok`
Ürün stok bilgilerini içerir.

| Sütun Adı     | Veri Tipi  | Uzunluk | Açıklama                                     |
|---------------|------------|---------|----------------------------------------------|
| stok_id       | int        | 11      | Birincil anahtar (Primary Key)              |
| urun_id       | int        | 11      | İlgili ürün kimliği (Foreign Key)           |
| stok_renk     | varchar    | 6       | Ürün rengi                                  |
| stok_beden    | varchar    | 3       | Ürün bedeni                                 |
| stok_adet     | smallint   | 6       | Stok adedi                                  |

## Örnek Veriler

### `ayar` Tablosu
| ayar_id | ayar_baslik                 | ayar_aciklama                          | ayar_facebook                | ayar_instagram                |
|---------|-----------------------------|----------------------------------------|------------------------------|------------------------------|
| 1       | KTUN TBMYO Web Proje Yönetimi | Web Proje Yönetimi dersi için kodlanmıştır. | https://www.facebook.com/KTUNEDU/ | https://www.instagram.com/ktunedu/ |

### `urun` Tablosu
| urun_id | urun_adi          | urun_fiyat | urun_indirim | urun_eklemetarihi |
|---------|-------------------|------------|--------------|--------------------|
| 1       | Deneme Ürün Adı 1 | 123.00     | 0            | 2024-10-17        |
| 2       | Deneme Ürün Adı 2 | 2123.00    | 0            | 2024-10-17        |

### `urun_stok` Tablosu
| stok_id | urun_id | stok_renk | stok_beden | stok_adet |
|---------|---------|-----------|------------|-----------|
| 1       | 1       | 000000    | XL         | 50        |
| 2       | 1       | FFFFFF    | XL         | 45        |
