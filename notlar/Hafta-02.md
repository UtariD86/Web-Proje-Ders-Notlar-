### PHP Nedir?
PHP (Hypertext Preprocessor), özellikle web geliştirme için kullanılan, sunucu tarafında çalışan açık kaynaklı bir betik dilidir. Dinamik web siteleri ve uygulamalar oluşturmak için idealdir.

- **Sunucu Taraflı**: PHP kodu, tarayıcıda değil sunucuda çalışır ve sonucunda tarayıcıya HTML olarak iletilir.
- **Dosya Uzantısı**: PHP dosyaları genelde `.php` uzantısıyla kaydedilir.
- **Karma**: PHP, HTML ile bir arada kullanılabilir ve içine CSS, JavaScript gibi diğer teknolojiler entegre edilebilir.

---

### Temel PHP Yapısı

PHP kodları `<?php ... ?>` etiketleri arasında yazılır. Örnek:

```php
<?php
  echo "Merhaba Dünya!";
?>
```

- **echo**: Ekrana çıktı verir.
- `;`: Her PHP komutu `;` ile sonlanmalıdır.

---

### Dosya Düzeni: **`include` ve Kod Parçalama**

PHP projelerinde, kodun yeniden kullanılabilirliği ve düzenlenebilirliği için dosyalar genellikle bileşenlere ayrılır. Bu, **`include`** veya **`require`** fonksiyonlarıyla yapılır.

#### Örnek Açıklama:
1. **`ust.php`**: Sayfanın üst kısmını (örneğin bir navigasyon menüsü veya başlık) içerir.
2. **`alt.php`**: Sayfanın alt kısmını (örneğin bir footer) içerir.
3. **`index.php`**: Sayfanın ana içeriğini oluşturur ve diğer dosyaları birleştirir.

#### Kod:
```php
<?php
  include "ust.php"; // ust.php içeriğini buraya ekler
?>

<!-- HTML içerik -->
<h1>Hoş Geldiniz!</h1>
<p>Bu, ana içerik kısmıdır.</p>

<?php
  include "alt.php"; // alt.php içeriğini buraya ekler
?>
```

#### `include` Fonksiyonunun Avantajları:
- **Modüler Yapı**: Kod parçalarını farklı dosyalarda tutarak düzeni artırır.
- **Kolay Bakım**: Örneğin, footer'da bir değişiklik gerektiğinde sadece `alt.php` dosyasını düzenlemeniz yeterlidir.
- **Yeniden Kullanım**: Aynı bileşenleri farklı sayfalarda tekrar tekrar kullanabilirsiniz.

#### `include` ve `require` Arasındaki Fark:
- **`include`**: Dosya bulunmazsa bir uyarı verir ve çalışmaya devam eder.
- **`require`**: Dosya bulunmazsa bir hata verir ve çalışmayı durdurur.

---

### Temel Kavramlar

1. **HTML ve PHP Entegrasyonu**: PHP, HTML içinde kullanılabilir:
   ```php
   <html>
     <body>
       <h1><?php echo "PHP ile Dinamik Başlık"; ?></h1>
     </body>
   </html>
   ```

2. **Değişkenler**:
   - PHP'de değişkenler `$` işareti ile tanımlanır.
   ```php
   <?php
     $isim = "Ahmet";
     echo "Merhaba, $isim!";
   ?>
   ```

3. **Yorum Satırları**:
   - Tek satırlık: `// Yorum`
   - Çok satırlık: `/* Yorum */`

---

### Ekstra Bilgiler
- **PHP Dosyasını Çalıştırmak**: PHP dosyaları, bir **web sunucusunda** (ör. Apache, Nginx) çalıştırılır. Kendi bilgisayarınızda çalıştırmak için **XAMPP** gibi bir araç kullanabilirsiniz.
- **HTML ile Çalışma**: PHP, HTML ile iç içe kullanıldığında dinamik içerik oluşturmayı kolaylaştırır.
