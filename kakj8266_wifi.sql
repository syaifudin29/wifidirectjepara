-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jun 2023 pada 23.36
-- Versi server: 10.5.19-MariaDB-cll-lve
-- Versi PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kakj8266_wifi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_01_12_034910_pelanggan', 1),
(6, '2023_01_12_040620_paket', 1),
(7, '2023_01_12_042101_tagihan', 1),
(8, '2023_02_16_100247_pembayaran', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket`
--

CREATE TABLE `paket` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `paket`
--

INSERT INTO `paket` (`id`, `nama`, `harga`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '20 MB', '350000', '1', '2023-02-21 02:40:15', '2023-02-21 02:40:15'),
(2, '50 MB', '400000', '1', '2023-02-21 02:40:29', '2023-02-21 02:40:29'),
(3, '100 MB', '500000', '1', '2023-02-21 03:56:12', '2023-02-21 03:56:12'),
(4, '300 mb', '600', '1', '2023-02-25 07:41:46', '2023-02-25 07:41:46'),
(5, '5Mb', '100000', '1', '2023-05-05 07:49:29', '2023-05-05 07:49:29'),
(6, 'coba', '500', '1', '2023-05-27 14:53:59', '2023-05-27 14:53:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_langganan` varchar(255) NOT NULL,
  `ktp` bigint(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `jatuhtempo` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `paket_id` bigint(20) UNSIGNED NOT NULL,
  `photo` text NOT NULL,
  `level` enum('pelanggan','admin') NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `no_langganan`, `ktp`, `nama`, `no_hp`, `alamat`, `email`, `jatuhtempo`, `username`, `password`, `paket_id`, `photo`, `level`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'WF01', 12345, 'Junaidi Aziz', '6285330345919', 'Ds. Kecapi Jepara', 'hackroot29@gmail.com', '2023-02-21', '33322125151', '21232f297a57a5a743894a0e4a801fc3', 1, 'foto/tU2Z1SAEW8dvmfbrScr6vgHm77o46WN5RXV3G6Ld.jpg', 'admin', '1', NULL, '2023-04-11 02:45:37'),
(4, 'WF012011', 564565464564, 'Susanto', '6285330345919', 'Ds tahunan jepara', 'hackroot29@gmail.com', '2023-02-21', '564565464564', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'foto/vxzb4iFZ102JzpzOCzfbf1iT60v8oP5NdEsgrjK8.jpg', 'pelanggan', '1', '2023-02-21 02:46:12', '2023-02-21 06:23:41'),
(5, 'WF012012', 333, 'Junaidi', '6285330345919', 'kembang - jepara', 'hackroot29@gmail.com', '2023-02-22', '333', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', 'pelanggan', '1', '2023-02-21 02:59:32', '2023-02-21 02:59:32'),
(6, 'WF012013', 5655555655, 'Sulastri', '6285330345919', 'Ds. Pecanngaan', 'sulastri@gmail.com', '2023-02-23', '5655555655', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', 'pelanggan', '1', '2023-02-21 03:56:52', '2023-02-21 03:56:52'),
(7, 'WF012014', 2889668, 'Fian12', '085698514', 'Ghfccc45', 'fgdd34@yahoo.com', '2023-02-12', '2889668', 'e10adc3949ba59abbe56e057f20f883e', 1, '', 'pelanggan', '1', '2023-02-26 05:45:08', '2023-03-11 10:34:50'),
(8, 'WF012015', 456654, 'Santoso', '085426587', 'Pekeng', 'baba@gmail.com', '2023-02-27', '456654', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'foto/oB4da8qD5J4YeYHExLeUA0VlsY7g6mJCZYlddsEf.jpg', 'pelanggan', '1', '2023-02-26 05:55:13', '2023-02-26 06:01:49'),
(9, 'WF012016', 65465466456, 'Julaikha', '624654546546', 'D. tulakkan', 'julaikha@gmail.com', '2023-03-09', '65465466456', '21232f297a57a5a743894a0e4a801fc3', 1, '', 'pelanggan', '1', '2023-03-07 03:17:20', '2023-03-07 03:20:16'),
(10, 'WF012017', 10928927, 'edi syahbandi', '089708675430', 'ya ndak tau', 'walkj@gmail.com', '2023-03-13', '10928927', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', 'pelanggan', '1', '2023-03-12 03:48:15', '2023-03-12 03:48:15'),
(11, 'WF012018', 123456789, 'Danang', '085727772079', 'Getas Pejaten Kudus', 'danang@unisnu.ac.id', '2023-12-12', '123456789', '827ccb0eea8a706c4c34a16891f84e7b', 5, '', 'pelanggan', '1', '2023-05-05 07:50:47', '2023-05-05 07:50:47'),
(12, 'WF012019', 321111111111, 'Feri', '088888888888', 'Bulungan', 'gery@gmail.com', '2023-04-28', '321111111111', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', 'pelanggan', '1', '2023-05-19 01:01:14', '2023-05-19 01:01:14'),
(13, 'WF0120110', 32123333333, 'adip', '088888888888', 'adip', 'sandijpr750@gmail.com', '2023-05-27', '32123333333', '827ccb0eea8a706c4c34a16891f84e7b', 1, '', 'pelanggan', '1', '2023-05-27 14:46:31', '2023-05-27 14:46:31'),
(14, 'WF0120111', 32006838621863, 'angga', '5312573821', 'fdef', 'angsgj@gmail.com', '2023-05-27', '32006838621863', '827ccb0eea8a706c4c34a16891f84e7b', 6, '', 'pelanggan', '1', '2023-05-27 14:56:12', '2023-05-27 14:56:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pelanggan_id`, `jumlah`, `created_at`, `updated_at`) VALUES
(624722544, 4, 0, '2023-02-21 02:56:22', '2023-02-21 02:56:22'),
(862611512, 14, 0, '2023-05-27 15:01:36', '2023-05-27 15:01:36'),
(870179055, 10, 0, '2023-04-11 02:46:29', '2023-04-11 02:46:29'),
(933061728, 4, 0, '2023-04-07 00:35:56', '2023-04-07 00:35:56'),
(1506158734, 9, 0, '2023-03-07 03:20:28', '2023-03-07 03:20:28'),
(1550765328, 9, 0, '2023-03-07 03:21:30', '2023-03-07 03:21:30'),
(1821732860, 9, 0, '2023-03-07 03:20:45', '2023-03-07 03:20:45'),
(1909011507, 6, 0, '2023-02-21 03:58:45', '2023-02-21 03:58:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `status` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `keterangan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'simulasi', '1', NULL, '2023-05-27 14:54:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_tagihan` varchar(255) NOT NULL,
  `pelanggan_id` bigint(20) UNSIGNED NOT NULL,
  `no_pembayaran` text NOT NULL,
  `tgl_tagihan` date NOT NULL,
  `ttl_byr` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `status` enum('gagal','sukses','proses','belum') NOT NULL,
  `metode` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL,
  `tgl_byr` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id`, `no_tagihan`, `pelanggan_id`, `no_pembayaran`, `tgl_tagihan`, `ttl_byr`, `denda`, `status`, `metode`, `is_active`, `tgl_byr`, `created_at`, `updated_at`) VALUES
(3, '208079180', 4, '933061728', '2023-02-19', 350000, 10000, 'belum', '', '1', '2023-04-07', '2023-02-21 02:46:12', '2023-05-31 05:02:55'),
(4, '1844124707', 5, '0', '2023-02-22', 350000, 0, 'sukses', '', '1', '2023-02-21', '2023-02-21 02:59:32', '2023-02-21 03:59:53'),
(5, '659115766', 6, '1909011507', '2023-02-23', 350000, 0, 'sukses', '', '1', '2023-02-21', '2023-02-21 03:56:52', '2023-02-21 03:59:13'),
(6, '464436782', 7, '0', '2023-02-12', 350000, 10000, 'sukses', '', '1', '2023-02-26', '2023-02-26 05:45:08', '2023-02-26 05:49:24'),
(7, '341173171', 8, '0', '2023-02-27', 350000, 0, 'sukses', '', '1', '2023-02-27', '2023-02-26 05:55:13', '2023-02-27 11:40:39'),
(8, '556366451', 9, '1550765328', '2023-03-09', 350000, 0, 'sukses', '', '1', '2023-03-07', '2023-03-07 03:17:20', '2023-03-07 03:21:42'),
(9, '2006439340', 10, '870179055', '2023-03-13', 350000, 0, 'belum', '', '1', '2023-03-12', '2023-03-12 03:48:15', '2023-04-11 02:46:31'),
(10, '1282279996', 11, '0', '2023-12-12', 100000, 0, 'belum', '', '1', '2023-05-05', '2023-05-05 07:50:47', '2023-05-05 07:50:47'),
(11, '498902231', 12, '0', '2023-04-28', 350000, 0, 'belum', '', '1', '2023-05-19', '2023-05-19 01:01:14', '2023-05-19 01:01:14'),
(12, '441029654', 13, '0', '2023-05-27', 350000, 0, 'sukses', '', '1', '2023-05-27', '2023-05-27 14:46:31', '2023-05-27 14:47:52'),
(13, '964155295', 14, '862611512', '2023-05-27', 500, 0, 'sukses', '', '1', '2023-05-27', '2023-05-27 14:56:12', '2023-05-27 15:01:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
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
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `paket`
--
ALTER TABLE `paket`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1909011508;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
