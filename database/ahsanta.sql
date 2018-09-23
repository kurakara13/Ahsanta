-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2018 pada 06.03
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ahsanta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jihad', 'balgohum@gmail.com', '$2y$10$Tp7Dd3TvcZwfEweABCm6O.tGa6qlvD4xrinR5nhc8AZsTziMhbD5G', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Gamis', 'active', '2018-09-17 13:15:18', '2018-09-17 13:15:18'),
(2, 'Jeans', 'active', '2018-09-17 13:15:32', '2018-09-17 13:15:32'),
(3, 'Kids', 'non active', '2018-09-17 13:15:45', '2018-09-17 13:15:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `colors`
--

INSERT INTO `colors` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Blue', 'active', '2018-09-17 13:19:05', '2018-09-17 13:19:05'),
(2, 'Yellow', 'active', '2018-09-17 13:19:19', '2018-09-17 13:19:19'),
(3, 'Black', 'active', '2018-09-17 13:19:30', '2018-09-17 13:19:30'),
(4, 'Whiite', 'active', '2018-09-17 13:19:57', '2018-09-17 13:19:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_000000_create_category_table', 1),
(3, '2014_10_12_000000_create_colors_table', 1),
(5, '2014_10_12_000000_create_productimage_table', 1),
(6, '2014_10_12_000000_create_promotion_table', 1),
(7, '2014_10_12_000000_create_sizes_table', 1),
(8, '2014_10_12_000000_create_tags_table', 1),
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_resets_table', 1),
(11, '2014_10_12_000000_create_product_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_promotion` int(10) UNSIGNED DEFAULT NULL,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `transaction` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `id_promotion`, `weight`, `stock`, `category`, `tags`, `color`, `size`, `description`, `view`, `transaction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hijab Segi Empat Motif BLACK EDITION Bahan Sutra Satin', '30000', 1, '500', '12', '[\"2\"]', '[\"2\",\"3\"]', '[\"Blue\",\"Yellow\",\"Whiite\"]', '[\"XL\",\"XLXX\",\"M\"]', '<ul><li>Cara pemesanan warna : Berikan Warna Pilihan Anda Silahkan Masukan Warna Pilihan Anda Pada UJUNG ALAMAT ANDA Atau berikan dalam komentar cantumkan nama anda Atau Dikirim Secara Acak (Random)</li><li>Hijab segi empat original</li><li>KEKINIAN</li><li>size 110x110</li><li>tepi jahit rapi</li><li>adem, halus , LEMBUT</li><li>Cocok untuk acara formal maupun casual</li><li data-spm-anchor-id=\"a2o4j.pdp.product_detail.i0.5fa04248tXlZ2n\">Nyaman digunakan</li><li data-spm-anchor-id=\"a2o4j.pdp.product_detail.i1.5fa04248tXlZ2n\">Perawatan mudah</li></ul>', 0, 0, 'Show', '2018-09-17 14:13:05', '2018-09-21 22:11:54'),
(2, '17seven Original', '100000', NULL, '500', '12', '', '', '[\"Blue\",\"Yellow\",\"Black\",\"Whiite\"]', '[\"XL\",\"XLXX\",\"M\",\"S\"]', '<table><tbody><tr><td>SKU (simple)</td><td itemprop=\"sku\">02D5CAA9BDD859GS</td></tr><tr><td>Warna</td><td itemprop=\"color\">Navy</td></tr><tr><td>Petunjuk Perawatan</td><td>Cuci terpisah<br>Gunakan detergen yang lembut<br>Jangan diputar dalam mesin cuci saat pengeringan<br>Jangan gunakan pemutih<br>Setrika suhu rendah</td></tr><tr><td>Material</td><td>100% cotton combed</td></tr><tr><td>Non-sale item</td><td>Kode voucher tidak berlaku untuk produk ini</td></tr></tbody></table>', 0, 0, 'Show', '2018-09-19 22:27:48', '2018-09-19 22:27:48'),
(3, 'B.L.F', '189500', NULL, '500', '12', '', '', '[\"Blue\",\"Whiite\"]', '[\"XL\",\"XLXX\"]', '<table><tbody><tr><td>SKU (simple)</td><td itemprop=\"sku\">4584BAA127F04CGS</td></tr><tr><td>Warna</td><td itemprop=\"color\">Blue</td></tr><tr><td>Petunjuk Perawatan</td><td>Cuci menggunakan tangan<br>Setrika suhu hangat<br>Jangan dikeringkan dengan mesin pengering</td></tr><tr><td>Material</td><td>Poliester</td></tr></tbody></table>', 0, 0, 'Show', '2018-09-19 22:38:04', '2018-09-19 22:38:04'),
(4, 'Salsabila Etnic Kebaya', '279000', NULL, '500', '12', '', '', '[\"Whiite\"]', '[\"XLXX\",\"M\"]', '<table><tbody><tr><td>SKU (simple)</td><td itemprop=\"sku\">0891BAAD11FE49GS</td></tr><tr><td>Warna</td><td itemprop=\"color\">Red</td></tr><tr><td>Petunjuk Perawatan</td><td>Rendam dan cuci dengan tangan kurang dari 1 menit<br>Segera bilas dan angin-anginkan<br>Hindari pengeringan dengan dijemur dibawah matahari yang terlalu terik secara langsung<br>Gunakan deterjen khusus untuk kebaya atau batik</td></tr><tr><td>Material</td><td>Rubia</td></tr><tr><td>Production country</td><td>Indonesia</td></tr><tr><td>Non-sale item</td><td>Kode voucher tidak berlaku untuk produk ini</td></tr></tbody></table>', 0, 0, 'Show', '2018-09-19 22:59:37', '2018-09-19 22:59:37'),
(5, 'Slimfit Pradita Long Sleeve', '247000', NULL, '500', '12', '', '', '[\"Blue\"]', '[\"XL\"]', '<table><tbody><tr><td>SKU (simple)</td><td itemprop=\"sku\">070E4AAA09DD9AGS</td></tr><tr><td>Warna</td><td itemprop=\"color\">Black</td></tr><tr><td>Petunjuk Perawatan</td><td>Cuci terpisah<br>Gunakan detergen yang lembut<br>Jangan diputar dalam mesin cuci saat pengeringan<br>Jangan gunakan pemutih<br>Setrika suhu rendah</td></tr><tr><td>Material</td><td>100% Cotton</td></tr><tr><td>Non-sale item</td><td>Kode voucher tidak berlaku untuk produk ini</td></tr></tbody></table>', 0, 0, 'Show', '2018-09-19 23:04:36', '2018-09-19 23:04:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_image`
--

CREATE TABLE `product_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_product` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product_image`
--

INSERT INTO `product_image` (`id`, `id_product`, `name`, `cover`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '15372357970DSC3184.jpg', 1, 'Show', '2018-09-17 14:13:05', '2018-09-17 19:12:04'),
(2, 1, '15372360811product2.jpg', 0, 'Show', '2018-09-17 14:13:05', '2018-09-17 19:12:04'),
(3, 2, '15374212680product3.jpg', 0, 'Show', '2018-09-19 22:27:49', '2018-09-19 22:27:49'),
(4, 2, '1537421269117seven-original-9905-7336861-2.jpg', 0, 'Show', '2018-09-19 22:27:49', '2018-09-19 22:27:49'),
(5, 2, '1537421269217seven-original-9905-7336861-3.jpg', 0, 'Show', '2018-09-19 22:27:49', '2018-09-19 22:27:49'),
(6, 3, '15374218850b-l-f-1840-5801861-4 (1).jpg', 0, 'Disable', '2018-09-19 22:38:05', '2018-09-19 22:46:35'),
(7, 3, '15374218851b-l-f-1839-5801861-2.jpg', 1, 'Show', '2018-09-19 22:38:05', '2018-09-19 22:58:20'),
(8, 3, '15374218852b-l-f-1840-5801861-3.jpg', 0, 'Disable', '2018-09-19 22:38:05', '2018-09-19 22:46:28'),
(9, 4, '15374231770salsabila-etnic-kebaya-5722-7376551-1.jpg', 0, 'Show', '2018-09-19 22:59:37', '2018-09-19 22:59:37'),
(10, 4, '15374231771salsabila-etnic-kebaya-5723-7376551-2.jpg', 0, 'Show', '2018-09-19 22:59:37', '2018-09-19 22:59:37'),
(11, 4, '15374231772salsabila-etnic-kebaya-5724-7376551-4.jpg', 0, 'Show', '2018-09-19 22:59:37', '2018-09-19 22:59:37'),
(12, 5, '15374234760jayashree-batik-9223-3810361-1.jpg', 0, 'Show', '2018-09-19 23:04:36', '2018-09-19 23:04:36'),
(13, 5, '15374234761jayashree-batik-9224-3810361-2.jpg', 0, 'Show', '2018-09-19 23:04:36', '2018-09-19 23:04:36'),
(14, 5, '15374234762jayashree-batik-9225-3810361-3.jpg', 0, 'Show', '2018-09-19 23:04:36', '2018-09-19 23:04:36'),
(15, 5, '15374234763jayashree-batik-9227-3810361-4.jpg', 0, 'Show', '2018-09-19 23:04:36', '2018-09-19 23:04:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promotion`
--

CREATE TABLE `promotion` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minimum_order` int(11) NOT NULL DEFAULT '0',
  `minimum_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ammount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_use` int(11) NOT NULL DEFAULT '0',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `minimum_order`, `minimum_price`, `ammount`, `type`, `product_use`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Diskon Gila 20%', 1, '0', '20', 'percent', 0, 'active', '2018-09-21 19:32:42', '2018-09-21 19:32:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'XL', 'active', '2018-09-17 13:17:52', '2018-09-17 13:17:52'),
(2, 'XLXX', 'active', '2018-09-17 13:18:03', '2018-09-17 13:18:03'),
(3, 'M', 'active', '2018-09-17 13:18:23', '2018-09-17 13:18:23'),
(4, 'L', 'non active', '2018-09-17 13:18:31', '2018-09-17 13:18:50'),
(5, 'S', 'active', '2018-09-17 13:18:40', '2018-09-17 13:18:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tags`
--

INSERT INTO `tags` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'white', 'non active', '2018-09-17 13:16:21', '2018-09-17 13:17:41'),
(2, 'beauty', 'active', '2018-09-17 13:16:57', '2018-09-17 13:16:57'),
(3, 'calm', 'active', '2018-09-17 13:17:08', '2018-09-17 13:17:08'),
(4, 'cool', 'active', '2018-09-17 13:17:34', '2018-09-17 13:17:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
