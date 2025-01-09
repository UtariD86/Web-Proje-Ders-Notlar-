
| **Komut**                     | **Açılımı**                        | **Amacı**                                                                                      | **Popüler Parametreler ve Açıklamaları**                 |
|-------------------------------|-------------------------------------|------------------------------------------------------------------------------------------------|----------------------------------------------------------|
| `dpkg -i paket.deb`           | Debian Package Manager             | Paket dosyalarını yükler.                                                                      | `-i`: Belirtilen paketi kurar.                          |
| `dpkg -V [paket-adları]`      | Debian Package Verify              | Kurulu paketlerin toplam kontrolünü yapar.                                                    | Yok                                                      |
| `dpkg-divert`                 | Debian Package Divert              | Dosyanın paket sürümünü değiştirir.                                                           | `--add`: Yeni bir yönlendirme ekler.<br>`--remove`: Yönlendirmeyi kaldırır.<br>`--rename`: Dosyayı yeniden adlandırır. |
| `dpkg --compare-versions`     | Debian Package Compare Versions    | Sürüm numaralarını karşılaştırır.                                                             | Yok                                                      |
| `dpkg-query`                  | Debian Package Query               | Kurulu paketleri sorgular.                                                                    | `-W`: Paketlerin listesini gösterir.<br>`--showformat`: Özel bir format belirler.            |
| `apt install paket-adı`       | Advanced Packaging Tool Install    | Paketleri tüm bağımlılıklarıyla kurar.                                                        | `-y`: Tüm soruları "evet" olarak yanıtlar.<br>`--reinstall`: Paketi yeniden kurar.           |
| `apt update`                  | Advanced Packaging Tool Update     | Paket listelerini günceller.                                                                  | Yok                                                      |
| `apt upgrade`                 | Advanced Packaging Tool Upgrade    | Yüklü paketlerin güncellemelerini yapar.                                                      | `-y`: Tüm soruları "evet" olarak yanıtlar.<br>`--with-new-pkgs`: Yeni paketleri de ekler.    |
| `apt remove paket-adı`        | Advanced Packaging Tool Remove     | Paketleri kaldırır.                                                                            | `-y`: Tüm soruları "evet" olarak yanıtlar.<br>`--purge`: Yapılandırma dosyalarını da siler.  |
| `systemctl restart`           | System Control Restart             | Belirtilen servisi yeniden başlatır.                                                          | Yok                                                      |
| `systemctl stop`              | System Control Stop                | Belirtilen servisi durdurur.                                                                  | Yok                                                      |
| `systemctl start`             | System Control Start               | Belirtilen servisi başlatır.                                                                  | Yok                                                      |
| `cat dosya`                   | Concatenate                        | Dosya içeriğini ekrana yazdırır.                                                              | Yok                                                      |
| `cd dizin`                    | Change Directory                   | Dizinler arasında geçiş yapar.                                                                | Yok                                                      |
| `cp dosya hedef`              | Copy                               | Dosyaları ve dizinleri kopyalar.                                                              | `-r`: Dizinleri ve alt dosyalarını kopyalar.<br>`-p`: İzinleri ve zaman damgasını korur.<br>`-i`: Üzerine yazma öncesi onay ister. |
| `rm dosya`                    | Remove                             | Dosyaları veya dizinleri siler.                                                               | `-r`: Dizinleri ve alt dosyalarını siler.<br>`-f`: Onaysız siler.<br>`-i`: Silme öncesi onay ister. |
| `ls [dosya]`                  | List Directory                     | Dizin içeriğini listeler.                                                                     | `-l`: Ayrıntılı listeleme.<br>`-a`: Gizli dosyaları da gösterir.<br>`-h`: İnsan okunabilir boyut. |
| `mkdir dizin-adı`             | Make Directory                     | Yeni bir dizin oluşturur.                                                                     | `-p`: Alt dizinlerle birlikte oluşturur.<br>`-v`: Detaylı çıktı verir.                       |
| `find dizin ifadeleri`        | Find                               | Belirtilen kriterlere uyan dosya ve dizinleri bulur.                                          | `-name`: İsimle arama yapar.<br>`-size`: Boyutla arama yapar.<br>`-type`: Türle arama yapar. |
| `grep aranan-dizgi dosya`     | Global Regular Expression Print    | Dosyalar içinde belirtilen deseni arar.                                                       | `-i`: Büyük/küçük harf duyarlılığını kapatır.<br>`-r`: Alt dizinlerde arama yapar.<br>`-n`: Satır numarasını gösterir. |