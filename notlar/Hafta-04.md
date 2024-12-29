ayar.php

Ayarları Görüntüleme ve Düzenleme Sayfası
Bu dosya, yönetim panelinde ayarları görüntüleyebileceğiniz ve düzenleyebileceğiniz bir form oluşturur. İşleyişini adım adım açıklayalım:

a. PHP Bağlantıları:
```php

<?php
include "ust.php";
?>
```

Bu satırda, üst kısmı (header, navbar vb.) dahil eden ust.php dosyası çağrılır.
b. HTML Formu ve Veritabanı Verileri:

```php

<form action="ayar_kaydet.php" method="POST">

```

Bu form, kullanıcının ayarları değiştirebileceği bir arayüz sunar.
action="ayar_kaydet.php": Form gönderildiğinde, veriler ayar_kaydet.php dosyasına gönderilecektir.
c. Form Alanları:
Formda kullanıcıdan alınacak birkaç bilgi vardır. Örneğin:

Başlık (ayar_baslik)
Açıklama (ayar_aciklama)
Anahtar Kelimeler (ayar_anahtarkelime)
Sosyal medya bağlantıları (Facebook, Instagram, vb.)
Mail Sunucu Ayarları (Mail sunucu adresi, port, kullanıcı adı, şifre vb.)
Her bir form alanı, kullanıcıdan alınacak verileri input elemanları ile sağlar. Örneğin:

```php

<input type="text" class="form-control" id="ayar_baslik" name="ayar_baslik" value="<?php echo $ayar['ayar_baslik'] ?>" placeholder="Web sayfanızın başlığını giriniz">

```

Burada, veritabanından alınan mevcut başlık değeri (yani $ayar['ayar_baslik']) alana yerleştirilir, böylece kullanıcı mevcut başlığı görebilir ve değiştirebilir.
d. Formu Gönderme:
Form, kullanıcı "Kaydet" butonuna tıkladığında gönderilir ve veritabanına kaydedilmek üzere ayar_kaydet.php dosyasına yönlendirilir.

------------------------------------------------------------------------------------------------------------------------------------------------------------

ayar_kaydet.php

Ayarları Veritabanına Kaydetme
Bu dosya, yukarıda düzenlenen ayarları alır ve veritabanına kaydeder. Şimdi adım adım işleyişi açıklayalım:

a. Veritabanı Bağlantısı:
```php

include "baglan.php";

```
Bu satırda, veritabanı bağlantısı kuran baglan.php dosyası dahil edilir.
b. POST Verilerini Alma:
Form verileri $_POST süper globali aracılığıyla alınır. Bu veriler, kullanıcının formda yaptığı değişiklikleri içerir:

```php

if (isset($_POST['ayar_baslik'], $_POST['ayar_aciklama'], ...)) {

```

Bu koşul, form verilerinin olup olmadığını kontrol eder. Eğer formdaki tüm veriler gelmişse, ayarları güncelleme işlemine geçilir.

c. SQL Sorgusu Oluşturma:
PHP ile dinamik bir UPDATE sorgusu oluşturuluyor:

```php

$SQL = "UPDATE ayar SET
ayar_baslik=:ayar_baslik,
ayar_aciklama=:ayar_aciklama,
ayar_anahtarkelime=:ayar_anahtarkelime,
ayar_facebook=:ayar_facebook,
ayar_x=:ayar_x,
ayar_instagram=:ayar_instagram,
ayar_youtube=:ayar_youtube,
ayar_msunucu=:ayar_msunucu,
ayar_mport=:ayar_mport,
ayar_madres=:ayar_madres";

```

Bu sorgu, ayar tablosunda bulunan verileri günceller. :ayar_baslik, :ayar_aciklama gibi : ile başlayan parametreler, veritabanı sorgusuna parametre olarak eklenir.
d. Veritabanına Gönderilecek Verilerin Hazırlanması:
Formdan gelen veriler, bir associative array (anahtar-değer dizisi) olarak hazırlanır:

```php

$SQL_array = array(
    'ayar_baslik' => $_POST['ayar_baslik'],
    'ayar_aciklama' => $_POST['ayar_aciklama'],
    ...
);

```

Burada her form verisi, SQL sorgusunda kullanılacak parametrelere bağlanır.

e. Şifre Alanı:
Eğer kullanıcı şifreyi değiştirmişse, şifre de SQL sorgusuna eklenir:

```php

if ($_POST['ayar_msifre'] != "") {
    $SQL .= ",ayar_msifre=:ayar_msifre";
    $SQL_array['ayar_msifre'] = $_POST['ayar_msifre'];
}

```

f. SQL Sorgusunu Çalıştırma:
Sorgu hazırlanınca, prepare ve execute metotları ile çalıştırılır:

```php

$sorgu = $db->prepare($SQL);
$sonuc = $sorgu->execute($SQL_array);

```

Bu adım, veritabanına bağlantı kurar ve sorguyu işler. Başarılı olursa, sonuç değişkeni ile başarı durumu kontrol edilebilir.

g. Yönlendirme:
Son olarak, işlem sonucuna göre kullanıcı ayar.php sayfasına yönlendirilir:

```php

header("Location:ayar.php?sonuc=" . $sonuc);

```

Bu, sayfanın doğru şekilde yeniden yüklenmesini sağlar.

Özetle:
ayar.php dosyası, yönetim panelindeki ayarları düzenlemek için bir form sağlar.
ayar_kaydet.php dosyası, kullanıcının yaptığı değişiklikleri alır ve bunları veritabanına kaydeder.
Bu işlemde PDO kullanarak güvenli bir şekilde SQL sorguları çalıştırılır ve form verileri veritabanına eklenir.

Veritabanı Tablosu (Ayarlar):
Tablo adı: ayar
Sütunlar ve Veri Tipleri:
ayar_id (int): Ayar kaydının benzersiz kimliği.
ayar_baslik (varchar(100)): Web sayfasının başlığı.
ayar_aciklama (varchar(255)): Web sayfasının açıklaması.
ayar_anahtarkelime (varchar(255)): Web sayfasının anahtar kelimeleri.
ayar_facebook (varchar(100)): Facebook adresi.
ayar_instagram (varchar(100)): Instagram adresi.
ayar_youtube (varchar(100)): YouTube adresi.
ayar_msunucu (varchar(50)): Mail sunucusu adresi.
ayar_mport (int(4)): Mail sunucu portu.
ayar_madres (varchar(100)): Mail adresi.
ayar_msifre (varchar(20)): Mail adresi şifresi.

Bu yapı, yönetim paneli üzerinden kullanıcıların web sayfası için ayarları değiştirmesini sağlar.

------------------------------------------------------------------------------------------------------

Bu SQL dump dosyasında, **ayar** tablosu oluşturulmuş ve içine örnek veriler eklenmiştir. Tablo, bir web sitesinin yönetim ayarlarını saklamak için kullanılır. Şimdi, tablo yapısını ve içerdiği sütunları açıklayalım.

### **`ayar` Tablosu**

**Tablo Yapısı**:
| Sütun Adı           | Veri Tipi       | Açıklama                                      |
|---------------------|-----------------|-----------------------------------------------|
| `ayar_id`           | `int(11)`       | Ayar kaydının benzersiz kimliği.              |
| `ayar_baslik`       | `varchar(100)`   | Web sayfasının başlığı.                       |
| `ayar_aciklama`     | `varchar(255)`   | Web sayfasının açıklaması.                    |
| `ayar_anahtarkelime`| `varchar(255)`   | Web sayfası için anahtar kelimeler.           |
| `ayar_facebook`     | `varchar(100)`   | Facebook adresi.                              |
| `ayar_x`            | `varchar(100)`   | X (eski Twitter) adresi.                      |
| `ayar_instagram`    | `varchar(100)`   | Instagram adresi.                             |
| `ayar_youtube`      | `varchar(100)`   | YouTube adresi.                               |
| `ayar_msunucu`      | `varchar(50)`    | Mail sunucu adresi.                           |
| `ayar_mport`        | `int(4)`         | Mail sunucu portu.                            |
| `ayar_madres`       | `varchar(100)`   | Mail adresi.                                  |
| `ayar_msifre`       | `varchar(20)`    | Mail adresi şifresi.                          |

### **Açıklamalar**:
- **`ayar_id`**: Tabloyu tanımlayan anahtar alanıdır. Bu sütun benzersizdir ve her kaydın kendine özgü bir kimliği vardır.
- **`ayar_baslik`**: Web sayfasının başlığını içerir. Kullanıcılar bu alana sayfanın başlığını girerler.
- **`ayar_aciklama`**: Web sayfasını tanıtan kısa bir açıklama içerir.
- **`ayar_anahtarkelime`**: Web sayfasının SEO (Arama Motoru Optimizasyonu) için kullanılan anahtar kelimeler.
- **`ayar_facebook`, `ayar_x`, `ayar_instagram`, `ayar_youtube`**: Web sayfasının sosyal medya hesaplarının bağlantıları.
- **`ayar_msunucu`**: Mail servisi için kullanılan SMTP sunucusunun adresi.
- **`ayar_mport`**: Mail sunucusunun port numarasını belirtir.
- **`ayar_madres`**: Kullanıcıların mail adresini içerir.
- **`ayar_msifre`**: Mail adresi için kullanılan şifredir.

### **Tablo Oluşumu ve Veri Ekleme**
Tablo şu SQL komutlarıyla oluşturulmuştur:
```sql
CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_baslik` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_aciklama` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_anahtarkelime` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_facebook` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_x` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_instagram` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_youtube` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_msunucu` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_mport` int(4) NOT NULL,
  `ayar_madres` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_msifre` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`ayar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
```

### **Örnek Veri Ekleme**:
Veritabanına eklenen örnek veriler:
```sql
INSERT INTO `ayar` (`ayar_id`, `ayar_baslik`, `ayar_aciklama`, `ayar_anahtarkelime`, `ayar_facebook`, `ayar_x`, `ayar_instagram`, `ayar_youtube`, `ayar_msunucu`, `ayar_mport`, `ayar_madres`, `ayar_msifre`) VALUES
(1, 'KTUN TBMYO Web Proje Yönetimi', 'Web Proje Yönetimi dersi için kodlanmıştır.', 'KTUN TBMYO, WPY, E-Ticaret, Çanta, Ayakkabı', 'https://www.facebook.com/KTUNEDU/', 'https://twitter.com/ktunedu', 'https://www.instagram.com/ktunedu/', 'https://www.youtube.com/channel/UCnVoJHinCNBfu2UeypZ9frA', 'smtp.gmail.com', 587, 'mail@gmail.com', '123456');
```

Bu, **ayar** tablosunun yapılandırması ve içerdiği veriler hakkında kısa bir açıklamadır. Tablo, web sayfasının yönetim ayarlarını saklamak için gerekli tüm bilgileri içerir ve sosyal medya, mail sunucusu gibi parametreleri yönetmek amacıyla kullanılır.