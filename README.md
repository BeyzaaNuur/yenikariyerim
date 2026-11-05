# yenikariyerim

PHP ve MySQL ile geliştirilmiş basit bir iş ilanı platformu. İşverenler kayıt olup ilan yayınlayabilir, ziyaretçiler ilanları arayıp kategoriye göre filtreleyebilir.

## Özellikler

- Kullanıcı kaydı ve girişi (şifreler `password_hash` ile saklanır)
- İlan listeleme, arama ve kategori filtresi
- İlan detay sayfası ve e-posta ile başvuru
- Giriş yapan kullanıcı için ilan oluşturma
- "İlanlarım" panelinde kendi ilanlarını görme ve silme

## Kullanılan Teknolojiler

- PHP 8 (PDO)
- MySQL / MariaDB
- HTML, CSS

## Klasör Yapısı

```
yenikariyerim/
├── assets/style.css
├── config/db.php
├── database/
│   ├── proje.sql
│   └── ilanlar.sql
├── includes/
│   ├── header.php
│   └── footer.php
├── index.php
├── job_detail.php
├── job_new.php
├── dashboard.php
├── login.php
├── register.php
└── logout.php
```

## Kurulum

1. Projeyi XAMPP'in `htdocs` klasörüne kopyalayın.
2. phpMyAdmin'de `proje` adında bir veritabanı oluşturun.
3. Önce `database/proje.sql`, ardından `database/ilanlar.sql` dosyasını içe aktarın.
4. Gerekirse `config/db.php` içindeki veritabanı bilgilerini düzenleyin.
5. Tarayıcıda `http://localhost/yenikariyerim/` adresini açın.
