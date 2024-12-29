### **`yonet/alt.php`**


 **Dinamik Uyarı Mesajları (`isset` Kullanımı):**
 
 ```php
 
 <?php
// Eğer URL'de 'sonuc' parametresi varsa bu blok çalışır
if (isset($_GET['sonuc'])) {
    // JavaScript kodu burada yer alır
    ?>
    <script>
        $(function() {
            // SweetAlert2'nin ayarları
            var Toast = Swal.mixin({
                toast: true, // Bildirimi küçük bir kutu halinde gösterir
                position: 'top-end', // Sağ üst köşede gösterir
                showConfirmButton: false, // Onay butonunu kaldırır
                timer: 3000 // Bildirimi 3 saniye sonra kapatır
            });

            // Uyarı mesajını tetikleyen kod
            Toast.fire({
                <?php
                // Eğer 'sonuc' true ise başarı, değilse hata mesajı gösterilir
                if ($_GET['sonuc']) {
                    ?>
                    icon: 'success', // Başarı ikonu
                    title: 'Kayıt İşlemi Başarılı' // Başarı mesajı
                    <?php
                } else {
                    ?>
                    icon: 'error', // Hata ikonu
                    title: 'Hata Alındı Tekrar Deneyiniz' // Hata mesajı
                    <?php
                }
                ?>
            });
        });
    </script>
    <?php
}
?>
 
 ```
 
 
   ```php
   if (isset($_GET['sonuc'])) {
   ```
   - **`isset`:** Bir değişkenin tanımlanıp tanımlanmadığını kontrol eder. 
     - Burada, **`$_GET['sonuc']`** parametresinin URL’de var olup olmadığını kontrol ediyoruz.
   - Eğer bu parametre varsa:
     - **Başarılı Mesaj:** 
       ```javascript
       icon: 'success',
       title: 'Kayıt İşlemi Başarılı'
       ```
     - **Hata Mesajı:** 
       ```javascript
       icon: 'error',
       title: 'Hata Alındı Tekrar Deneyiniz'
       ```

 **Dinamik Uyarı Gösterimi:**
   - SweetAlert2 kütüphanesi kullanılarak bir uyarı mesajı gösteriliyor.
   - **Özellikler:**
     - **`toast: true`**: Uyarı ekranın köşesinde küçük bir pencere olarak görünür.
     - **`position: 'top-end'`**: Uyarının ekranın sağ üst köşesinde yer almasını sağlar.
     - **`timer: 3000`**: Mesaj 3 saniye sonra otomatik olarak kapanır.

------------------------------------------------------------------------------------------------------

### **`yonet/ust.php`**

```php

<?php
// 'baglan.php' dosyası dahil ediliyor, veritabanı bağlantısı bu dosyada tanımlı
include "baglan.php";

// Veritabanındaki 'ayar' tablosundaki tüm veriler çekiliyor
$ayar = $db->prepare("SELECT * FROM ayar");
$ayar->execute();
$ayar = $ayar->fetch(PDO::FETCH_ASSOC); // Veriler bir dizi olarak alınıyor
?>

```



 **Veritabanı Bağlantısı:**
   ```php
   include "baglan.php";
   ```
   - **`include`:** Başka bir dosyayı çağırmak için kullanılır.
   - Burada, veritabanına bağlanmak için **`baglan.php`** dosyası ekleniyor.

 **Ayarların Getirilmesi:**
   ```php
   $ayar = $db->prepare("SELECT * FROM ayar");
   $ayar->execute();
   $ayar = $ayar->fetch(PDO::FETCH_ASSOC);
   ```
   - **`prepare` ve `execute`:** SQL sorgusunu güvenli bir şekilde çalıştırır.
   - **`fetch(PDO::FETCH_ASSOC)`:** Veritabanından alınan veriyi bir dizi (array) olarak döndürür.
   - Burada, **ayar** tablosundan alınan veriler kullanılarak site başlığı gibi bilgiler dinamik olarak dolduruluyor.

 **Dinamik Başlık:**
   ```php
   <title>Yönetim Paneli | <?php echo $ayar['ayar_baslik'] ?></title>
   ```
   - **`echo`:** PHP'de bir değeri ekrana yazdırır.
   - **`$ayar['ayar_baslik']`:** Veritabanından çekilen başlık değeri burada kullanılıyor.

 **Menü Yapısı:**
   ```html
   <a href="#" class="nav-link active">
     <i class="nav-icon fas fa-cubes"></i>
     <p>
       Ürünler
       <i class="right fas fa-angle-left"></i>
     </p>
   </a>
   ```
   - Menüde **ürünler** kısmı oluşturuluyor.
   - **Yeni Ürün Ekle ve Ürün Listesi:** Alt menüde bu iki seçeneği içerir.
     ```html
     <a href="urun_detay.php" class="nav-link active">Yeni Ürün Ekle</a>
     <a href="urun_liste.php" class="nav-link">Ürün Listesi</a>
     ```

---------------------------------------------------------------------------------------------------------------------------------------------------------


### Veritabanı Açıklaması ve Tablolar

Bu veritabanı, bir yönetim paneline ait yapılandırma ayarları ve ürün bilgilerini saklamak için kullanılmıştır. Aşağıda tablolara ait yapı ve veri tipleri detaylıca açıklanmıştır.

---

### Tablo 1: `ayar`

**Amaç:** Sistem genelindeki yapılandırma bilgilerini tutar. Bu bilgiler, yönetim panelinde kullanılan başlık, açıklama, anahtar kelimeler, sosyal medya linkleri ve mail sunucusu ayarları gibi öğeleri içerir.

| **Alan Adı**      | **Veri Tipi**   | **Açıklama**                                                                 |
|--------------------|-----------------|-------------------------------------------------------------------------------|
| `ayar_id`          | `int(11)`      | **Birincil Anahtar**. Ayarlar tablosundaki her kaydı benzersiz olarak tanımlar. |
| `ayar_baslik`      | `varchar(100)` | Yönetim paneli başlığı.                                                       |
| `ayar_aciklama`    | `varchar(255)` | Yönetim paneli açıklaması.                                                    |
| `ayar_anahtarkelime` | `varchar(255)` | Panel için kullanılan anahtar kelimeler.                                      |
| `ayar_facebook`    | `varchar(100)` | Facebook sayfasının bağlantısı.                                               |
| `ayar_x`           | `varchar(100)` | Twitter veya X bağlantısı.                                                    |
| `ayar_instagram`   | `varchar(100)` | Instagram sayfasının bağlantısı.                                              |
| `ayar_youtube`     | `varchar(100)` | YouTube kanal bağlantısı.                                                     |
| `ayar_msunucu`     | `varchar(50)`  | Mail sunucusunun adresi.                                                      |
| `ayar_mport`       | `int(4)`       | Mail sunucusunun port numarası.                                               |
| `ayar_madres`      | `varchar(100)` | Kullanılan e-posta adresi.                                                    |
| `ayar_msifre`      | `varchar(20)`  | Mail adresinin şifresi.                                                       |

---

#### Örnek Veri:
| **ayar_id** | **ayar_baslik**               | **ayar_aciklama**                          | **ayar_msunucu** | **ayar_mport** | **ayar_madres**      | **ayar_msifre** |
|-------------|-------------------------------|--------------------------------------------|------------------|----------------|----------------------|-----------------|
| 1           | KTUN TBMYO Web Proje Yönetimi | Web Proje Yönetimi dersi için kodlanmıştır. | smtp.gmail.com   | 587            | mail@gmail.com       | 123456          |

---

### Tablo 2: `urun`

**Amaç:** Sistemde yer alan ürünlerin bilgilerini tutar. Ürünler, kategoriye göre ilişkilendirilmiş olup ürün fiyatı, açıklaması, barkod bilgisi gibi özellikleri içerir.

| **Alan Adı**           | **Veri Tipi**      | **Açıklama**                                                                      |
|-------------------------|--------------------|-----------------------------------------------------------------------------------|
| `urun_id`              | `int(11)`         | **Birincil Anahtar**. Ürünü benzersiz olarak tanımlar.                            |
| `urun_kategori_id`     | `int(11)`         | Ürünün hangi kategoriye ait olduğunu belirler.                                    |
| `urun_barkod`          | `varchar(15)`     | Ürünün barkod numarası.                                                           |
| `urun_adi`             | `varchar(150)`    | Ürünün adı.                                                                       |
| `urun_aciklama`        | `text`            | Ürünün detaylı açıklaması.                                                        |
| `urun_fiyat`           | `decimal(8,2)`    | Ürünün fiyatı (8 basamaklı, 2 ondalık basamak).                                   |
| `urun_indirim`         | `tinyint(4)`      | Ürün için indirim oranı (% olarak ifade edilir).                                  |
| `urun_marka`           | `varchar(15)`     | Ürünün markası.                                                                   |
| `urun_gorulmesayisi`   | `int(11)`         | Ürünün kaç kez görüntülendiği.                                                    |
| `urun_eklemetarihi`    | `timestamp`       | Ürünün eklenme tarihi. Varsayılan olarak anlık tarih atanır.                      |

---

#### Örnek Veri:
| **urun_id** | **urun_kategori_id** | **urun_barkod** | **urun_adi**          | **urun_aciklama** | **urun_fiyat** | **urun_indirim** | **urun_marka** | **urun_gorulmesayisi** | **urun_eklemetarihi**      |
|-------------|-----------------------|------------------|-----------------------|-------------------|----------------|------------------|---------------|------------------------|--------------------------|
| 1           | 1                     | 1234567890       | Deneme Ürün Adı 1     | Ürün Açıklama 1   | 123.00         | 0                | ABC           | 0                      | 2024-10-17 16:29:10       |
| 2           | 1                     | 1234567892       | Deneme Ürün Adı 2     | Ürün Açıklama 2   | 2123.00        | 0                | ABC           | 0                      | 2024-10-17 16:32:06       |

---

### Önemli Notlar:
- **AUTO_INCREMENT:** `ayar` ve `urun` tablolarında birincil anahtarlar (`ayar_id` ve `urun_id`) otomatik olarak artacak şekilde ayarlanmıştır.
- **COLLATE:** Veriler, Türkçe karakter uyumluluğu için `utf8_turkish_ci` ile saklanmıştır.
- **INDEX:** `ayar` ve `urun` tabloları birincil anahtarlar (`PRIMARY KEY`) ile indekslenmiştir.

Bu yapılandırma, **yönetim paneli** için temel veritabanı tablolarını tanımlamakta ve veri işleme süreçlerini optimize etmekte kullanılır.