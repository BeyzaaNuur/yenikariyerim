-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 11 Kas 2025, 17:14:39
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilanlar`
--

CREATE TABLE `ilanlar` (
  `ilan_id` int(11) NOT NULL,
  `isveren_id` int(11) NOT NULL,
  `ilan_baslik` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `ilan_aciklama` text NOT NULL,
  `olusturulma_tarihi` datetime NOT NULL DEFAULT current_timestamp(),
  `guncellenme_tarihi` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `ilanlar`
--

INSERT INTO `ilanlar` (`ilan_id`, `isveren_id`, `ilan_baslik`, `kategori`, `ilan_aciklama`, `olusturulma_tarihi`, `guncellenme_tarihi`) VALUES
(1, 1, 'Senior Frontend Developer', 'Yazılım', 'React ve TypeScript tecrübesi olan, modern web uygulamaları geliştirebilecek senior frontend developer arıyoruz.\n\nGereksinimler:\n- 3+ yıl React tecrübesi\n- TypeScript bilgisi\n- Redux/MobX state yönetimi\n- REST API entegrasyonu\n- Git version control\n- Responsive tasarım tecrübesi\n\nTercih Edilen Beceriler:\n- Next.js\n- GraphQL\n- Test yazma (Jest, React Testing Library)\n- CI/CD süreçleri\n\nSunulanlar:\n- Rekabetçi maaş\n- Esnek çalışma saatleri\n- Remote çalışma imkanı\n- Sağlık sigortası\n- Yemek kartı', '2025-11-01 10:00:00', NULL),
(2, 2, 'Grafik Tasarımcı', 'Tasarım', 'Yaratıcı ve deneyimli grafik tasarımcı arıyoruz. Marka kimliği, sosyal medya görselleri ve basılı materyaller konusunda tecrübe gereklidir.\n\nGörevler:\n- Marka kimliği tasarımı\n- Sosyal medya görselleri\n- Broşür, banner, afiş tasarımı\n- Logo ve kurumsal kimlik çalışmaları\n- Sunum tasarımları\n\nGereksinimler:\n- Adobe Creative Suite (Photoshop, Illustrator, InDesign)\n- 2+ yıl profesyonel tecrübe\n- Portfolyo\n- Tipografi bilgisi\n- Renk teorisi hakimiyeti\n\nAvantajlar:\n- Genç ve dinamik ekip\n- Yaratıcı özgürlük\n- Kariyer gelişim desteği\n- Ücretli eğitimler', '2025-11-02 14:30:00', NULL),
(3, 3, 'Digital Marketing Uzmanı', 'Pazarlama', 'SEO, SEM ve sosyal medya yönetimi konularında deneyimli digital marketing uzmanı arıyoruz.\n\nSorumluluklar:\n- SEO stratejileri geliştirme\n- Google Ads ve sosyal medya reklamları\n- İçerik pazarlama stratejileri\n- Performans analizi ve raporlama\n- Rakiplerin takibi\n\nGereksinimler:\n- 2+ yıl digital marketing tecrübesi\n- Google Analytics sertifikası\n- SEO/SEM bilgisi\n- Sosyal medya platformları tecrübesi\n- Analitik düşünme becerisi\n\nSunulanlar:\n- Performans bonusu\n- Sertifika programları\n- Esnek çalışma\n- Yurtdışı eğitim fırsatları', '2025-11-03 09:15:00', NULL),
(4, 4, 'Backend Developer (Node.js)', 'Yazılım', 'Node.js ve MongoDB tecrübesi olan backend developer arıyoruz. Mikroservis mimarisi ve cloud teknolojileri konusunda bilgili.\n\nTeknik Gereksinimler:\n- Node.js ve Express.js\n- MongoDB ve Mongoose\n- RESTful API tasarımı\n- JWT authentication\n- Docker ve Kubernetes\n- AWS/Azure tecrübesi\n\nTercih Edilen:\n- GraphQL tecrübesi\n- Microservices mimarisi\n- Redis caching\n- Message queue sistemleri\n\nAvantajlar:\n- Remote çalışma\n- Teknoloji konferansları\n- Açık kaynak proje desteği\n- Yıllık bonus', '2025-11-04 16:45:00', NULL),
(5, 5, 'İnsan Kaynakları Uzmanı', 'İnsan Kaynakları', 'İşe alım süreçlerini yönetecek, yetenek havuzu oluşturacak HR uzmanı arıyoruz.\n\nGörevler:\n- İşe alım süreçleri\n- Mülakat organizasyonu\n- Yetenek havuzu yönetimi\n- Onboarding süreçleri\n- Performans değerlendirme\n\nGereksinimler:\n- 2+ yıl HR tecrübesi\n- İşe alım süreçleri bilgisi\n- İletişim becerileri\n- Analitik düşünme\n- MS Office hakimiyeti\n\nSunulanlar:\n- Kariyer gelişim planı\n- Mentorluk programı\n- Esnek çalışma saatleri\n- Yemek ve ulaşım desteği', '2025-11-05 11:20:00', NULL),
(6, 6, 'Mobil Uygulama Geliştirici', 'Yazılım', 'React Native ile cross-platform mobil uygulama geliştirebilecek developer arıyoruz.\n\nTeknik Beceriler:\n- React Native\n- JavaScript/TypeScript\n- Redux/MobX\n- REST API entegrasyonu\n- Firebase servisleri\n- App Store/Google Play yayınlama\n\nTercih Edilen:\n- Native iOS/Android tecrübesi\n- Offline-first uygulama\n- Performance optimization\n- Test otomasyonu\n\nAvantajlar:\n- Proje bazlı bonus\n- Yeni teknolojiler öğrenme fırsatı\n- Startup ortamı\n- Hisseli çalışma imkanı', '2025-11-06 13:10:00', NULL),
(7, 1, 'UI/UX Tasarımcı', 'Tasarım', 'Kullanıcı deneyimi odaklı, yaratıcı UI/UX tasarımcısı arıyoruz.\n\nGörevler:\n- Wireframe ve prototip oluşturma\n- Kullanıcı araştırmaları\n- Arayüz tasarımı\n- Kullanıcı testleri\n- Design system oluşturma\n\nGereksinimler:\n- Figma, Sketch, Adobe XD\n- UX research metodları\n- Prototyping araçları\n- Portfolyo\n- Takım çalışması\n\nSunulanlar:\n- Creative freedom\n- Design workshopları\n- Latest tools and software\n- Flexible schedule', '2025-11-07 15:30:00', NULL),
(8, 2, 'Veri Analisti', 'Analiz', 'Veri analizi ve raporlama konusunda uzmanlaşmış veri analisti arıyoruz.\n\nGereksinimler:\n- SQL sorgulama\n- Python/R programlama\n- Excel (ileri düzey)\n- Veri görselleştirme araçları\n- İstatistiksel analiz\n\nTercih Edilen:\n- Machine Learning temelleri\n- Tableau/Power BI\n- Big Data teknolojileri\n- E-ticaret analitiği\n\nAvantajlar:\n- Data science eğitimleri\n- Konferans katılım desteği\n- Remote work options\n- Performance bonuses', '2025-11-08 10:45:00', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ilanlar`
--
ALTER TABLE `ilanlar`
  ADD PRIMARY KEY (`ilan_id`),
  ADD KEY `isveren_id` (`isveren_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ilanlar`
--
ALTER TABLE `ilanlar`
  MODIFY `ilan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `ilanlar`
--
ALTER TABLE `ilanlar`
  ADD CONSTRAINT `ilanlar_ibfk_1` FOREIGN KEY (`isveren_id`) REFERENCES `kullanıcı` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
