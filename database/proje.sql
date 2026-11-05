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
-- Tablo için tablo yapısı `kullanıcı`
--

CREATE TABLE `kullanıcı` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sifre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanıcı`
-- (Örnek kullanıcılar; tüm hesapların şifresi: 123456)
--

INSERT INTO `kullanıcı` (`id`, `ad`, `soyad`, `email`, `sifre`) VALUES
(1, 'Örnek', 'Kullanıcı 1', 'ornek1@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C'),
(2, 'Örnek', 'Kullanıcı 2', 'ornek2@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C'),
(3, 'Örnek', 'Kullanıcı 3', 'ornek3@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C'),
(4, 'Örnek', 'Kullanıcı 4', 'ornek4@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C'),
(5, 'Örnek', 'Kullanıcı 5', 'ornek5@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C'),
(6, 'Örnek', 'Kullanıcı 6', 'ornek6@example.com', '$2y$10$QV9qFhtzNDv/U824Nw1ozOvanCzlFc1EtZ1E7l.m4xkexuOHUWF9C');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanıcı`
--
ALTER TABLE `kullanıcı`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanıcı`
--
ALTER TABLE `kullanıcı`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
