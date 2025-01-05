### **Veritabanı Bağlantısı ve PDO Kullanımı**

#### **PDO Nedir?**
PDO (PHP Data Objects), PHP'de veritabanı bağlantıları ve işlemleri için kullanılan bir sınıftır. 
- **Esneklik**: MySQL, PostgreSQL, SQLite gibi birçok veritabanı türünü destekler.
- **Güvenlik**: Hazır sorgular (prepared statements) ile SQL enjeksiyonlarına karşı koruma sağlar.
- **Taşınabilirlik**: Kod değişikliği yapmadan farklı veritabanlarına geçişi kolaylaştırır.

---

### **`baglan.php`: Veritabanı Bağlantısı**

#### Kod:
```php
<?php
try {
     $db = new PDO("mysql:host=localhost;dbname=io;charset=utf8", "root", "root");
} catch (PDOException $e) {
     print $e->getMessage();
     exit;
}
?>
```

#### Anlamı:
1. **`try-catch` Bloğu**: Hata yönetimi için kullanılır.
   - Eğer bağlantı başarısız olursa, **`PDOException`** sınıfından alınan hata mesajı ekrana yazdırılır.
   - **`exit`**: Kodun devam etmesini engeller.
   
2. **PDO Oluşturma**:
   ```php
   $db = new PDO("mysql:host=localhost;dbname=io;charset=utf8", "root", "root");
   ```
   - **`mysql:host=localhost`**: Veritabanı sunucusunun adresi.
   - **`dbname=io`**: Bağlanılacak veritabanının adı.
   - **`charset=utf8`**: Türkçe karakterlerin doğru işlenmesi için karakter seti.
   - **`root`, `root`**: Kullanıcı adı ve şifre.

---

### **PDO ile Veritabanı İşlemleri**

1. **Veri Seçme (`SELECT`)**:
   ```php
   $ayar = $db->prepare("SELECT * FROM ayar");
   $ayar->execute();
   $ayar = $ayar->fetch(PDO::FETCH_ASSOC);
   ```

   - **`prepare()`**: Veritabanı sorgusunu hazırlar.
   - **`execute()`**: Hazırlanan sorguyu çalıştırır.
   - **`fetch(PDO::FETCH_ASSOC)`**: Sonuçları **associative array** (anahtar-değer çifti) olarak döner.

   **Kullanım Örneği**:
   ```php
   echo $ayar['ayar_baslik']; // 'ayar_baslik' sütunundaki değeri alır.
   ```

2. **`PDO::FETCH_ASSOC` Nedir?**
   - Veritabanından dönen satırları, sütun adlarına göre bir dizi olarak alır.
   - Örnek:
     ```php
     Array (
         [ayar_baslik] => KTUN TBMYO Web Proje Yönetimi
         [ayar_aciklama] => Web Proje Yönetimi dersi için kodlanmıştır.
     )
     ```

3. **Prepared Statements Kullanımı (Hazır Sorgular)**:
   Güvenlik için değişkenleri doğrudan sorguya eklemek yerine bağlamak daha iyidir:
   ```php
   $query = $db->prepare("SELECT * FROM ayar WHERE ayar_id = :id");
   $query->execute(['id' => 1]);
   $result = $query->fetch(PDO::FETCH_ASSOC);
   ```

   - **`:id`**: Yer tutucu.
   - **`execute()`**: Yer tutucuların değerleriyle sorguyu çalıştırır.

---

### **`ust.php`: Veritabanı ile Dinamik İçerik**

#### Kod:
```php
<?php
include "baglan.php";
$ayar = $db->prepare("SELECT * FROM ayar");
$ayar->execute();
$ayar = $ayar->fetch(PDO::FETCH_ASSOC);
?>

<title><?php echo $ayar['ayar_baslik']; ?></title>
```

#### Anlamı:
- Veritabanındaki **ayar** tablosundan alınan veriler dinamik olarak sayfaya aktarılır.
- HTML başlığına:
  ```html
  <title>Yönetim Paneli | KTUN TBMYO Web Proje Yönetimi</title>
  ```

---

### **Veritabanı Yapısı: `io`**

1. **Tablo: `ayar`**
   - Web sitesinin başlık, açıklama, sosyal medya bağlantıları gibi ayarlarını içerir.
   - Örnek Veri:
     | ayar_id | ayar_baslik       | ayar_aciklama       |
     |---------|-------------------|---------------------|
     | 1       | Yönetim Paneli    | Site yönetim ayarları.|

2. **Veri Türleri**:
   - **`int(11)`**: Tam sayılar için.
   - **`varchar(n)`**: Karakter dizileri için.

---

### **Özet**

- **PDO ile Veritabanı Bağlantısı**: Güvenli ve esnek.
- **`fetch(PDO::FETCH_ASSOC)`**: Sorgu sonuçlarını sütun isimlerine göre alır.
- **Dinamik İçerik**: Veritabanından alınan veriler, web sayfasında kullanılabilir.
