-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2022 pada 16.39
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_topsis_v2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai_hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_siswa`, `nilai_hasil`) VALUES
(1, 17, 1),
(2, 33, 0.998904),
(3, 22, 0.998067),
(4, 54, 0.995309),
(5, 55, 0.992058),
(6, 63, 0.989902),
(7, 73, 0.666423),
(8, 72, 0.333296),
(9, 86, 0.000902955);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_sortir`
--

CREATE TABLE `hasil_sortir` (
  `id_hasil` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nilai_hasil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil_sortir`
--

INSERT INTO `hasil_sortir` (`id_hasil`, `id_siswa`, `nilai_hasil`) VALUES
(6, 17, 1),
(11, 22, 0.998485),
(22, 33, 0.999141),
(43, 54, 0.996321),
(44, 55, 0.993766),
(52, 63, 0.992069),
(61, 72, 0.940023),
(62, 73, 0.968177),
(75, 86, 0.911041);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `type` enum('Benefit','Cost') NOT NULL,
  `bobot` varchar(50) NOT NULL,
  `ada_pilihan` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `type`, `bobot`, `ada_pilihan`) VALUES
(1, 'C1', 'Kepribadian Diri', 'Benefit', '5', 1),
(2, 'C2', 'Jumlah Ketidakhadiran', 'Cost', '4', 0),
(3, 'C3', 'Aktif Dalam Belajar', 'Benefit', '4', 1),
(4, 'C4', 'Nilai Akademis', 'Benefit', '5', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_penilaian` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_siswa`, `id_kriteria`, `nilai_penilaian`) VALUES
(117, 16, 1, 4),
(118, 16, 2, 3),
(119, 16, 3, 8),
(120, 16, 4, 80.6),
(125, 18, 1, 4),
(126, 18, 2, 2),
(127, 18, 3, 8),
(128, 18, 4, 80.7),
(133, 13, 1, 4),
(134, 13, 2, 6),
(135, 13, 3, 8),
(136, 13, 4, 79.24),
(145, 15, 1, 4),
(146, 15, 2, 4),
(147, 15, 3, 8),
(148, 15, 4, 80.43),
(149, 14, 1, 4),
(150, 14, 2, 7),
(151, 14, 3, 8),
(152, 14, 4, 80.37),
(153, 19, 1, 4),
(154, 19, 2, 4),
(155, 19, 3, 8),
(156, 19, 4, 79.48),
(157, 20, 1, 4),
(158, 20, 2, 28),
(159, 20, 3, 8),
(160, 20, 4, 79.34),
(161, 21, 1, 4),
(162, 21, 2, 3),
(163, 21, 3, 8),
(164, 21, 4, 80.09),
(165, 22, 1, 4),
(166, 22, 2, 0),
(167, 22, 3, 8),
(168, 22, 4, 81.43),
(169, 23, 1, 4),
(170, 23, 2, 17),
(171, 23, 3, 8),
(172, 23, 4, 79.14),
(173, 24, 1, 4),
(174, 24, 2, 2),
(175, 24, 3, 8),
(176, 24, 4, 79.74),
(177, 25, 1, 4),
(178, 25, 2, 1),
(179, 25, 3, 8),
(180, 25, 4, 80.87),
(181, 26, 1, 4),
(182, 26, 2, 0),
(183, 26, 3, 8),
(184, 26, 4, 81.11),
(185, 27, 1, 4),
(186, 27, 2, 0),
(187, 27, 3, 8),
(188, 27, 4, 80.77),
(189, 28, 1, 4),
(190, 28, 2, 0),
(191, 28, 3, 8),
(192, 28, 4, 80.89),
(193, 29, 1, 4),
(194, 29, 2, 0),
(195, 29, 3, 8),
(196, 29, 4, 80.41),
(197, 30, 1, 4),
(198, 30, 2, 2),
(199, 30, 3, 8),
(200, 30, 4, 80.98),
(201, 31, 1, 4),
(202, 31, 2, 3),
(203, 31, 3, 8),
(204, 31, 4, 80.12),
(205, 32, 1, 4),
(206, 32, 2, 4),
(207, 32, 3, 8),
(208, 32, 4, 80.62),
(209, 33, 1, 4),
(210, 33, 2, 0),
(211, 33, 3, 8),
(212, 33, 4, 81.56),
(213, 34, 1, 4),
(214, 34, 2, 0),
(215, 34, 3, 8),
(216, 34, 4, 81.17),
(217, 35, 1, 3),
(218, 35, 2, 18),
(219, 35, 3, 8),
(220, 35, 4, 80.34),
(221, 36, 1, 4),
(222, 36, 2, 0),
(223, 36, 3, 8),
(224, 36, 4, 80.94),
(225, 37, 1, 4),
(226, 37, 2, 16),
(227, 37, 3, 8),
(228, 37, 4, 78.97),
(229, 38, 1, 4),
(230, 38, 2, 4),
(231, 38, 3, 8),
(232, 38, 4, 80.51),
(233, 39, 1, 4),
(234, 39, 2, 17),
(235, 39, 3, 8),
(236, 39, 4, 72.99),
(237, 40, 1, 4),
(238, 40, 2, 3),
(239, 40, 3, 8),
(240, 40, 4, 80.48),
(241, 1, 1, 4),
(242, 1, 2, 8),
(243, 1, 3, 8),
(244, 1, 4, 79.86),
(245, 41, 1, 4),
(246, 41, 2, 8),
(247, 41, 3, 8),
(248, 41, 4, 79.86),
(249, 42, 1, 4),
(250, 42, 2, 1),
(251, 42, 3, 8),
(252, 42, 4, 80.55),
(257, 44, 1, 4),
(258, 44, 2, 24),
(259, 44, 3, 8),
(260, 44, 4, 78.35),
(261, 43, 1, 4),
(262, 43, 2, 19),
(263, 43, 3, 8),
(264, 43, 4, 78.87),
(265, 45, 1, 4),
(266, 45, 2, 12),
(267, 45, 3, 8),
(268, 45, 4, 78.92),
(269, 46, 1, 4),
(270, 46, 2, 4),
(271, 46, 3, 8),
(272, 46, 4, 80.21),
(273, 47, 1, 4),
(274, 47, 2, 2),
(275, 47, 3, 8),
(276, 47, 4, 80.48),
(277, 48, 1, 4),
(278, 48, 2, 9),
(279, 48, 3, 8),
(280, 48, 4, 80.03),
(281, 49, 1, 4),
(282, 49, 2, 6),
(283, 49, 3, 8),
(284, 49, 4, 78.89),
(285, 50, 1, 4),
(286, 50, 2, 10),
(287, 50, 3, 8),
(288, 50, 4, 79.55),
(289, 51, 1, 4),
(290, 51, 2, 10),
(291, 51, 3, 8),
(292, 51, 4, 78.08),
(293, 52, 1, 4),
(294, 52, 2, 30),
(295, 52, 3, 8),
(296, 52, 4, 78.65),
(297, 53, 1, 4),
(298, 53, 2, 0),
(299, 53, 3, 8),
(300, 53, 4, 79.6),
(301, 54, 1, 4),
(302, 54, 2, 0),
(303, 54, 3, 8),
(304, 54, 4, 81),
(309, 56, 1, 4),
(310, 56, 2, 2),
(311, 56, 3, 8),
(312, 56, 4, 79.27),
(313, 57, 1, 4),
(314, 57, 2, 0),
(315, 57, 3, 8),
(316, 57, 4, 79.25),
(317, 58, 1, 4),
(318, 58, 2, 1),
(319, 58, 3, 8),
(320, 58, 4, 80.08),
(321, 59, 1, 4),
(322, 59, 2, 9),
(323, 59, 3, 8),
(324, 59, 4, 79.85),
(325, 60, 1, 4),
(326, 60, 2, 3),
(327, 60, 3, 8),
(328, 60, 4, 79.17),
(329, 61, 1, 4),
(330, 61, 2, 0),
(331, 61, 3, 8),
(332, 61, 4, 79.36),
(333, 62, 1, 4),
(334, 62, 2, 2),
(335, 62, 3, 8),
(336, 62, 4, 79.43),
(337, 63, 1, 4),
(338, 63, 2, 0),
(339, 63, 3, 8),
(340, 63, 4, 80.15),
(341, 64, 1, 4),
(342, 64, 2, 1),
(343, 64, 3, 8),
(344, 64, 4, 80.04),
(345, 65, 1, 4),
(346, 65, 2, 0),
(347, 65, 3, 8),
(348, 65, 4, 80.03),
(349, 66, 1, 4),
(350, 66, 2, 9),
(351, 66, 3, 8),
(352, 66, 4, 78.71),
(353, 67, 1, 4),
(354, 67, 2, 4),
(355, 67, 3, 8),
(356, 67, 4, 78.8),
(357, 55, 1, 4),
(358, 55, 2, 0),
(359, 55, 3, 8),
(360, 55, 4, 80.49),
(361, 68, 1, 4),
(362, 68, 2, 26),
(363, 68, 3, 8),
(364, 68, 4, 78.89),
(365, 69, 1, 4),
(366, 69, 2, 20),
(367, 69, 3, 8),
(368, 69, 4, 76.94),
(369, 70, 1, 4),
(370, 70, 2, 13),
(371, 70, 3, 8),
(372, 70, 4, 75.46),
(373, 71, 1, 4),
(374, 71, 2, 11),
(375, 71, 3, 8),
(376, 71, 4, 77.21),
(377, 72, 1, 4),
(378, 72, 2, 2),
(379, 72, 3, 8),
(380, 72, 4, 79.31),
(381, 73, 1, 4),
(382, 73, 2, 1),
(383, 73, 3, 8),
(384, 73, 4, 79.28),
(385, 74, 1, 4),
(386, 74, 2, 17),
(387, 74, 3, 8),
(388, 74, 4, 73.16),
(389, 75, 1, 4),
(390, 75, 2, 20),
(391, 75, 3, 8),
(392, 75, 4, 77.71),
(393, 76, 1, 4),
(394, 76, 2, 14),
(395, 76, 3, 8),
(396, 76, 4, 78.21),
(401, 77, 1, 4),
(402, 77, 2, 4),
(403, 77, 3, 7),
(404, 77, 4, 79.51),
(405, 78, 1, 4),
(406, 78, 2, 26),
(407, 78, 3, 8),
(408, 78, 4, 75.95),
(409, 79, 1, 4),
(410, 79, 2, 5),
(411, 79, 3, 8),
(412, 79, 4, 79.34),
(413, 80, 1, 4),
(414, 80, 2, 7),
(415, 80, 3, 8),
(416, 80, 4, 77.27),
(417, 81, 1, 4),
(418, 81, 2, 3),
(419, 81, 3, 8),
(420, 81, 4, 78.88),
(421, 82, 1, 4),
(422, 82, 2, 4),
(423, 82, 3, 8),
(424, 82, 4, 78.74),
(425, 83, 1, 4),
(426, 83, 2, 12),
(427, 83, 3, 8),
(428, 83, 4, 78.69),
(429, 84, 1, 4),
(430, 84, 2, 3),
(431, 84, 3, 8),
(432, 84, 4, 78.87),
(433, 85, 1, 4),
(434, 85, 2, 4),
(435, 85, 3, 7),
(436, 85, 4, 79.5),
(437, 86, 1, 4),
(438, 86, 2, 3),
(439, 86, 3, 7),
(440, 86, 4, 79.42),
(441, 87, 1, 4),
(442, 87, 2, 34),
(443, 87, 3, 8),
(444, 87, 4, 76.12),
(445, 88, 1, 3),
(446, 88, 2, 9),
(447, 88, 3, 8),
(448, 88, 4, 79.09),
(453, 12, 1, 4),
(454, 12, 2, 4),
(455, 12, 3, 8),
(456, 12, 4, 79.64),
(461, 17, 1, 4),
(462, 17, 2, 0),
(463, 17, 3, 8),
(464, 17, 4, 81.73);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_akhir`
--

CREATE TABLE `penilaian_akhir` (
  `id_penilaian` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_penilaian` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian_akhir`
--

INSERT INTO `penilaian_akhir` (`id_penilaian`, `id_siswa`, `id_kriteria`, `nilai_penilaian`) VALUES
(165, 22, 1, 4),
(166, 22, 2, 0),
(167, 22, 3, 8),
(168, 22, 4, 81.43),
(209, 33, 1, 4),
(210, 33, 2, 0),
(211, 33, 3, 8),
(212, 33, 4, 81.56),
(301, 54, 1, 4),
(302, 54, 2, 0),
(303, 54, 3, 8),
(304, 54, 4, 81),
(337, 63, 1, 4),
(338, 63, 2, 0),
(339, 63, 3, 8),
(340, 63, 4, 80.15),
(357, 55, 1, 4),
(358, 55, 2, 0),
(359, 55, 3, 8),
(360, 55, 4, 80.49),
(377, 72, 1, 4),
(378, 72, 2, 2),
(379, 72, 3, 8),
(380, 72, 4, 79.31),
(381, 73, 1, 4),
(382, 73, 2, 1),
(383, 73, 3, 8),
(384, 73, 4, 79.28),
(437, 86, 1, 4),
(438, 86, 2, 3),
(439, 86, 3, 7),
(440, 86, 4, 79.42),
(489, 17, 1, 4),
(490, 17, 2, 0),
(491, 17, 3, 8),
(492, 17, 4, 81.73);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `kelas` char(3) NOT NULL,
  `nomor_kelas` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nama_siswa`, `jurusan`, `kelas`, `nomor_kelas`) VALUES
(12, 'ADINDA REZKYKA UTAMI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(13, 'ANDINI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(14, 'ANGGA PRAHARA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(15, 'ARMAN USTANDI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(16, 'CHINTIYA RAHAYU', 'Teknik Komputer Dan Jaringan', 'X', 1),
(17, 'DAFFA AL NUHAAD', 'Teknik Komputer Dan Jaringan', 'X', 1),
(18, 'DEVA AMANDA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(19, 'DINA JUNITA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(20, 'FERDI IRAWAN', 'Teknik Komputer Dan Jaringan', 'X', 1),
(21, 'JENI TRI AMANDA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(22, 'LUSI ANA FITRIANI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(23, 'M. ARYA YUDHA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(24, 'MEIDINA ADELLA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(25, 'MOH. RASYID SIDIK', 'Teknik Komputer Dan Jaringan', 'X', 1),
(26, 'MUHAMMAD ARIYATULLAH', 'Teknik Komputer Dan Jaringan', 'X', 1),
(27, 'MUHAMMAD HANIF', 'Teknik Komputer Dan Jaringan', 'X', 1),
(28, 'MUHAMMAD ZULHAMDI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(29, 'NURUL HIDAYATI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(30, 'PUTRI DEWI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(31, 'RAHMA AULIA RATRI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(32, 'RIZKY AUFA RAFIQI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(33, 'SALSABILA NAHARA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(34, 'SENDI SAPUTRA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(35, 'SITI AISYA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(36, 'SUBAIDAH', 'Teknik Komputer Dan Jaringan', 'X', 1),
(37, 'TOPANZA SABARLANA', 'Teknik Komputer Dan Jaringan', 'X', 1),
(38, 'VARHAN AVIVI', 'Teknik Komputer Dan Jaringan', 'X', 1),
(39, 'YEISSEN', 'Teknik Komputer Dan Jaringan', 'X', 1),
(40, 'ZACKY AL ARIF', 'Teknik Komputer Dan Jaringan', 'X', 1),
(41, 'AHMAD FAUZAN SUNANDAR', 'Teknik Komputer Dan Jaringan', 'X', 2),
(42, 'ANISYA MAHARANI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(43, 'ATIKA DIANA PERTIWI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(44, 'CINDI ANGGRAINI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(45, 'DEA LESTARI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(46, 'DEWI SRI ASTUTI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(47, 'DINI ZAFIA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(48, 'GUNAWAN SAPUTRA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(49, 'ISWA FAJRI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(50, 'ILHAM ANANTA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(51, 'JIMMY RAMADHAN', 'Teknik Komputer Dan Jaringan', 'X', 2),
(52, 'M. ADITYA SYAPUTRA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(53, 'M. SALMAN AL FAHRIZI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(54, 'MGS. M. TAUFIQURRAHMAN', 'Teknik Komputer Dan Jaringan', 'X', 2),
(55, 'MUHAMMAD ALDO WIDODO', 'Teknik Komputer Dan Jaringan', 'X', 2),
(56, 'MUHAMMAD FAHRI NANDIKA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(57, 'MUHAMMAD MEILANDRI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(58, 'NIA FEBRIYANTIKA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(59, 'NYIMAS ANNIZ SOUFANI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(60, 'RIZKY MARISCA SUKMA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(61, 'SENI ANGGERAINI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(62, 'SOHIB MAULANA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(63, 'SUCI RAMADANI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(64, 'VENESYA CIKA AULIA PUTRI', 'Teknik Komputer Dan Jaringan', 'X', 2),
(65, 'YOGI APREZA POHAN', 'Teknik Komputer Dan Jaringan', 'X', 2),
(66, 'ZAHRA KHAIRIYAH', 'Teknik Komputer Dan Jaringan', 'X', 2),
(67, 'ZAKIA SALSABILA', 'Teknik Komputer Dan Jaringan', 'X', 2),
(68, 'ADITYA BAGAS PRATAMA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(69, 'AHMAD FARHAN ANUGRAH', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(70, 'AFRILIANSYAH GILANG SAPUTRA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(71, 'AHMAD APRIANSYAH', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(72, 'ALIF DWI ROMANDO', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(73, 'ANDRE SYAPUTRA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(74, 'DAPID KURNIAWAN', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(75, 'ERIC SEPTIAN RAMADAN', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(76, 'JULI SAPUTRA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(77, 'M. GALIH PRASTIO', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(78, 'M. NOPIN PRADITA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(79, 'M. RAIHAN AL LUTFI', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(80, 'M. RASYA GUSTIAN', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(81, 'MUHAMAD JULIAN SAPUTRA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(82, 'MUHAMMAD PRAYOGA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(83, 'MUHAMMAD YOGA PRATAMA', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(84, 'PREDI', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(85, 'RENDI FEBRI YANTO', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(86, 'TEDJA ADITYA RAHMAD DHANI', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(87, 'TRI WILDAN', 'Teknik Bisnis Sepeda Motor', 'X', 1),
(88, 'YUDI', 'Teknik Bisnis Sepeda Motor', 'X', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub_kriteria` varchar(50) NOT NULL,
  `nilai_sub_kriteria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama_sub_kriteria`, `nilai_sub_kriteria`) VALUES
(1, 1, 'Kurang', 59),
(2, 1, 'Cukup', 74),
(3, 1, 'Baik', 84),
(4, 1, 'Sangat Baik', 85),
(5, 3, 'Kurang', 59),
(6, 3, 'Cukup', 74),
(7, 3, 'Baik', 84),
(8, 3, 'Sangat Baik', 85);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `role`) VALUES
(1, 'guru_indo', '12dea96fec20593566ab75692c9949596833adc9', 'Selamet, S.Pd.', 'guruindo@gmail.com', '2'),
(2, 'wali_kelas_tbsm1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Yuliya Astuti, S.Pd', 'walikelastbsm1@gmail.com', '1'),
(3, 'wali_kelas_tkj1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Akyuni Adhandari, S.Kom', 'walikelastkj1@gmail.com', '1'),
(4, 'wali_kelas_tkj2', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Endarsah, S.Pd.', 'walikelastkj2@gmail.com', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `hasil_sortir`
--
ALTER TABLE `hasil_sortir`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `penilaian_akhir`
--
ALTER TABLE `penilaian_akhir`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `hasil_sortir`
--
ALTER TABLE `hasil_sortir`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT untuk tabel `penilaian_akhir`
--
ALTER TABLE `penilaian_akhir`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=493;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
