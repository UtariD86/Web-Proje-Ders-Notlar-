
---

### 1. **Sistem Yöneticiliği ve İzleme**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `top`  | -        | Sistem kaynaklarını izler, aktif işlemleri listeler. | `-u`, `-p` (işlem veya kullanıcıya göre filtreleme) |
| `htop` | -        | `top` komutunun gelişmiş versiyonu. Daha renkli ve kullanıcı dostudur. | - |
| `ps`   | Process Status | Sistemdeki işlemleri listelemek için kullanılır. | `-aux` (tüm işlemleri gösterir), `-ef` (detaylı işlem listesi) |
| `df`   | Disk Free | Disk kullanımını gösterir. | `-h` (insan tarafından okunabilir format) |
| `du`   | Disk Usage | Dosya/dizin boyutlarını gösterir. | `-sh` (toplam boyut) |
| `free` | -        | Sistem belleği kullanımını gösterir. | `-m` (MB cinsinden gösterir) |
| `uptime`| -       | Sistemin ne kadar süredir çalıştığını gösterir. | - |
| `vmstat`| Virtual Memory Statistics | Sistem performansını izler. | `-s` (özet bilgiler) |

---

### 2. **Sistem Güvenliği**

| Komut  | Açılımı           | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|-------------------|--------|---------------------------------------|
| `ufw`  | Uncomplicated Firewall | Basit güvenlik duvarı yönetimi. | `enable`, `status`, `allow`, `deny` |
| `iptables` | IP Tables             | Paket filtreleme ve güvenlik duvarı yönetimi. | `-L` (kuralları listele), `-A` (kural ekle), `-D` (kural sil) |
| `fail2ban` | -             | Brute-force saldırılarını engeller. | `-s` (durumu gösterir), `-j` (giriş yap) |
| `sudo` | Super User Do     | Root yetkisi ile komut çalıştırır. | `-u` (belirli kullanıcı ile çalıştırma), `-l` (izinleri listele) |
| `chmod`| Change Mode       | Dosya izinlerini değiştirir. | `+r`, `-x`, `+w` (okuma, yazma, çalıştırma izni ekle/sil) |
| `chown`| Change Ownership  | Dosya sahipliğini değiştirir. | `user:group` (sahibi ve grubu değiştir) |

---

### 3. **Paket Yönetimi**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `apt`  | Advanced Package Tool | Debian tabanlı sistemlerde paket yönetimi. | `install`, `remove`, `update`, `upgrade` |
| `yum`  | Yellowdog Updater Modified | Red Hat tabanlı sistemlerde paket yönetimi. | `install`, `remove`, `update`, `list` |
| `dpkg` | Debian Package Manager | Debian paketleri yönetir. | `-i` (paket kurulum), `-r` (paket kaldırma) |
| `rpm`  | Red Hat Package Manager | RPM tabanlı dağıtımlarda paket yönetimi. | `-i` (paket kurulum), `-e` (paket kaldırma) |
| `pacman` | -             | Arch Linux'ta paket yönetimi. | `-S` (kurulum), `-R` (kaldırma), `-U` (güncelleme) |

---

### 4. **Sistem Yedekleme ve Kurtarma**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `rsync`| Remote Synchronize | Dosya ve dizinleri yedekler veya senkronize eder. | `-a` (arşiv modu), `-v` (detaylı çıkış), `-z` (sıkıştırma) |
| `tar`  | -        | Dosya sıkıştırma ve arşivleme. | `-c` (yeni arşiv oluştur), `-x` (arşiv çıkar), `-z` (gzip sıkıştırma) |
| `dd`   | -        | Düşük seviyeli disk kopyalama ve yedekleme. | `if=` (girdi dosyası), `of=` (çıktı dosyası), `bs=` (blok boyutu) |
| `cp`   | Copy     | Dosya ve dizinleri kopyalar. | `-r` (dizin kopyala), `-u` (yalnızca daha eski dosyaları kopyalar) |
| `scp`  | Secure Copy | Uzak sunuculara dosya kopyalama. | `-r` (dizin kopyalama), `-P` (port belirtme) |

---

### 5. **Zamanlayıcılar ve Otomasyon**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `cron` | -        | Zamanlanmış görevlerin çalıştırılması. | `-e` (cron tablosunu düzenler), `-l` (mevcut görevleri listeler) |
| `at`   | -        | Tek seferlik görevler belirler. | `now`, `at 5pm` (belirli bir zaman için görev ayarlama) |
| `systemd timers` | -  | Zamanlanmış görevler için systemd yönetimi. | `systemctl list-timers` (zamanlayıcıları listele) |
| `batch`| -        | Yoğun görevleri zamanlar. | - |

---

### 6. **Ağ Servisleri ve Yönetimi**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `apache2` | -      | Apache web sunucusunu yönetir. | `start`, `stop`, `restart`, `status` |
| `nginx`   | -      | Nginx web sunucusunu yönetir. | `start`, `stop`, `reload`, `status` |
| `mysql`   | -      | MySQL veritabanı yönetimi. | `start`, `stop`, `restart`, `status` |
| `ssh`     | Secure Shell | Uzak bağlantı sağlamak için kullanılır. | `-p` (port belirtme), `-i` (kimlik dosyası) |
| `ftp`     | File Transfer Protocol | Dosya transferi sağlar. | `get`, `put`, `ls` |

---

### 7. **Disk Yönetimi**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `fdisk`| -        | Disk bölümlendirme ve yönetimi. | `-l` (bölümleri listele), `-t` (tip belirle) |
| `parted`| -       | Dinamik disk bölümlendirme. | `mkpart` (yeni bölüm oluştur), `print` (bölümleri listele) |
| `lsblk` | List Block Devices | Bağlı blok cihazlarını gösterir. | - |
| `mount` | -        | Dosya sistemi bağlama. | `-t` (dosya sistemi türü), `-o` (bağlama seçenekleri) |
| `umount`| -        | Dosya sistemini çıkarma. | - |

---

### 8. **Ağ Paylaşımı ve Dosya Yönetimi**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `smbclient` | -    | SMB/CIFS protokolü üzerinden dosya paylaşımı sağlar. | `-L` (paylaşılanları listele), `-U` (kullanıcı adı belirt) |
| `mount`  | -      | Ağ dosya sistemini bağlama. | `-t nfs` (NFS tipi belirt) |
| `nfs`    | Network File System | Ağ dosya sistemi yönetimi. | `mount -t nfs` (NFS paylaşımını bağlama) |
| `sshfs`  | SSH File System | SSH üzerinden dosya sistemi bağlama. | `-o` (bağlantı seçenekleri) |

---

### 9. **Log Yönetimi ve İzleme**

| Komut  | Açılımı  |

 Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `journalctl` | -    | Systemd loglarını görüntüler. | `-xe` (hata günlüğünü göster), `-f` (canlı güncellemeler) |
| `dmesg` | -        | Kernel ve boot loglarını gösterir. | - |
| `tail`  | -        | Dosyanın son kısmını gösterir. | `-f` (dosyayı izler), `-n` (satır sayısı belirt) |
| `grep`  | Global Regular Expression Print | Dosya içinde belirli bir ifadeyi arar. | `-i` (büyük/küçük harf duyarsız), `-r` (dizin içinde arama yapar) |
| `less`  | -        | Dosya içeriğini sayfa sayfa gösterir. | - |

---

### 10. **Gelişmiş Komutlar ve Diğer Araçlar**

| Komut  | Açılımı  | Amacı  | Popüler Parametreler ve Açıklamaları  |
|--------|----------|--------|---------------------------------------|
| `awk`   | -        | Veri işleme ve metin analizi yapar. | `'{print $1}'` (ilk sütunu yazdırır) |
| `sed`   | Stream Editor | Metin üzerinde değişiklikler yapar. | `s/old/new/g` (eskiyi yeni ile değiştirir) |
| `grep`  | -        | Arama komutu. | `-i` (büyük/küçük harf duyarsız), `-r` (dizin içinde arama) |
| `curl`  | -        | URL üzerinden veri transferi yapar. | `-O` (dosya indir), `-I` (başlıkları göster) |

---
