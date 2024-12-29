
### ** `alt.php` **
Bu dosyadaki JavaScript kodu, DataTable kullanımıyla ilgili bir yapı ekliyor. `DataTable`, HTML tablolarını dinamik hale getiren bir jQuery eklentisidir. Bu eklenti, tabloyu filtreleme, sıralama ve veri ekleme gibi özelliklerle daha etkileşimli hale getirir.

#### JavaScript Kodu:
```javascript
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  })
</script>
```
- **`$(function() {...})`**: Bu, sayfa yüklendiğinde çalışacak olan bir jQuery fonksiyonudur. Kısacası, DOM (belge nesne modeli) hazır olduğunda içindeki kodlar çalıştırılır.
- **`$("#example1").DataTable({...})`**: Bu, sayfa üzerinde `id="example1"` olan tabloyu DataTable'a dönüştürür. Tabloya özellikler ekler. 
  - **`responsive: true`**: Tabloyu mobil uyumlu hale getirir.
  - **`lengthChange: false`**: Sayfa başına gösterilen satır sayısının değiştirilmesini engeller.
  - **`autoWidth: false`**: Otomatik genişlik ayarını devre dışı bırakır.
  - **`buttons: [...]`**: Bu, DataTable'a çeşitli dışa aktarım ve baskı butonları ekler. Örneğin, **copy** (kopyalama), **csv**, **excel**, **pdf**, **print** ve **colvis** (kolon görünürlük) butonları.
- **`.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')`**: Bu, butonları tablo dışındaki bir alana ekler, burada `#example1_wrapper .col-md-6:eq(0)` belirli bir HTML elementini işaret eder.

### ** `urun_detay.php` **
Bu dosya, bir ürünün detaylarını görüntülemek için kullanılır. Veritabanından bir ürün bilgisi çekilir ve bir form aracılığıyla kullanıcıya sunulur.

#### PHP Kodu:
```php
<?php
  include "ust.php";
  if (!isset($_GET['id']))
    $_GET['id'] = 0;
  $sorgu = $db->prepare('SELECT * FROM urun WHERE urun_id=?');
  $sorgu->execute(array($_GET['id']));
  $satir = $sorgu->fetch(PDO::FETCH_ASSOC);
?>
```
- **`$_GET['id']`**: URL'den gelen `id` parametresini alır. Eğer `id` parametresi yoksa (örneğin, URL'de `urun_detay.php?id=1` gibi bir değer yoksa), 0 olarak ayarlanır. Bu, ürün detay sayfasının hangi ürün için yükleneceğini belirler.
- **`$db->prepare('SELECT * FROM urun WHERE urun_id=?')`**: `urun` tablosundan, `urun_id` değeri ile belirtilen ürünü sorgular.
- **`$sorgu->execute(array($_GET['id']))`**: SQL sorgusunu çalıştırır ve ürün bilgilerini `$_GET['id']` parametresine göre alır.
- **`$sorgu->fetch(PDO::FETCH_ASSOC)`**: Veritabanından dönen sonuçları bir dizi olarak alır ve `urun` tablosundaki bir satırdaki tüm bilgileri (`urun_adi`, `urun_fiyat`, vb.) `$satir` değişkenine atar.

Form içeriği:
- **`<form action="ayar_kaydet.php" method="POST">`**: Bu form, ürün ayarlarını kaydetmek için kullanılır. Kullanıcı, formda belirtilen alanları doldurup gönderdiğinde `ayar_kaydet.php` dosyasına gönderilir.
- **`<input type="text" class="form-control" id="ayar_baslik" name="ayar_baslik" value="<?php echo $ayar['ayar_baslik'] ?>" placeholder="Web sayfanızın başlığını giriniz">`**: Bu, formda bir metin kutusudur. Kullanıcıdan "Başlık" bilgisini alır ve bu alanın varsayılan değeri, daha önce ayarlanmış ayar bilgileriyle gelir (`$ayar['ayar_baslik']`).

### ** `urun_liste.php` **
Bu dosya, tüm ürünlerin listelendiği sayfadır. Ürün bilgileri veritabanından çekilir ve bir tablo içinde gösterilir.

#### PHP ve HTML Kodu:
```php
<?php
  include "ust.php";
?>
<div class="content-wrapper">
  <div class="content pt-2">
    <div class="container-fluid">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <h5 class="m-0"><i class="fas fa-list mr-2"></i>Ürün Listesi</h5>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-striped">
            <thead>
              <tr>
                <th>Kategori</th>
                <th>Barkod</th>
                <th>Ürün Adı</th>
                <th>Fiyat</th>
                <th>Marka</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $sorgu = $db->prepare('SELECT * FROM urun');
                $sorgu->execute();
                while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) {
              ?>
              <tr>
                <td><?php echo $satir['urun_kategori_id'] ?></td>
                <td><?php echo $satir['urun_barkod'] ?></td>
                <td>
                  <a href="urun_detay.php?id=<?php echo $satir['urun_id'] ?>">
                    <?php echo $satir['urun_adi'] ?>
                  </a>
                </td>
                <td><?php echo $satir['urun_fiyat'] ?></td>
                <td><?php echo $satir['urun_marka'] ?></td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
</div>
<?php
  include "alt.php";
?>
```
- Bu sayfa, veritabanındaki **`urun`** tablosundaki tüm ürünleri listeleyen bir tablonun içinde gösterir.
- **`$sorgu->execute()`**: Tüm ürünleri veritabanından çeker.
- **`while ($satir = $sorgu->fetch(PDO::FETCH_ASSOC))`**: Ürünleri satır satır döngü ile alır ve tabloya ekler.
- **`<a href="urun_detay.php?id=<?php echo $satir['urun_id'] ?>">`**: Her ürün adı tıklandığında, ilgili ürünün detay sayfasına yönlendirir.

### ** `ust.php` **
Bu dosya, sayfa başlığına ve menüye dair ayarları içeriyor. Burada önemli olan, **`MenuClass`** fonksiyonunun çalışması:

#### PHP Fonksiyonu:
```php
function MenuClass($sayfa, $class = 'active') {
  if (strpos($_SERVER['SCRIPT_NAME'], $sayfa))
    echo $class;
}
```
- **`MenuClass`** fonksiyonu, geçerli sayfanın adıyla (`$_SERVER['SCRIPT_NAME']`) karşılaştırma yapar. Eğer sayfa adı belirli bir kelimeyi içeriyorsa (örneğin `urun_`), o menü öğesine `active` sınıfını ekler. Bu, hangi menü öğesinin aktif olduğunu görsel olarak belirtmek için kullanılır.

----------------------------------------------------------------------------------------------------------------------------------------------------------------

## Veritabanı Yapısı
**Veritabanı Adı**: `io`

Veritabanı, iki ana tablo içeriyor: `ayar` ve `urun`. Her bir tablonun amacı ve yapısı aşağıda açıklanmıştır.

---

### 1. `ayar` Tablosu

**Amaç**: Web sitesi için çeşitli ayar bilgilerini saklamak.

| **Sütun Adı**         | **Veri Tipi**          | **Açıklama**                                                                |
|-----------------------|------------------------|-----------------------------------------------------------------------------|
| `ayar_id`             | `int(11)`              | Bu sütun, her ayar kaydının benzersiz kimliğini tutar. (Birincil anahtar)    |
| `ayar_baslik`         | `varchar(100)`          | Web sayfasının başlığını tutar.                                              |
| `ayar_aciklama`       | `varchar(255)`          | Web sayfası açıklamasını tutar.                                              |
| `ayar_anahtarkelime`  | `varchar(255)`          | Web sayfasının anahtar kelimelerini tutar.                                   |
| `ayar_facebook`       | `varchar(100)`          | Facebook sayfasının URL adresini tutar.                                      |
| `ayar_x`              | `varchar(100)`          | X sosyal medya platformunun URL adresini tutar.                              |
| `ayar_instagram`      | `varchar(100)`          | Instagram hesabının URL adresini tutar.                                      |
| `ayar_youtube`        | `varchar(100)`          | YouTube kanalının URL adresini tutar.                                        |
| `ayar_msunucu`        | `varchar(50)`           | E-posta hizmetinin sağlandığı sunucunun adresini tutar.                       |
| `ayar_mport`          | `int(4)`                | E-posta sunucusunun port numarasını tutar.                                    |
| `ayar_madres`         | `varchar(100)`          | E-posta adresini tutar.                                                      |
| `ayar_msifre`         | `varchar(20)`           | E-posta hesabının şifresini tutar.                                           |

**Tablo Tipi**: InnoDB (Daha güvenli ve performanslı işlemler için tercih edilir)  
**Karakter Seti**: UTF-8 (Türkçe karakterleri de destekler)

---

### 2. `urun` Tablosu

**Amaç**: Ürünlerin detaylı bilgilerini saklamak.

| **Sütun Adı**         | **Veri Tipi**          | **Açıklama**                                                                |
|-----------------------|------------------------|-----------------------------------------------------------------------------|
| `urun_id`             | `int(11)`              | Bu sütun, her ürünün benzersiz kimliğini tutar. (Birincil anahtar)           |
| `urun_kategori_id`    | `int(11)`              | Ürünün ait olduğu kategori kimliğini tutar.                                  |
| `urun_barkod`         | `varchar(15)`          | Ürünün barkod numarasını tutar.                                              |
| `urun_adi`            | `varchar(150)`         | Ürünün adını tutar.                                                         |
| `urun_aciklama`       | `text`                 | Ürünün açıklamasını tutar.                                                  |
| `urun_fiyat`          | `decimal(8,2)`         | Ürünün fiyatını tutar (en fazla 8 haneli, 2 ondalıklı).                      |
| `urun_indirim`        | `tinyint(4)`           | Ürünün indirim oranını tutar (0: indirim yok, 1: indirim var vb.).          |
| `urun_marka`          | `varchar(15)`          | Ürünün markasını tutar.                                                     |
| `urun_gorulmesayisi`  | `int(11)`              | Ürünün kaç kez görüntülendiğini tutar.                                       |
| `urun_eklemetarihi`   | `timestamp`            | Ürünün eklenme tarih ve saatini tutar. (Otomatik olarak güncellenir)         |

**Tablo Tipi**: InnoDB  
**Karakter Seti**: UTF-8

---

### Veri Tipleri
- **`int(11)`**: Tam sayıları tutan, genellikle sayısal kimlikler için kullanılır.
- **`varchar(n)`**: Karakter dizilerini tutan, uzunluğu `n` kadar olan bir veri tipi. Metin verileri için uygundur.
- **`text`**: Daha uzun metinleri tutan bir veri tipi. Genellikle açıklamalar veya uzun yazılar için kullanılır.
- **`decimal(p,s)`**: Sayısal veriler için, `p` toplam basamak sayısını ve `s` ondalıklı basamağı belirtir. Örneğin, `decimal(8,2)` fiyat gibi veriler için uygundur (8 basamaktan 2'si ondalıklı).
- **`timestamp`**: Zaman damgası, tarih ve saat bilgisini tutar ve genellikle otomatik olarak veritabanı tarafından güncellenir.

---

### İlişkiler ve Kullanım
- **`ayar` Tablosu**: Web sitesinin genel ayarlarını saklar (başlık, açıklama, sosyal medya bağlantıları, e-posta ayarları vb.).
- **`urun` Tablosu**: E-ticaret uygulamaları için ürünlerin bilgilerini (isim, fiyat, açıklama, stok durumu vb.) tutar.

Veritabanı yapısı, kullanıcıların dinamik olarak ürünleri yönetmesine olanak tanır. Örneğin, ürünler `urun` tablosuna eklenebilir, güncellenebilir veya silinebilir. Benzer şekilde, site ayarları `ayar` tablosunda düzenlenebilir.

