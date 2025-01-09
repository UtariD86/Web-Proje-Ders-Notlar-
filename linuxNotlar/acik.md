
| **Komut**             | **Açılımı**               | **Amacı**                                                                 | **Popüler Parametreler ve Açıklamaları**                                 |
|-----------------------|---------------------------|---------------------------------------------------------------------------|---------------------------------------------------------------------------|
| `adduser`             | Add User                 | Yeni bir kullanıcı eklemek için kullanılır.                               | Yok                                                                      |
| `userdel`             | User Delete              | Bir kullanıcıyı sistemden silmek için kullanılır.                         | `-r`: Kullanıcının ana dizinini de siler.                                |
| `groupadd`            | Group Add                | Yeni bir grup oluşturur.                                                  | Yok                                                                      |
| `usermod`             | User Modify              | Kullanıcı özelliklerini düzenler veya kullanıcıyı bir gruba ekler.         | `-aG`: Belirtilen gruba ekler.<br>`-L`: Kullanıcıyı kilitler.            |
| `chown`               | Change Ownership         | Dosya veya dizin sahipliğini değiştirir.                                  | `-R`: Alt dizinleriyle birlikte uygular.<br>`owner:group`: Sahip ve grup. |
| `chmod`               | Change Mode              | Dosya veya dizin izinlerini değiştirir.                                   | `u+x`: Kullanıcıya çalıştırma izni verir.<br>`-R`: Alt dizinlere uygular. |
| `fdisk`               | Format Disk              | Disk bölümlerini yönetmek ve biçimlendirmek için kullanılır.              | `-l`: Disk bölümlerini listeler.                                         |
| `mount`               | Mount                   | Bir aygıtı belirli bir dizine bağlar.                                     | `-t`: Dosya sistemi türünü belirtir.<br>`-o`: Seçenekler belirtir.       |
| `unmount`             | Unmount                 | Bağlı bir aygıtı çıkarır.                                                | Yok                                                                      |
| `ifconfig`            | Interface Config         | Ağ arayüzü yapılandırması ve durumu görüntülemek için kullanılır.         | `-a`: Tüm arayüzleri gösterir.<br>`down/up`: Arayüzü devre dışı bırakır/aktif eder. |
| `route`               | Route                   | Ağ yönlendirme tablolarını yönetmek için kullanılır.                      | `-n`: Sayısal formatta gösterir.<br>`add/del`: Yönlendirme ekler veya siler. |
| `netstat`             | Network Statistics       | Ağ bağlantılarını ve yapılan istekleri gösterir.                          | `-tuln`: Dinleyen bağlantıları listeler.                                 |
| `arp`                 | Address Resolution Protocol | Ağdaki cihazların IP ve MAC adreslerini ilişkilendirmek için kullanılır.   | `-a`: Tüm ARP girişlerini gösterir.                                     |
| `ping`                | Packet Internet Groper   | Ağ bağlantısını test etmek için kullanılır.                               | `-c`: Gönderilecek paket sayısını belirtir.<br>`-i`: Zaman aralığını belirtir. |
| `traceroute`          | Trace Route             | Bir paketin hedefe ulaşana kadar geçtiği yolları gösterir.                | `-n`: IP adreslerini sayısal formatta gösterir.                          |
| `fsck`                | File System Check        | Dosya sistemini kontrol etmek ve hataları onarmak için kullanılır.        | `-y`: Tüm sorulara otomatik evet der.                                    |
| `df`                  | Disk Free               | Disk kullanımını görüntüler.                                              | `-h`: İnsan okunabilir boyutlarda gösterir.<br>`-T`: Dosya sistemi türünü gösterir. |
| `du`                  | Disk Usage              | Belirli bir dizin veya dosyanın disk kullanımını analiz eder.             | `-h`: İnsan okunabilir boyutlarda gösterir.<br>`-d`: Derinlik belirtir.  |
| `quota`               | Quota                   | Kullanıcının disk kotasını görüntüler.                                    | Yok                                                                      |
| `edquota`             | Edit Quota              | Disk kotasını düzenlemek için kullanılır.                                 | Yok                                                                      |
| `crontab -e`          | Cron Table Edit         | Zamanlanmış görevleri düzenlemek için kullanılır.                         | Yok                                                                      |
| `at`                  | At                      | Tek seferlik zamanlanmış görev oluşturur.                                 | Yok                                                                      |
| `uname -r`            | Unix Name               | Çekirdek sürümünü görüntüler.                                             | Yok                                                                      |
| `modprobe`            | Module Probe            | Bir çekirdek modülünü yükler.                                             | Yok                                                                      |
| `lsmod`               | List Modules            | Yüklenmiş çekirdek modüllerini listeler.                                  | Yok                                                                      |
| `tar`                 | Tape Archive            | Dosyaları sıkıştırmak veya arşivlemek için kullanılır.                    | `-czf`: Sıkıştır ve arşivle.<br>`-xzf`: Arşivi çıkar.                    |
| `ls`                  | List                   | Dosyaları ve dizinleri listeler.                                          | `-l`: Ayrıntılı listeleme.<br>`-a`: Gizli dosyaları gösterir.             |
| `ls -a`               | List All                | Gizli dosyalar dahil listeleme yapar.                                     | Yok                                                                      |
| `cp`                  | Copy                   | Dosya veya dizinleri kopyalar.                                            | `-r`: Alt dizinlerle birlikte kopyalar.                                  |
| `mv`                  | Move                   | Dosya veya dizinleri taşır veya yeniden adlandırır.                       | Yok                                                                      |
| `wget`                | Web Get                | İnternet üzerinden dosya indirir.                                         | `-c`: İndirmeyi kaldığı yerden devam ettirir.<br>`-q`: Sessiz modda çalışır. |
| `sudo`                | Superuser Do            | Komutları yönetici yetkisiyle çalıştırır.                                 | Yok                                                                      |
| `find`                | Find                   | Belirtilen kriterlere göre dosya veya dizin araması yapar.                | `-name`: Ada göre arar.<br>`-type`: Dosya türüne göre arar.              |
| `grep`                | Global Regular Expression | Dosya içeriğinde belirli bir metni arar.                                  | `-i`: Büyük/küçük harfe duyarsız.<br>`-r`: Alt dizinlerde arar.          |
| `tail`                | Tail                   | Dosyanın son 10 satırını görüntüler.                                      | `-f`: Yeni eklenen satırları canlı izler.<br>`-n`: Satır sayısını belirtir. |
| `head`                | Head                   | Dosyanın ilk 10 satırını görüntüler.                                      | `-n`: Görüntülenecek satır sayısını belirtir.                             |
| `who`                 | Who                    | Sistemde oturum açmış kullanıcıları gösterir.                             | Yok                                                                      |
