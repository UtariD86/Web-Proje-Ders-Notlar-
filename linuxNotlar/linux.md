
| **Komut**              | **Açılımı**                 | **Amacı**                                                                             | **Popüler Parametreler ve Açıklamaları**                                 |
|------------------------|-----------------------------|--------------------------------------------------------------------------------------|---------------------------------------------------------------------------|
| `chmod`                | Change Mode                | Dosya veya dizin izinlerini değiştirmek için kullanılır.                             | `-R`: Alt dizinlerle birlikte uygular.<br>`u+x`: Kullanıcıya çalıştırma izni verir. |
| `chown`                | Change Owner               | Dosya veya dizin sahipliğini değiştirmek için kullanılır.                            | `-R`: Alt dizinlerle birlikte uygular.<br>`owner:group`: Sahip ve grup ayarı. |
| `ls -l`                | List Long Format           | Dosyaları ayrıntılı listelemek için kullanılır.                                       | `-a`: Gizli dosyaları gösterir.<br>`-h`: Boyutları insan okunabilir şekilde gösterir. |
| `tcpdump`              | TCP Dump                   | Ağ paketlerini yakalamak ve analiz etmek için kullanılır.                            | `-i`: Ağ arayüzü belirtir.<br>`-w`: Yakalanan paketleri dosyaya kaydeder. |
| `nmap`                 | Network Mapper             | Ağ taraması yapmak ve ağ üzerindeki cihazları analiz etmek için kullanılır.          | `-sS`: Stealth tarama.<br>`-A`: Ayrıntılı bilgi toplama.<br>`-p`: Port tarama. |
| `netstat`              | Network Statistics         | Ağ bağlantılarını ve trafiği analiz eder.                                            | `-tuln`: Dinleyen portları ve protokolleri gösterir. |
| `tail -f /var/log/syslog` | Tail Follow               | Log dosyalarını canlı olarak izler.                                                  | `-n`: Görüntülenecek satır sayısını belirtir.                              |
| `journalctl`           | Journal Control            | Sistem günlüklerini analiz etmek için kullanılır.                                    | `-xe`: Hata günlüklerini ayrıntılı gösterir.<br>`--since`: Tarih belirtir. |
| `top`                  | Table of Processes         | Sistem işlemlerini ve kaynak kullanımını canlı olarak gösterir.                      | `-u`: Belirli bir kullanıcıya ait işlemleri gösterir.<br>`-n`: Yenileme sayısını belirtir. |
| `htop`                 | Htop Process Viewer        | Top’un gelişmiş bir sürümü. Grafiksel arayüz sunar.                                  | Yok                                                                      |
| `ps`                   | Process Status             | Çalışan işlemleri görüntüler.                                                        | `-aux`: Tüm işlemleri ayrıntılı gösterir.<br>`-e`: Sistemdeki tüm işlemleri gösterir. |
| `df`                   | Disk Free                  | Disk alanı kullanımını analiz eder.                                                  | `-h`: İnsan okunabilir boyutlarda gösterir.<br>`-T`: Dosya sistem tipini gösterir. |
| `du`                   | Disk Usage                 | Belirli bir dizin veya dosyanın disk kullanımını analiz eder.                        | `-h`: İnsan okunabilir boyutlarda gösterir.<br>`-d`: Derinlik belirtir.    |
| `grep`                 | Global Regular Expression  | Metin içinde belirli anahtar kelimeleri arar.                                        | `-i`: Büyük/küçük harfe duyarsız arama.<br>`-r`: Alt dizinlerde arar.      |
| `netstat -tuln`        | Network Statistics         | Sistemdeki aktif bağlantıları ve dinleyen portları görüntüler.                       | Yok                                                                      |
| `pwd`                  | Print Working Directory    | Geçerli çalışma dizinini gösterir.                                                  | Yok                                                                      |
| `ls`                   | List                      | Mevcut dizindeki dosya ve klasörleri listeler.                                       | `-l`: Ayrıntılı listeleme.<br>`-a`: Gizli dosyaları gösterir.             |
| `cd`                   | Change Directory           | Belirtilen dizine geçiş yapar.                                                      | Yok                                                                      |
| `touch`                | Touch                     | Yeni bir dosya oluşturur veya mevcut dosyanın zaman damgasını değiştirir.           | Yok                                                                      |
| `cp`                   | Copy                      | Dosya veya dizinleri kopyalar.                                                      | `-r`: Alt dizinleri de kopyalar.<br>`-i`: Üzerine yazmadan önce onay ister. |
| `mv`                   | Move                      | Dosya veya dizinleri taşır veya yeniden adlandırır.                                  | Yok                                                                      |
| `rm`                   | Remove                    | Dosya veya dizinleri siler.                                                         | `-r`: Alt dizinlerle birlikte siler.<br>`-f`: Zorla siler.                |
| `man`                  | Manual                    | Komutların kullanım kılavuzlarını görüntüler.                                        | Yok                                                                      |
| `whoami`               | Who Am I                  | Geçerli kullanıcıyı gösterir.                                                       | Yok                                                                      |
| `uname -a`             | Unix Name                 | Sistem bilgilerini detaylı olarak gösterir.                                         | Yok                                                                      |
| `mkdir`                | Make Directory            | Yeni bir dizin oluşturur.                                                           | `-p`: Alt dizinlerle birlikte oluşturur.                                  |
| `rmdir`                | Remove Directory          | Boş dizinleri siler.                                                                | Yok                                                                      |
| `tree`                 | Tree                     | Dizin yapısını grafiksel olarak görüntüler (kurulum gerekebilir).                   | Yok                                                                      |
| `find`                 | Find                     | Belirtilen kriterlere göre dosya veya dizin araması yapar.                          | `-name`: Belirli bir ada göre arar.<br>`-type`: Dosya türüne göre arar.   |
| `cat`                  | Concatenate               | Dosya içeriğini ekrana yazdırır.                                                    | Yok                                                                      |
| `more`                 | More                     | Dosya içeriğini sayfa sayfa görüntüler.                                             | Yok                                                                      |
| `less`                 | Less                     | Dosya içeriğini sayfa sayfa görüntüler ve ileri/geri gezinme sağlar.                | Yok                                                                      |
| `head`                 | Head                     | Dosyanın başlangıç satırlarını görüntüler.                                           | `-n`: Görüntülenecek satır sayısını belirtir.                             |
| `tail`                 | Tail                     | Dosyanın son satırlarını görüntüler.                                                | `-f`: Yeni eklenen satırları canlı izler.                                 |
| `Wireshark`            | Wireshark                 | Ağ trafiğini analiz etmek ve izlemek için kullanılır.                               | Yok                                                                      |
| `Fail2ban`             | Fail2Ban                 | Ağ güvenliği için kötü amaçlı IP adreslerini engelleme aracı.                       | Yok                                                                      |
| `ClamAV`               | Clam Antivirus           | Linux için açık kaynaklı antivirüs programı.                                        | Yok                                                                      |
| `Chkrootkit`           | Check Rootkit            | Rootkit tespiti için kullanılır.                                                    | Yok                                                                      |