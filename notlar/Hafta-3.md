baglan.php
Bu dosya, projedeki veritabanı bağlantısını kurmak için kullanılır. Projenin merkezi bir parçasıdır ve diğer dosyaların veritabanıyla etkileşim kurmasını sağlar.


```php

<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=io;charset=utf8", "root", "root");
} catch ( PDOException $e ){
     print $e->getMessage();
     exit;
}
?>

```

PDO Sınıfı: PHP'de veritabanı bağlantıları için kullanılan bir sınıftır. PDO ile hem güvenli hem de esnek bir şekilde veritabanı işlemleri yapılabilir.

mysql:host ve dbname: Bağlanılacak veritabanının sunucu adresini (localhost) ve ismini (io) belirtir.

Kullanıcı Bilgileri: "root", "root" bağlantı için kullanılan kullanıcı adı ve şifreyi temsil eder.

Hata Yönetimi:

try-catch bloğu ile bağlantı sırasında oluşabilecek hatalar yakalanır.

Bir hata oluşursa, hata mesajı PDOException sınıfından alınır ve ekrana yazdırılır.


Bu dosya genellikle diğer dosyalara dahil edilerek veritabanı bağlantısını hazır hale getirir.

---------------------------------------------------------------------------------------------------------------------------

ust.php
Bu dosya, sayfanın başlık ve üst yapısını oluşturur. Ayrıca, projedeki genel ayarların (örneğin, başlık bilgileri) veritabanından alınmasını sağlar.

Yeni Eklenen Kısımlar:

```php

<?php
include "baglan.php"; // Veritabanı bağlantısını dahil ediyor.
$ayar = $db->prepare("SELECT * FROM ayar"); // Veritabanından "ayar" tablosundaki tüm verileri seçiyor.
$ayar->execute(); // Sorguyu çalıştırıyor.
$ayar = $ayar->fetch(PDO::FETCH_ASSOC); // Sonuçları bir dizi olarak alıyor.
?>

```

include "baglan.php";
baglan.php dosyasını dahil ederek, bu dosyanın içerdiği veritabanı bağlantısını kullanır.

$db->prepare("SELECT * FROM ayar");
Veritabanındaki ayar tablosundaki tüm satırları seçer. Bu tablo genellikle site ayarlarını (örneğin başlık, açıklama, logo URL'si) içerir.

$ayar = $ayar->fetch(PDO::FETCH_ASSOC);
Çekilen verileri bir dizi olarak alır. Örneğin:

```php

$ayar['ayar_baslik']; // Tablo sütunundan 'ayar_baslik' değerini alır.

```

Dinamik Başlık:

 ```php

<title>Yönetim Paneli | <?php echo $ayar['ayar_baslik']; ?></title>

```
HTML başlığında, PHP kullanılarak veritabanından çekilen ayar_baslik değeri dinamik olarak gösteriliyor:

------------------------------------------------------------------------------------------------------------------------------------------------

Aşağıda, verilen SQL dump'ını ve içerdiği veritabanı yapısını detaylı bir şekilde açıklıyorum. Veritabanı, tablolar ve veri tipleri hakkında temel bilgilerle birlikte bir tablo formatında sunulmuştur.

### Veritabanı Yapısı: `io`

- **Veritabanı Adı:** `io`  
- **Karakter Seti:** `utf8mb4`  
- **Kolleksiyon:** `utf8_turkish_ci` (Türkçe karakterlere uygun bir karakter seti)

### Tablo: `ayar`

Bu tablo, genellikle web sitesinin yönetim ayarlarını saklamak için kullanılır. Ayarlar, web sitesinin başlığı, açıklamaları, sosyal medya linkleri ve mail sunucusu bilgileri gibi temel yapılandırma bilgilerini içerir.

#### Tablo Yapısı:

| Kolon Adı         | Veri Tipi               | Açıklama                                 |
|-------------------|-------------------------|------------------------------------------|
| `ayar_id`         | `int(11)`               | Birincil anahtar, her bir ayar kaydını benzersiz şekilde tanımlar. |
| `ayar_baslik`     | `varchar(100)`          | Web sitesinin başlığı.                  |
| `ayar_aciklama`   | `varchar(255)`          | Web sitesinin kısa açıklaması.          |
| `ayar_anahtarkelime` | `varchar(255)`        | Web sitesinin anahtar kelimeleri.       |
| `ayar_facebook`   | `varchar(100)`          | Facebook sayfası URL'si.                |
| `ayar_x`          | `varchar(100)`          | Diğer sosyal medya veya site bağlantıları için kullanılabilir. |
| `ayar_instagram`  | `varchar(100)`          | Instagram sayfası URL'si.               |
| `ayar_youtube`    | `varchar(100)`          | YouTube kanalının URL'si.               |
| `ayar_msunucu`    | `varchar(50)`           | Mail sunucusunun adresi (örneğin: `smtp.gmail.com`). |
| `ayar_mport`      | `int(4)`                | Mail sunucusunun port numarası.         |
| `ayar_madres`     | `varchar(100)`          | Mail sunucusunun e-posta adresi.        |
| `ayar_msifre`     | `varchar(20)`           | Mail sunucusunun e-posta şifresi.       |

#### Veri Tipleri:
- **`int(11)`**: Sayısal değerler için kullanılır. Burada `ayar_id` birincil anahtar olduğu için her kaydın benzersiz bir kimliği vardır.
- **`varchar(n)`**: Karakter dizilerini saklamak için kullanılır. `n`, saklanacak karakter sayısını belirler. Örneğin, `varchar(100)` 100 karaktere kadar veri saklayabilir.
- **`utf8_turkish_ci`**: Bu, Türkçe karakterleri doğru bir şekilde işleyebilmek için kullanılan bir karakter setidir.
  
#### Tabloya Eklenen Veri (Örnek):
| ayar_id | ayar_baslik                    | ayar_aciklama                                    | ayar_anahtarkelime                          | ayar_facebook                               | ayar_x                                   | ayar_instagram                            | ayar_youtube                                    | ayar_msunucu     | ayar_mport | ayar_madres         | ayar_msifre |
|---------|---------------------------------|-------------------------------------------------|---------------------------------------------|--------------------------------------------|------------------------------------------|--------------------------------------------|------------------------------------------------|-------------------|------------|---------------------|-------------|
| 1       | KTUN TBMYO Web Proje Yönetimi   | Web Proje Yönetimi dersi için kodlanmıştır.      | KTUN TBMYO, WPY, E-Ticaret, Çanta, Ayakkabı | https://www.facebook.com/KTUNEDU/           | https://twitter.com/ktunedu               | https://www.instagram.com/ktunedu/          | https://www.youtube.com/channel/UCnVoJHinCNBfu2UeypZ9frA | smtp.gmail.com    | 587        | mail@gmail.com      | 123456      |

### İndeks:
Tabloda **`ayar_id`** kolonu birincil anahtar (primary key) olarak belirlenmiş. Bu, her bir ayar kaydının benzersiz olmasını ve hızlıca erişilmesini sağlar.  

### Özet:
Bu veritabanı, temel yönetim ayarlarını depolayan ve bunlara hızlı bir şekilde erişilebilen bir yapıya sahiptir. Veritabanındaki `ayar` tablosu, çeşitli site ayarlarını, sosyal medya bağlantılarını ve mail sunucusu bilgilerini içeren sütunlara sahiptir. Bu yapı, web sayfasının başlıkları, açıklamaları ve çeşitli dış bağlantılar gibi temel öğelerin dinamik olarak yönetilmesini sağlar.

Bu veritabanı yapısını kullanarak, site yöneticileri veritabanındaki bilgileri güncelleyebilir ve bu bilgiler, site genelinde anında yansıyacaktır.