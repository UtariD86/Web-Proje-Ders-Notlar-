
###  **`alt.php`**  

- **Eklenti Yükleme ve Yazılım İyileştirmeleri**: Eğer `urun_detay.php` sayfası çağrılmışsa, `summernote` editörünü yüklemek için JavaScript kodları ekleniyor. Bu, ürün açıklaması alanını text editör kullanarak zenginleştiriyor ve kullanıcıların açıklama yazarken daha kapsamlı formatlama yapabilmesini sağlıyor.
    ```php
    if(strpos($_SERVER['SCRIPT_NAME'],'urun_detay.php')) {
        echo '<script src="plugins/summernote/summernote-bs4.min.js"></script>
        <script>$(function () {$("#urun_aciklama").summernote({height: 250})})</script>';
    }
    ```
    - **Veri Kontrolü**: `$_GET['sonuc']` parametresi varsa bir işlem yapılması bekleniyor, ancak detay verilmemiş.

### **`urun_detay.php`**  
- **Ürün Detayları**: Bu dosya, ürün düzenleme sayfasıdır. Eğer `$_GET['id']` parametresi yoksa sıfır değerine atanarak varsayılan bir ürün verisi gösterilir. Eğer `id` geçerliyse, `urun` tablosundan ilgili ürünün bilgileri çekilir ve formda görüntülenir.
    - **Form Alanları**: Ürün detayları (kategori, barkod, isim, fiyat, indirim, marka) gibi bilgilerin kullanıcı tarafından düzenlenebilmesi için `input` alanları eklenmiştir.
    - **Görülme Sayısı ve Ekleme Tarihi**: Eğer ürün zaten veritabanında varsa, eklenen `görülme sayısı` ve `ekleme tarihi` gibi veriler de formda yer alır fakat sadece okunabilir (disabled) olarak sunulur.
    - **Açıklama Alanı**: `summernote` ile entegre edilen bir `textarea` alanı, ürün açıklaması eklemeye olanak sağlar.
    ```php
    <textarea class="form-control" rows="15" id="urun_aciklama" name="urun_aciklama"><?php echo $satir['urun_aciklama'] ?></textarea>
    ```

### **`urun_kaydet.php`**  
- **Veri Kaydetme**: Bu dosya, ürün ekleme ve düzenleme işlemlerini gerçekleştirir. Eğer bir ürün `urun_id` parametresi ile güncelleniyorsa, `UPDATE` işlemi yapılır, aksi takdirde yeni bir ürün eklemek için `INSERT` işlemi yapılır.
    - **Veri Gönderme**: Form verileri `$_POST` ile alınır, ardından bunlar hazırlanan SQL sorgusuna yerleştirilir ve veritabanına kaydedilir.
    ```php
    $sorgu = 'urun SET 
    urun_kategori_id=:urun_kategori_id,
    urun_barkod=:urun_barkod,
    urun_adi=:urun_adi,
    urun_fiyat=:urun_fiyat,
    urun_indirim=:urun_indirim,
    urun_marka=:urun_marka,
    urun_aciklama=:urun_aciklama';
    ```
    - **Veri Yönlendirme**: İşlem tamamlandığında kullanıcı, güncellenen ya da yeni eklenen ürünün detay sayfasına yönlendirilir.
    ```php
    header("Location:urun_detay.php?id=" . $_POST['urun_id'] . "&sonuc=" . $sonuc);
    ```

----------------------------------------------------------------------
Bu SQL dökümü, **io** adında bir veritabanı oluşturuyor ve içinde iki tablo barındırıyor: `ayar` ve `urun`. Şimdi her bir tabloyu ve içerdiği verileri daha ayrıntılı şekilde açıklayalım.

## **`ayar` Tablosu**

Bu tablo, web sitesi ayarlarıyla ilgili bilgileri tutar. Aşağıda tablonun yapısı ve açıklaması yer almaktadır:

| **Sütun Adı**          | **Veri Tipi**       | **Açıklama**                           |
|------------------------|---------------------|----------------------------------------|
| `ayar_id`              | int(11)             | Ayarların benzersiz kimliği (Primary Key) |
| `ayar_baslik`          | varchar(100)        | Web sitesi başlığı                      |
| `ayar_aciklama`        | varchar(255)        | Web sitesi açıklaması                   |
| `ayar_anahtarkelime`   | varchar(255)        | SEO anahtar kelimeler                   |
| `ayar_facebook`        | varchar(100)        | Facebook bağlantısı                     |
| `ayar_x`               | varchar(100)        | Twitter bağlantısı                      |
| `ayar_instagram`       | varchar(100)        | Instagram bağlantısı                    |
| `ayar_youtube`         | varchar(100)        | YouTube bağlantısı                      |
| `ayar_msunucu`         | varchar(50)         | E-posta sunucu adresi                   |
| `ayar_mport`           | int(4)              | E-posta sunucu portu                    |
| `ayar_madres`          | varchar(100)        | E-posta adresi                          |
| `ayar_msifre`          | varchar(20)         | E-posta şifresi                         |

Bu tabloda, sitenin sosyal medya hesapları ve e-posta sunucu bilgileri gibi çeşitli ayarları saklamak için kullanılır.

**Veri Örneği:**
```sql
INSERT INTO `ayar` 
  (`ayar_id`, `ayar_baslik`, `ayar_aciklama`, `ayar_anahtarkelime`, `ayar_facebook`, `ayar_x`, `ayar_instagram`, `ayar_youtube`, `ayar_msunucu`, `ayar_mport`, `ayar_madres`, `ayar_msifre`) 
VALUES
  (1, 'KTUN TBMYO Web Proje Yönetimi', 'Web Proje Yönetimi dersi için kodlanmıştır.', 'KTUN TBMYO, WPY, E-Ticaret, Çanta, Ayakkabı', 'https://www.facebook.com/KTUNEDU/', 'https://twitter.com/ktunedu', 'https://www.instagram.com/ktunedu/', 'https://www.youtube.com/channel/UCnVoJHinCNBfu2UeypZ9frA', 'smtp.gmail.com', 587, 'mail@gmail.com', '123456');
```

## **`urun` Tablosu**

Bu tablo, ürün bilgilerini tutar. Aşağıda tablonun yapısı ve açıklaması yer almaktadır:

| **Sütun Adı**           | **Veri Tipi**       | **Açıklama**                                  |
|-------------------------|---------------------|-----------------------------------------------|
| `urun_id`               | int(11)             | Ürünün benzersiz kimliği (Primary Key)         |
| `urun_kategori_id`      | int(11)             | Ürünün kategori ID'si                         |
| `urun_barkod`           | varchar(15)         | Ürünün barkod numarası                        |
| `urun_adi`              | varchar(150)        | Ürünün adı                                    |
| `urun_aciklama`         | text                | Ürünün açıklaması                             |
| `urun_fiyat`            | decimal(8,2)        | Ürünün fiyatı (örneğin: 123.45)               |
| `urun_indirim`          | tinyint(4)          | Ürüne uygulanan indirim oranı (%)             |
| `urun_marka`            | varchar(15)         | Ürünün markası                                |
| `urun_gorulmesayisi`    | int(11)             | Ürünün kaç kez görüntülendiği sayısı          |
| `urun_eklemetarihi`     | timestamp           | Ürünün eklenme tarihi (otomatik olarak atanır) |

Bu tabloda, her bir ürünle ilgili bilgilerin (kategori, barkod, fiyat, açıklama vb.) saklandığı yerdir.

**Veri Örneği:**
```sql
INSERT INTO `urun` 
  (`urun_id`, `urun_kategori_id`, `urun_barkod`, `urun_adi`, `urun_aciklama`, `urun_fiyat`, `urun_indirim`, `urun_marka`, `urun_gorulmesayisi`, `urun_eklemetarihi`) 
VALUES
  (1, 1, '1234567890', 'Deneme Ürün Adı 1', 'Ürün Açıklama 1', '123.00', 0, 'ABC', 0, '2024-10-17 16:29:10');
```

---
