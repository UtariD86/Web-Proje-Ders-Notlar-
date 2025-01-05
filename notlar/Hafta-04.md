### 1. **`include` ve Dosya Dahil Etme:**
```php
include "ust.php";
```
- **Açıklama**: Bu satırda, PHP `include` komutuyla dış bir PHP dosyasını mevcut dosyaya dahil ediyoruz. `ust.php` dosyası genellikle başlık, menü gibi ortak HTML yapıları içerir. Bu sayede her sayfada bu yapıyı tekrar yazmak zorunda kalmayız.
- **Kavram**: `include` komutu, belirtilen dosyayı çalıştırmak için kullanılır ve hata oluşursa devam etmeye devam eder.

### 2. **Form Elemanları ve `value` Özelliği:**
```php
<input type="text" class="form-control" id="ayar_baslik" name="ayar_baslik" value="<?php echo $ayar['ayar_baslik'] ?>" placeholder="Web sayfanızın başlığını giriniz">
```
- **Açıklama**: Bu satırda bir HTML input elemanı kullanıyoruz. Buradaki `value` özelliği, formda bulunan bu alana, veritabanından çekilen verinin yerleştirilmesini sağlar. `<?php echo $ayar['ayar_baslik'] ?>` PHP kodu, veritabanından gelen başlık verisini alır ve bu alanda görüntüler. Kullanıcı mevcut başlık değerini değiştirebilir.
- **Kavram**: `value` özelliği, form elemanının içeriğini belirler. PHP ile dinamik olarak değer yerleştirilebilir.

### 3. **Veritabanı Bağlantısı:**
```php
include "baglan.php";
```
- **Açıklama**: Bu satırda `baglan.php` dosyasını dahil ediyoruz. Bu dosya, veritabanına bağlanmayı sağlayacak bağlantı bilgilerini içerir (kullanıcı adı, şifre, veritabanı adı vb.). 
- **Kavram**: Veritabanı bağlantısı genellikle `PDO` (PHP Data Objects) veya `mysqli` ile sağlanır.

### 4. **Form Verilerini Alma:**
```php
if (isset($_POST['ayar_baslik'], $_POST['ayar_aciklama'], ...)) {
```
- **Açıklama**: Bu satır, form verilerinin gelip gelmediğini kontrol eder. Eğer kullanıcı formu doldurup göndermişse, PHP `$_POST` süper globali ile veriler alınır.
- **Kavram**: **`$_POST`** süper globali, HTML form verilerini almak için kullanılır. Bu, form verilerinin URL'ye eklenmeden, güvenli bir şekilde gönderilmesini sağlar.

### 5. **PDO ve SQL Sorgusu:**
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
- **Açıklama**: Burada **SQL UPDATE** sorgusu ile veritabanındaki `ayar` tablosunda bulunan veriler güncelleniyor. `:ayar_baslik`, `:ayar_aciklama` gibi parametreler, PDO kullanarak SQL enjeksiyonuna karşı güvenli bir şekilde bağlanmış parametrelerdir.
- **Kavram**: **`PDO` (PHP Data Objects)**, PHP’de veritabanı bağlantısı kurmak ve veri işlemek için kullanılan bir sınıftır. SQL enjeksiyonunu engellemek için parametreli sorgular kullanılır.

### 6. **`execute` ve Veritabanına Veri Gönderme:**
```php
$sorgu = $db->prepare($SQL);
$sonuc = $sorgu->execute($SQL_array);
```
- **Açıklama**: Bu satırlarda PDO kullanılarak hazırlanmış SQL sorgusu (`prepare`), veritabanına gönderiliyor. Sorgu başarılı bir şekilde çalıştırıldığında (`execute`), işlem sonucu `$sonuc` değişkenine kaydedilir.
- **Kavramlar**:
  - **`prepare`**: SQL sorgusunu önceden hazırlayıp, parametreler ile güvenli hale getirir.
  - **`execute`**: Hazırlanan sorguyu çalıştırarak, verileri veritabanına gönderir.

### 7. **`fetch(PDO::FETCH_ASSOC)` Kavramı:**
Veritabanından veri çekmek için kullanılan bir yöntemdir. Örneğin:
```php
$sorgu = $db->query("SELECT * FROM ayar");
$ayar = $sorgu->fetch(PDO::FETCH_ASSOC);
```
- **Açıklama**: Bu satırda **`fetch`** metodu kullanılarak, sorgu sonuçları alınıyor ve **`PDO::FETCH_ASSOC`** ile dönen veri sadece sütun adlarını anahtar olarak içeren bir **associative array** (anahtar-değer dizisi) olarak döndürülür.
- **Kavramlar**:
  - **`fetch`**: Veritabanından gelen sonuçları alır ve her satırı bir dizi olarak döndürür.
  - **`PDO::FETCH_ASSOC`**: Sonuçların sadece anahtar-değer dizisi olarak döndürülmesini sağlar, yani her sütunun adı dizi anahtarı olur.

### 8. **Form Verilerinin Veritabanına Kaydedilmesi:**
```php
$SQL_array = array(
    'ayar_baslik' => $_POST['ayar_baslik'],
    'ayar_aciklama' => $_POST['ayar_aciklama'],
    ...
);
```
- **Açıklama**: Formdan gelen veriler, SQL sorgusunda parametre olarak kullanılmak üzere bir **associative array** şeklinde hazırlanır. Bu array, parametre adları ve form verilerinin eşleşmesini sağlar.
- **Kavram**: **Associative Array** (Anahtar-Değer Dizisi) PHP’de verilerin anahtar ve değer şeklinde saklandığı veri yapısıdır.

### 9. **Yönlendirme (header):**
```php
header("Location:ayar.php?sonuc=" . $sonuc);
```
- **Açıklama**: İşlem tamamlandığında, kullanıcıyı başka bir sayfaya yönlendiren `header()` fonksiyonu kullanılır. Burada, işlem sonucunu `sonuc` parametresiyle URL’ye ekliyoruz.
- **Kavram**: **`header()`** fonksiyonu, sayfa yönlendirmeleri ve HTTP başlıkları için kullanılır. Yönlendirme yapılırken önceki çıktı (HTML vs.) yapılmamalıdır.

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