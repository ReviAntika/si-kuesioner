-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8112
-- Waktu pembuatan: 10 Jul 2024 pada 09.23
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkegiatan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id` int(10) NOT NULL,
  `nama_responden` varchar(255) NOT NULL,
  `kegiatan_id` varchar(10) NOT NULL,
  `pertanyaan_id` int(50) NOT NULL,
  `jawaban` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id`, `nama_responden`, `kegiatan_id`, `pertanyaan_id`, `jawaban`, `created_at`) VALUES
(134, 'Eva', '111', 1, 'SS', '2024-06-20 06:56:01'),
(135, 'Eva', '111', 2, 'SS', '2024-06-20 06:56:01'),
(136, 'Eva', '111', 3, 'SS', '2024-06-20 06:56:01'),
(137, 'Eva', '111', 4, 'SS', '2024-06-20 06:56:01'),
(138, 'Eva', '111', 5, 'S', '2024-06-20 06:56:01'),
(139, 'Eva', '111', 6, 'S', '2024-06-20 06:56:01'),
(140, 'Eva', '111', 7, 'N', '2024-06-20 06:56:01'),
(141, 'Eva', '111', 8, 'SS', '2024-06-20 06:56:01'),
(142, 'Eva', '111', 9, 'SS', '2024-06-20 06:56:01'),
(143, 'Eva', '111', 10, 'SS', '2024-06-20 06:56:01'),
(144, 'REVI', '2', 1, 'SS', '2024-06-20 08:43:56'),
(145, 'REVI', '2', 2, 'SS', '2024-06-20 08:43:56'),
(146, 'REVI', '2', 3, 'S', '2024-06-20 08:43:56'),
(147, 'REVI', '2', 4, 'N', '2024-06-20 08:43:56'),
(148, 'REVI', '2', 5, 'SS', '2024-06-20 08:43:56'),
(149, 'REVI', '2', 6, 'SS', '2024-06-20 08:43:56'),
(150, 'REVI', '2', 7, 'SS', '2024-06-20 08:43:56'),
(151, 'REVI', '2', 8, 'SS', '2024-06-20 08:43:56'),
(152, 'REVI', '2', 9, 'S', '2024-06-20 08:43:56'),
(153, 'REVI', '2', 10, 'N', '2024-06-20 08:43:56'),
(164, 'revi', '111', 1, 'SS', '2024-06-21 10:35:46'),
(165, 'revi', '111', 2, 'SS', '2024-06-21 10:35:46'),
(166, 'revi', '111', 3, 'S', '2024-06-21 10:35:46'),
(167, 'revi', '111', 4, 'SS', '2024-06-21 10:35:46'),
(168, 'revi', '111', 5, 'S', '2024-06-21 10:35:46'),
(169, 'revi', '111', 6, 'SS', '2024-06-21 10:35:46'),
(170, 'revi', '111', 7, 'SS', '2024-06-21 10:35:46'),
(171, 'revi', '111', 8, 'SS', '2024-06-21 10:35:46'),
(172, 'revi', '111', 9, 'SS', '2024-06-21 10:35:46'),
(173, 'revi', '111', 10, 'SS', '2024-06-21 10:35:46'),
(274, 'nisa', '2', 1, 'SS', '2024-06-22 08:46:34'),
(275, 'nisa', '2', 2, 'S', '2024-06-22 08:46:34'),
(276, 'nisa', '2', 3, 'SS', '2024-06-22 08:46:34'),
(277, 'nisa', '2', 4, 'SS', '2024-06-22 08:46:34'),
(278, 'nisa', '2', 5, 'S', '2024-06-22 08:46:34'),
(279, 'nisa', '2', 6, 'SS', '2024-06-22 08:46:34'),
(280, 'nisa', '2', 7, 'S', '2024-06-22 08:46:34'),
(281, 'nisa', '2', 8, 'N', '2024-06-22 08:46:34'),
(282, 'nisa', '2', 9, 'SS', '2024-06-22 08:46:34'),
(283, 'nisa', '2', 10, 'SS', '2024-06-22 08:46:34'),
(284, 'venny', '114', 1, 'SS', '2024-06-25 02:01:17'),
(285, 'venny', '114', 2, 'S', '2024-06-25 02:01:17'),
(286, 'venny', '114', 3, 'SS', '2024-06-25 02:01:17'),
(287, 'venny', '114', 4, 'SS', '2024-06-25 02:01:17'),
(288, 'venny', '114', 5, 'N', '2024-06-25 02:01:17'),
(289, 'venny', '114', 6, 'SS', '2024-06-25 02:01:17'),
(290, 'venny', '114', 7, 'S', '2024-06-25 02:01:17'),
(291, 'venny', '114', 8, 'SS', '2024-06-25 02:01:17'),
(292, 'venny', '114', 9, 'SS', '2024-06-25 02:01:17'),
(293, 'venny', '114', 10, 'N', '2024-06-25 02:01:17'),
(294, 'REVI ANTIKA SRI ANGGRAENI', '115', 1, 'SS', '2024-06-25 02:07:22'),
(295, 'REVI ANTIKA SRI ANGGRAENI', '115', 2, 'S', '2024-06-25 02:07:22'),
(296, 'REVI ANTIKA SRI ANGGRAENI', '115', 3, 'SS', '2024-06-25 02:07:22'),
(297, 'REVI ANTIKA SRI ANGGRAENI', '115', 4, 'S', '2024-06-25 02:07:22'),
(298, 'REVI ANTIKA SRI ANGGRAENI', '115', 5, 'SS', '2024-06-25 02:07:22'),
(299, 'REVI ANTIKA SRI ANGGRAENI', '115', 6, 'SS', '2024-06-25 02:07:22'),
(300, 'REVI ANTIKA SRI ANGGRAENI', '115', 7, 'N', '2024-06-25 02:07:22'),
(301, 'REVI ANTIKA SRI ANGGRAENI', '115', 8, 'S', '2024-06-25 02:07:22'),
(302, 'REVI ANTIKA SRI ANGGRAENI', '115', 9, 'SS', '2024-06-25 02:07:22'),
(303, 'REVI ANTIKA SRI ANGGRAENI', '115', 10, 'SS', '2024-06-25 02:07:22'),
(304, 'antika', '114', 1, 'SS', '2024-06-26 06:55:43'),
(305, 'antika', '114', 2, 'SS', '2024-06-26 06:55:43'),
(306, 'antika', '114', 3, 'S', '2024-06-26 06:55:43'),
(307, 'antika', '114', 4, 'SS', '2024-06-26 06:55:43'),
(308, 'antika', '114', 5, 'SS', '2024-06-26 06:55:43'),
(309, 'antika', '114', 6, 'SS', '2024-06-26 06:55:43'),
(310, 'antika', '114', 7, 'S', '2024-06-26 06:55:43'),
(311, 'antika', '114', 8, 'SS', '2024-06-26 06:55:43'),
(312, 'antika', '114', 9, 'SS', '2024-06-26 06:55:43'),
(313, 'antika', '114', 10, 'SS', '2024-06-26 06:55:43'),
(314, 'REVI ANTIKA SRI ANGGRAENI', '2', 1, 'SS', '2024-06-26 07:02:45'),
(315, 'REVI ANTIKA SRI ANGGRAENI', '2', 2, 'S', '2024-06-26 07:02:45'),
(316, 'REVI ANTIKA SRI ANGGRAENI', '2', 3, 'SS', '2024-06-26 07:02:45'),
(317, 'REVI ANTIKA SRI ANGGRAENI', '2', 4, 'SS', '2024-06-26 07:02:45'),
(318, 'REVI ANTIKA SRI ANGGRAENI', '2', 5, 'SS', '2024-06-26 07:02:45'),
(319, 'REVI ANTIKA SRI ANGGRAENI', '2', 6, 'S', '2024-06-26 07:02:45'),
(320, 'REVI ANTIKA SRI ANGGRAENI', '2', 7, 'SS', '2024-06-26 07:02:45'),
(321, 'REVI ANTIKA SRI ANGGRAENI', '2', 8, 'SS', '2024-06-26 07:02:45'),
(322, 'REVI ANTIKA SRI ANGGRAENI', '2', 9, 'SS', '2024-06-26 07:02:45'),
(323, 'REVI ANTIKA SRI ANGGRAENI', '2', 10, 'SS', '2024-06-26 07:02:45'),
(324, 'sri', '114', 1, 'SS', '2024-06-26 09:46:07'),
(325, 'sri', '114', 2, 'SS', '2024-06-26 09:46:07'),
(326, 'sri', '114', 3, 'SS', '2024-06-26 09:46:07'),
(327, 'sri', '114', 4, 'S', '2024-06-26 09:46:07'),
(328, 'sri', '114', 5, 'SS', '2024-06-26 09:46:07'),
(329, 'sri', '114', 6, 'SS', '2024-06-26 09:46:07'),
(330, 'sri', '114', 7, 'SS', '2024-06-26 09:46:07'),
(331, 'sri', '114', 8, 'S', '2024-06-26 09:46:07'),
(332, 'sri', '114', 9, 'SS', '2024-06-26 09:46:07'),
(333, 'sri', '114', 10, 'SS', '2024-06-26 09:46:07'),
(334, 'REVI ANTIKA SRI ANGGRAENI', '2', 1, 'SS', '2024-06-26 09:53:54'),
(335, 'REVI ANTIKA SRI ANGGRAENI', '2', 2, 'S', '2024-06-26 09:53:54'),
(336, 'REVI ANTIKA SRI ANGGRAENI', '2', 3, 'SS', '2024-06-26 09:53:54'),
(337, 'REVI ANTIKA SRI ANGGRAENI', '2', 4, 'SS', '2024-06-26 09:53:54'),
(338, 'REVI ANTIKA SRI ANGGRAENI', '2', 5, 'SS', '2024-06-26 09:53:54'),
(339, 'REVI ANTIKA SRI ANGGRAENI', '2', 6, 'TS', '2024-06-26 09:53:54'),
(340, 'REVI ANTIKA SRI ANGGRAENI', '2', 7, 'N', '2024-06-26 09:53:54'),
(341, 'REVI ANTIKA SRI ANGGRAENI', '2', 8, 'S', '2024-06-26 09:53:54'),
(342, 'REVI ANTIKA SRI ANGGRAENI', '2', 9, 'SS', '2024-06-26 09:53:54'),
(343, 'REVI ANTIKA SRI ANGGRAENI', '2', 10, 'N', '2024-06-26 09:53:54'),
(344, 'anggraeni', '114', 1, 'SS', '2024-06-27 06:16:32'),
(345, 'anggraeni', '114', 2, 'S', '2024-06-27 06:16:32'),
(346, 'anggraeni', '114', 3, 'SS', '2024-06-27 06:16:32'),
(347, 'anggraeni', '114', 4, 'S', '2024-06-27 06:16:32'),
(348, 'anggraeni', '114', 5, 'SS', '2024-06-27 06:16:32'),
(349, 'anggraeni', '114', 6, 'SS', '2024-06-27 06:16:32'),
(350, 'anggraeni', '114', 7, 'SS', '2024-06-27 06:16:32'),
(351, 'anggraeni', '114', 8, 'S', '2024-06-27 06:16:32'),
(352, 'anggraeni', '114', 9, 'SS', '2024-06-27 06:16:32'),
(353, 'anggraeni', '114', 10, 'SS', '2024-06-27 06:16:32'),
(354, 'REVI ANTIKA SRI ANGGRAENI', '117', 1, 'SS', '2024-06-27 06:23:59'),
(355, 'REVI ANTIKA SRI ANGGRAENI', '117', 2, 'S', '2024-06-27 06:23:59'),
(356, 'REVI ANTIKA SRI ANGGRAENI', '117', 3, 'SS', '2024-06-27 06:23:59'),
(357, 'REVI ANTIKA SRI ANGGRAENI', '117', 4, 'N', '2024-06-27 06:23:59'),
(358, 'REVI ANTIKA SRI ANGGRAENI', '117', 5, 'N', '2024-06-27 06:23:59'),
(359, 'REVI ANTIKA SRI ANGGRAENI', '117', 6, 'S', '2024-06-27 06:23:59'),
(360, 'REVI ANTIKA SRI ANGGRAENI', '117', 7, 'SS', '2024-06-27 06:23:59'),
(361, 'REVI ANTIKA SRI ANGGRAENI', '117', 8, 'SS', '2024-06-27 06:23:59'),
(362, 'REVI ANTIKA SRI ANGGRAENI', '117', 9, 'SS', '2024-06-27 06:23:59'),
(363, 'REVI ANTIKA SRI ANGGRAENI', '117', 10, 'SS', '2024-06-27 06:23:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kegiatan`
--

CREATE TABLE `tb_kegiatan` (
  `id` int(10) NOT NULL,
  `kd_acara` varchar(255) NOT NULL,
  `tahun` int(10) NOT NULL,
  `dari_tgl` date NOT NULL,
  `sampai_tgl` date DEFAULT NULL,
  `penyelenggara` varchar(30) NOT NULL,
  `kegiatan` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kegiatan`
--

INSERT INTO `tb_kegiatan` (`id`, `kd_acara`, `tahun`, `dari_tgl`, `sampai_tgl`, `penyelenggara`, `kegiatan`, `status`, `created_at`) VALUES
(2, '012', 2024, '2024-06-13', '2024-06-15', 'STMIK BANDUNG', 'WEBINAR IT', NULL, '2024-06-20 09:29:57'),
(111, ' 011', 2024, '2024-01-19', '2024-01-20', 'HIMA SISTEM INFORMASI', 'INSPIRA-SI SPORT', NULL, '2024-06-15 02:51:17'),
(114, 'SBSTMIK BANDUNG21062024', 2024, '2024-06-21', '2024-06-22', 'STMIK BANDUNG', 'KURSUS GRATIS', NULL, '2024-06-21 10:39:55'),
(119, 'SBBEM STMIK BANDUNG20082024', 2024, '2024-08-20', '2024-08-21', 'BEM STMIK BANDUNG', 'Mobile Legends', NULL, '2024-07-03 02:20:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id` int(10) NOT NULL,
  `pertanyaan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id`, `pertanyaan`, `created_at`) VALUES
(1, 'Apakah anda setuju kegiatan ini menambah minat bakat mahasiswa?', '2024-06-27 06:32:29'),
(2, 'Apakah anda setuju kegiatan ini meningkatkan kualitas hidup?', '2024-06-08 10:20:05'),
(3, 'Apakah anda setuju termotivasi dengan kegiatan ini?', '2024-06-08 10:21:01'),
(4, 'Apakah Anda merasa kegiatan ini memberikan dorongan positif terhadap produktivitas atau kreativitas Anda?', '2024-06-08 10:22:19'),
(5, 'Apakah Anda merasa kegiatan ini membantu mengurangi stres atau kecemasan Anda?', '2024-06-08 10:22:19'),
(6, 'Apakah Anda merasa kegiatan ini memberikan kesempatan untuk menciptakan atau berkontribusi pada sesuatu yang lebih besar dari diri Anda sendiri?', '2024-06-08 10:23:08'),
(7, 'Apakah anda setuju kegiatan ini termasuk cara melatih publik speaking anda?', '2024-06-08 10:24:57'),
(8, 'Apakah Anda merasa kegiatan kampus membantu Anda dalam mengembangkan jaringan dan relasi?\r\n', '2024-06-08 10:24:57'),
(9, 'Seberapa setuju Anda bahwa kegiatan kampus memberikan manfaat yang sebanding dengan waktu dan energi yang Anda investasikan?', '2024-06-08 10:25:41'),
(10, 'Apakah anda setuju kegiatan kampus memberikan cukup dukungan untuk pengembangan minat dan hobi di luar akademik?', '2024-06-08 10:25:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pilihan`
--

CREATE TABLE `tb_pilihan` (
  `id` int(10) NOT NULL,
  `kd_point` varchar(10) NOT NULL,
  `ket_point` varchar(50) NOT NULL,
  `mutu` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pilihan`
--

INSERT INTO `tb_pilihan` (`id`, `kd_point`, `ket_point`, `mutu`) VALUES
(1, 'SS', 'Sangat Setuju', 5),
(2, 'S', 'Setuju', 4),
(3, 'N', 'Netral', 3),
(4, 'TS', 'Tidak Setuju', 2),
(5, 'STS', 'Sangat Tidak Setuju', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_responden`
--

CREATE TABLE `tb_responden` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_saran`
--

CREATE TABLE `tb_saran` (
  `id` int(10) NOT NULL,
  `id_kegiatan` varchar(10) NOT NULL,
  `nama_responden` varchar(255) DEFAULT NULL,
  `saran` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_saran`
--

INSERT INTO `tb_saran` (`id`, `id_kegiatan`, `nama_responden`, `saran`) VALUES
(1, '111', 'Eva', 'test saran'),
(2, '111', NULL, 'keren semoga semakin kreatif'),
(3, '2', NULL, 'SARAN'),
(4, '111', NULL, 'Test'),
(5, '111', NULL, 'test saran'),
(7, '2', 'nisa', 'kegiatan nya bermanfaat'),
(8, '114', 'venny', 'kursus nya keren, tolong di adakan lagi untuk seluruh mahasiswa'),
(9, '115', 'REVI ANTIKA SRI ANGGRAENI', 'kegiatan nya oke, pelayanan panitia nya kurang'),
(10, '114', 'antika', 'kegiatannya sangat bermanfaat untuk menambah wawasan'),
(11, '2', 'REVI ANTIKA SRI ANGGRAENI', 'webinar yang menarik'),
(12, '114', 'sri', 'kegiatan yang seru, kembangkan'),
(13, '2', 'REVI ANTIKA SRI ANGGRAENI', 'kegiatannya jenuh, coba buat yang lebih seru'),
(14, '114', 'anggraeni', 'kegiatannya kreatif'),
(15, '117', 'REVI ANTIKA SRI ANGGRAENI', 'kegiatannya oke');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pilihan`
--
ALTER TABLE `tb_pilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_responden`
--
ALTER TABLE `tb_responden`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT untuk tabel `tb_kegiatan`
--
ALTER TABLE `tb_kegiatan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT untuk tabel `tb_responden`
--
ALTER TABLE `tb_responden`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_saran`
--
ALTER TABLE `tb_saran`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
