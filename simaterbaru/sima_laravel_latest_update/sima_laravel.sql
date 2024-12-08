-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 01:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sima_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `alokasi_ruang`
--

CREATE TABLE `alokasi_ruang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_gedung` bigint(20) UNSIGNED NOT NULL,
  `id_ruang` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `id_fakultas` bigint(20) UNSIGNED NOT NULL,
  `id_prodi` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alokasi_ruang`
--

INSERT INTO `alokasi_ruang` (`id`, `id_gedung`, `id_ruang`, `created_at`, `updated_at`, `status`, `id_fakultas`, `id_prodi`) VALUES
(7, 2, 18, '2024-12-06 04:08:37', '2024-12-06 04:55:20', 'approved', 2, 1),
(8, 3, 16, '2024-12-06 04:08:55', '2024-12-06 04:56:05', 'rejected', 2, 1),
(9, 4, 20, '2024-12-07 11:45:08', '2024-12-07 11:50:29', 'rejected', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departemen`
--

CREATE TABLE `departemen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departemen`
--

INSERT INTO `departemen` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Informatika', '2024-12-01 12:55:16', '2024-12-01 12:55:16'),
(3, 'Hukum', '2024-12-01 12:55:31', '2024-12-01 12:55:31'),
(4, 'Teknik Elektro', '2024-12-01 12:56:11', '2024-12-01 12:56:11'),
(5, 'Teknik Kimia Wi', '2024-12-05 22:49:52', '2024-12-05 22:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` varchar(18) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_prodi` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `id_prodi`, `created_at`, `updated_at`, `user_id`) VALUES
('1239102830110', 'Albert Einsten', 1, '2024-12-07 11:57:24', '2024-12-07 11:57:50', 2),
('1239102830194', 'Ir. Husni Cokro Aminoto', 2, '2024-12-06 09:47:34', '2024-12-06 09:47:34', 9);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id_fakultas` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'TEKNIK', '2024-12-06 02:51:20', '2024-12-06 02:51:20'),
(3, 'MIPA', '2024-12-06 03:10:05', '2024-12-06 03:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(2, 'Gedung A', '2024-12-01 12:04:46', '2024-12-01 12:04:46'),
(3, 'Gedung B', '2024-12-01 12:17:25', '2024-12-05 22:49:11'),
(4, 'Gedung C', '2024-12-07 11:41:08', '2024-12-07 11:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `irs`
--

CREATE TABLE `irs` (
  `id_irs` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(14) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `nip_dosen_wali` varchar(18) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `sks` bigint(20) UNSIGNED DEFAULT NULL,
  `status_lock_irs` enum('locked','open') NOT NULL DEFAULT 'open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irs`
--

INSERT INTO `irs` (`id_irs`, `nim`, `tahun_ajaran`, `semester`, `nip_dosen_wali`, `catatan`, `created_at`, `updated_at`, `status`, `sks`, `status_lock_irs`) VALUES
(2, '1733491826', '2024/2025', 1, '1239102830194', 'Coba ditunjau ulang', '2024-12-07 12:28:59', '2024-12-07 12:38:29', 'rejected', 5, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `irs_items`
--

CREATE TABLE `irs_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_irs` bigint(20) UNSIGNED NOT NULL,
  `id_mata_kuliah` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `irs_items`
--

INSERT INTO `irs_items` (`id`, `id_irs`, `id_mata_kuliah`, `created_at`, `updated_at`) VALUES
(6, 2, 3, '2024-12-07 12:30:01', '2024-12-07 12:30:01'),
(7, 2, 5, '2024-12-07 12:30:31', '2024-12-07 12:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `id_prodi` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `kelas`, `tahun_ajaran`, `semester`, `created_at`, `updated_at`, `status`, `id_prodi`) VALUES
(6, 'A', '2024/2025', '1', '2024-12-08 04:45:44', '2024-12-08 04:51:17', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_items`
--

CREATE TABLE `jadwal_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(255) NOT NULL,
  `kode_ruang` bigint(20) UNSIGNED NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `hari` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwal_items`
--

INSERT INTO `jadwal_items` (`id`, `id_jadwal`, `kode_mk`, `kode_ruang`, `waktu_mulai`, `waktu_selesai`, `hari`, `created_at`, `updated_at`) VALUES
(1, 6, 'MTK-01', 19, '19:32:00', '20:32:00', 'senin', '2024-12-08 05:39:02', '2024-12-08 05:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `khs`
--

CREATE TABLE `khs` (
  `id_khs` bigint(20) UNSIGNED NOT NULL,
  `nim` varchar(14) NOT NULL,
  `kode_mk` varchar(8) NOT NULL,
  `tahun_ajaran` varchar(20) NOT NULL,
  `semester` int(11) NOT NULL,
  `nilai` decimal(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` enum('tidak diketahui','laki-laki','perempuan') NOT NULL DEFAULT 'tidak diketahui',
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `angkatan` varchar(255) NOT NULL,
  `status` enum('aktif','cuti','lulus','keluar') NOT NULL DEFAULT 'aktif',
  `ipk` decimal(8,2) UNSIGNED NOT NULL DEFAULT 0.00,
  `wali_dosen` bigint(20) UNSIGNED NOT NULL,
  `semester` varchar(255) NOT NULL,
  `id_fakultas` bigint(20) UNSIGNED NOT NULL,
  `id_prodi` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `user_id`, `nama_lengkap`, `nim`, `email`, `jenis_kelamin`, `alamat`, `telepon`, `angkatan`, `status`, `ipk`, `wali_dosen`, `semester`, `id_fakultas`, `id_prodi`, `created_at`, `updated_at`) VALUES
(1, 11, 'Siswo Rihadjo Setiabudi', '1733491826', 'kaprodi@gmail.com', 'laki-laki', 'Jl. Kumanggeng, RT 20 RW 12 KEC JOKO ANWAR KEL IBU NEGARA PROV BANTEN INDONESIA 38192', '082280994738', '2022', 'aktif', 4.00, 9, '1', 2, 1, '2024-12-06 06:30:26', '2024-12-07 12:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_mk` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sks` int(11) NOT NULL,
  `nip_dosen` varchar(18) NOT NULL,
  `id_prodi` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id`, `kode_mk`, `nama`, `sks`, `nip_dosen`, `id_prodi`, `created_at`, `updated_at`, `tahun_ajaran`, `semester`) VALUES
(3, 'MTK-01', 'Matematika Diskrit', 3, '1239102830194', 1, '2024-12-06 11:12:18', '2024-12-07 07:05:11', '2024/2025', 1),
(4, 'MTK-02', 'Matematika Peminatan', 2, '1239102830194', 2, '2024-12-07 07:05:50', '2024-12-07 08:38:48', '2024/2025', 2),
(5, 'MTK-03', 'Matematika Wajib', 2, '1239102830110', 1, '2024-12-07 11:58:48', '2024-12-07 11:58:48', '2024/2025', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_19_071507_creating_tabel_users', 2),
(5, '2024_01_01_000002_create_fakultas_table', 3),
(6, '2024_01_01_000003_create_program_studi_table', 3),
(7, '2024_01_01_000004_create_dosen_table', 3),
(8, '2024_01_01_000007_create_mata_kuliah_table', 3),
(9, '2024_01_01_000008_create_ruang_table', 3),
(10, '2024_01_01_000009_create_jadwal_table', 3),
(11, '2024_01_01_000010_create_status_irs_table', 3),
(12, '2024_12_01_171007_create_tabel_settings', 4),
(13, '2024_12_01_185123_create_gedung_table', 5),
(14, '2024_12_01_190523_adding_column_gedung_id_to_ruang', 6),
(15, '2024_12_01_194735_create_table_departemen', 7),
(16, '2024_12_01_200004_create_table_alokasi_ruang', 8),
(17, '2024_12_06_044709_adding_column_to_alokasi_ruang', 9),
(19, '2024_12_06_045358_creating_table_notification', 10),
(21, '2024_12_06_084052_creating_table_mahasiswa', 11),
(22, '2024_12_06_103321_modif_table_alokasi_ruang', 12),
(23, '2024_12_06_125727_adding_column_fakultas_prodi_to_table_mahasiswa', 13),
(24, '2024_12_06_125916_adding_timestamp_to_mahasiswa', 14),
(25, '2024_12_06_162004_adding_user_id_to_dosen', 15),
(26, '2024_12_06_162918_delete_colum_user_id_from_dosen', 16),
(27, '2024_12_07_024749_adding_status_column_to_jadwal', 17),
(28, '2024_12_07_100331_adding_column_to_dosen', 18),
(29, '2024_12_07_135804_adding_column_to_mata_kuliah', 19),
(30, '2024_12_07_141807_modify_irs_table', 20),
(31, '2024_12_07_143603_modify_table_irs', 21),
(32, '2024_12_07_152251_creating_tb_irs_items', 22),
(33, '2024_12_07_153308_modify_mata_kuliah', 23),
(34, '2024_12_08_110133_creating_jadwal_items', 24),
(35, '2024_12_08_111516_modify_jadwal', 25);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `teks` varchar(255) NOT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `teks`, `status`, `created_at`, `updated_at`) VALUES
(1, 7, 'Data alokasi ruangan departemen Hukum berhasil dilakukan, dan saat ini sedang dalam status Pending!', 'read', '2024-12-05 22:04:45', '2024-12-05 22:33:32'),
(2, 7, 'Data alokasi ruangan departemen Hukum berhasil dilakukan, dan saat ini sedang dalam status Pending!', 'read', '2024-12-05 22:34:28', '2024-12-05 22:34:45'),
(3, 7, 'Data ruangan Ruang 1 H berhasil dihapus!', 'read', '2024-12-05 22:47:44', '2024-12-05 22:47:59'),
(4, 7, 'Data ruangan Ruangan Lab Kimia berhasil ditambahkan!', 'unread', '2024-12-05 22:48:24', '2024-12-05 22:48:24'),
(5, 7, 'Data ruangan Ruangan Lab Kimia berhasil diedit!', 'unread', '2024-12-05 22:48:45', '2024-12-05 22:48:45'),
(6, 7, 'Data gedung Gedung B A berhasil diedit!', 'unread', '2024-12-05 22:49:11', '2024-12-05 22:49:11'),
(7, 7, 'Data departemen Teknik Kimia berhasil ditambahkan!', 'unread', '2024-12-05 22:49:52', '2024-12-05 22:49:52'),
(8, 7, 'Data departemen Teknik Kimia Wi berhasil diedit!', 'unread', '2024-12-05 22:50:15', '2024-12-05 22:50:15'),
(9, 7, 'Data departemen Teknik Mesin berhasil ditambahkan!', 'unread', '2024-12-05 22:50:45', '2024-12-05 22:50:45'),
(10, 7, 'Data departemen Teknik Mesin berhasil dihapus!', 'unread', '2024-12-05 22:50:49', '2024-12-05 22:50:49'),
(11, 7, 'Data ruangan Ruangan Lab Kimia berhasil ditambahkan!', 'unread', '2024-12-05 22:51:36', '2024-12-05 22:51:36'),
(12, 7, 'Data ruangan Ruangan Lab Biologi berhasil diedit!', 'unread', '2024-12-05 22:52:24', '2024-12-05 22:52:24'),
(13, 7, 'Data alokasi ruang departemen Teknik Kimia Wi berhasil ditambahkan!', 'read', '2024-12-05 22:52:44', '2024-12-05 22:53:13'),
(14, 7, 'Data alokasi ruangan departemen Teknik Kimia Wi berhasil dilakukan, dan saat ini sedang dalam status Pending!', 'unread', '2024-12-05 22:53:42', '2024-12-05 22:53:42'),
(15, 7, 'Data alokasi ruang departemen Informatika berhasil ditambahkan!', 'unread', '2024-12-05 22:54:27', '2024-12-05 22:54:27'),
(16, 7, 'Data alokasi ruang departemen Informatika berhasil dihpaus!', 'unread', '2024-12-05 22:54:32', '2024-12-05 22:54:32'),
(17, 10, 'Data alokasi ruang departemen Teknik Kimia Wi berhasil ditolak!', 'unread', '2024-12-06 00:03:16', '2024-12-06 00:03:16'),
(18, 10, 'Data alokasi ruang departemen Teknik Elektro berhasil ditolak!', 'unread', '2024-12-06 00:03:59', '2024-12-06 00:03:59'),
(19, 10, 'Data alokasi ruangan departemen Teknik Kimia Wi berhasil Setujui!', 'unread', '2024-12-06 00:07:09', '2024-12-06 00:07:09'),
(20, 10, 'Data alokasi ruangan departemen Teknik Elektro berhasil Setujui!', 'unread', '2024-12-06 00:07:53', '2024-12-06 00:07:53'),
(21, 10, 'Data alokasi ruangan departemen Hukum berhasil Setujui!', 'unread', '2024-12-06 00:07:58', '2024-12-06 00:07:58'),
(22, 10, 'Data alokasi ruang departemen Hukum berhasil ditolak!', 'read', '2024-12-06 00:23:11', '2024-12-06 00:24:26'),
(23, 7, 'Data fakultas TEKNIK berhasil ditambahkan!', 'unread', '2024-12-06 02:48:42', '2024-12-06 02:48:42'),
(24, 7, 'Data fakultas TEKNIK berhasil dihapus!', 'unread', '2024-12-06 02:51:05', '2024-12-06 02:51:05'),
(25, 7, 'Data fakultas TEKNIK berhasil ditambahkan!', 'unread', '2024-12-06 02:51:20', '2024-12-06 02:51:20'),
(26, 7, 'Data program studi ELEKTRO berhasil ditambahkan!', 'unread', '2024-12-06 03:02:27', '2024-12-06 03:02:27'),
(27, 7, 'Data program studi INFORMATIKA berhasil ditambahkan!', 'unread', '2024-12-06 03:09:11', '2024-12-06 03:09:11'),
(28, 7, 'Data program studi KIMIA berhasil ditambahkan!', 'unread', '2024-12-06 03:09:24', '2024-12-06 03:09:24'),
(29, 7, 'Data program studi KIMIA berhasil dihapus!', 'unread', '2024-12-06 03:09:32', '2024-12-06 03:09:32'),
(30, 7, 'Data fakultas MIPA berhasil ditambahkan!', 'unread', '2024-12-06 03:10:05', '2024-12-06 03:10:05'),
(31, 7, 'Data program studi FISIKA MURNI berhasil ditambahkan!', 'unread', '2024-12-06 03:10:29', '2024-12-06 03:10:29'),
(32, 7, 'Data alokasi ruang program studi ELEKTRO berhasil ditambahkan!', 'unread', '2024-12-06 04:01:44', '2024-12-06 04:01:44'),
(33, 7, 'Data alokasi ruang program studi ELEKTRO berhasil dihpaus!', 'unread', '2024-12-06 04:07:38', '2024-12-06 04:07:38'),
(34, 7, 'Data alokasi ruang program studi ELEKTRO berhasil ditambahkan!', 'unread', '2024-12-06 04:08:37', '2024-12-06 04:08:37'),
(35, 7, 'Data alokasi ruang program studi ELEKTRO berhasil ditambahkan!', 'unread', '2024-12-06 04:08:55', '2024-12-06 04:08:55'),
(36, 7, 'Data alokasi ruangan program studi ELEKTRO berhasil dilakukan, dan saat ini sedang dalam status Pending!', 'unread', '2024-12-06 04:17:27', '2024-12-06 04:17:27'),
(37, 10, 'Data alokasi ruangan departemen ELEKTRO berhasil Setujui!', 'unread', '2024-12-06 04:54:59', '2024-12-06 04:54:59'),
(38, 10, 'Data alokasi ruangan departemen ELEKTRO berhasil Setujui!', 'unread', '2024-12-06 04:55:20', '2024-12-06 04:55:20'),
(39, 10, 'Data alokasi ruang departemen ELEKTRO berhasil ditolak!', 'unread', '2024-12-06 04:56:05', '2024-12-06 04:56:05'),
(40, 8, 'Data mahasiswa Siswo Rihadjo Setiabudi berhasil diedit!', 'unread', '2024-12-06 08:31:45', '2024-12-06 08:31:45'),
(41, 8, 'Data mahasiswa Siswo Rihadjo Setiabudi berhasil diedit!', 'unread', '2024-12-06 08:43:23', '2024-12-06 08:43:23'),
(42, 8, 'Data mahasiswa Husein berhasil dihapus!', 'unread', '2024-12-06 08:45:44', '2024-12-06 08:45:44'),
(43, 8, 'Data dosen Si Juki Anak Kosan (2021) berhasil ditambahkan!', 'unread', '2024-12-06 09:33:57', '2024-12-06 09:33:57'),
(44, 8, 'Data dosen Si Juki Anak Kosan (2021) berhasil diedit!', 'unread', '2024-12-06 09:43:35', '2024-12-06 09:43:35'),
(45, 8, 'Data dosen Si Juki Anak Kosan (2021) berhasil diedit!', 'unread', '2024-12-06 09:44:44', '2024-12-06 09:44:44'),
(46, 8, 'Data dosen Si Juki Anak Kosan (2021) berhasil dihapus!', 'unread', '2024-12-06 09:47:09', '2024-12-06 09:47:09'),
(47, 8, 'Data dosen Ir. Husni Cokro Aminoto berhasil ditambahkan!', 'unread', '2024-12-06 09:47:34', '2024-12-06 09:47:34'),
(48, 8, 'Data mata kuliah Matematika Diskrit berhasil ditambahkan!', 'unread', '2024-12-06 10:51:52', '2024-12-06 10:51:52'),
(49, 8, 'Data mata kuliah Matematika Diskrit berhasil dihapus!', 'unread', '2024-12-06 10:58:18', '2024-12-06 10:58:18'),
(50, 8, 'Data mata kuliah Matematika Diskrit berhasil ditambahkan!', 'unread', '2024-12-06 10:59:19', '2024-12-06 10:59:19'),
(51, 8, 'Data mata kuliah Matematika Diskrit berhasil diedit!', 'unread', '2024-12-06 11:10:59', '2024-12-06 11:10:59'),
(52, 8, 'Data mata kuliah Matematika Diskrit berhasil diedit!', 'unread', '2024-12-06 11:11:11', '2024-12-06 11:11:11'),
(53, 8, 'Data mata kuliah Matematika Diskrit berhasil dihapus!', 'unread', '2024-12-06 11:11:50', '2024-12-06 11:11:50'),
(54, 8, 'Data mata kuliah Matematika Diskrit berhasil ditambahkan!', 'unread', '2024-12-06 11:12:18', '2024-12-06 11:12:18'),
(55, 8, 'Data jadwal kuliah Matematika Diskrit berhasil ditambahkan!', 'unread', '2024-12-06 19:47:04', '2024-12-06 19:47:04'),
(56, 8, 'Data jadwal kuliah Matematika Diskrit berhasil ditambahkan!', 'unread', '2024-12-06 21:48:24', '2024-12-06 21:48:24'),
(57, 8, 'Data mata kuliah Matematika Diskrit berhasil diedit!', 'unread', '2024-12-07 07:05:11', '2024-12-07 07:05:11'),
(58, 8, 'Data mata kuliah Matematika Peminatan berhasil ditambahkan!', 'unread', '2024-12-07 07:05:50', '2024-12-07 07:05:50'),
(59, 8, 'Data mata kuliah Matematika Peminatan berhasil diedit!', 'unread', '2024-12-07 08:38:48', '2024-12-07 08:38:48'),
(60, 11, 'Irs anda berhasil dikirimkan ke dosen, sedang menunggu persetujuan', 'read', '2024-12-07 09:52:47', '2024-12-07 12:25:44'),
(61, 9, 'Akses irs berhasil dibuka!', 'unread', '2024-12-07 11:06:53', '2024-12-07 11:06:53'),
(62, 9, 'Irs berhasil ditolak!', 'unread', '2024-12-07 11:12:37', '2024-12-07 11:12:37'),
(63, 9, 'Irs berhasil disetujui!', 'unread', '2024-12-07 11:16:12', '2024-12-07 11:16:12'),
(64, 9, 'Irs berhasil disetujui!', 'unread', '2024-12-07 11:16:59', '2024-12-07 11:16:59'),
(65, 9, 'Catatan berhasil disimpan!', 'unread', '2024-12-07 11:28:35', '2024-12-07 11:28:35'),
(66, 7, 'Data gedung Gedung C berhasil ditambahkan!', 'unread', '2024-12-07 11:41:08', '2024-12-07 11:41:08'),
(67, 7, 'Data ruangan Lab Komputer berhasil ditambahkan!', 'unread', '2024-12-07 11:42:22', '2024-12-07 11:42:22'),
(68, 7, 'Data ruangan Lab Komputer berhasil diedit!', 'unread', '2024-12-07 11:42:42', '2024-12-07 11:42:42'),
(69, 7, 'Data alokasi ruang program studi INFORMATIKA berhasil ditambahkan!', 'unread', '2024-12-07 11:45:08', '2024-12-07 11:45:08'),
(70, 10, 'Data alokasi ruangan departemen INFORMATIKA berhasil Setujui!', 'unread', '2024-12-07 11:49:54', '2024-12-07 11:49:54'),
(71, 10, 'Data alokasi ruang departemen INFORMATIKA berhasil ditolak!', 'unread', '2024-12-07 11:50:29', '2024-12-07 11:50:29'),
(72, 8, 'Data dosen Albert Einsten berhasil ditambahkan!', 'unread', '2024-12-07 11:57:24', '2024-12-07 11:57:24'),
(73, 8, 'Data dosen Albert Einsten berhasil diedit!', 'unread', '2024-12-07 11:57:50', '2024-12-07 11:57:50'),
(74, 8, 'Data mata kuliah Matematika Wajib berhasil ditambahkan!', 'unread', '2024-12-07 11:58:48', '2024-12-07 11:58:48'),
(75, 8, 'Data jadwal kuliah Matematika Wajib berhasil ditambahkan!', 'unread', '2024-12-07 12:03:07', '2024-12-07 12:03:07'),
(76, 11, 'Irs anda berhasil dikirimkan ke dosen, sedang menunggu persetujuan', 'unread', '2024-12-07 12:31:01', '2024-12-07 12:31:01'),
(77, 9, 'Irs berhasil ditolak!', 'unread', '2024-12-07 12:36:56', '2024-12-07 12:36:56'),
(78, 9, 'Catatan berhasil disimpan!', 'unread', '2024-12-07 12:37:28', '2024-12-07 12:37:28'),
(79, 9, 'Irs berhasil disetujui!', 'unread', '2024-12-07 12:37:45', '2024-12-07 12:37:45'),
(80, 9, 'Akses irs berhasil dibuka!', 'unread', '2024-12-07 12:38:16', '2024-12-07 12:38:16'),
(81, 9, 'Irs berhasil ditolak!', 'unread', '2024-12-07 12:38:29', '2024-12-07 12:38:29'),
(82, 9, 'Irs berhasil ditolak!', 'unread', '2024-12-07 12:38:39', '2024-12-07 12:38:39'),
(83, 8, 'Data jadwal kuliah program studi S1 TEKNIK ELEKTRO kelas B semester 2 tahun ajaran 2024/2025 berhasil ditambahkan!', 'unread', '2024-12-08 04:33:37', '2024-12-08 04:33:37'),
(84, 8, 'Data jadwal kuliah program studi S1 TEKNIK ELEKTRO kelas B semester  tahun ajaran 2024/2025 berhasil dihapus!', 'unread', '2024-12-08 04:44:54', '2024-12-08 04:44:54'),
(85, 8, 'Data jadwal kuliah program studi S1 TEKNIK ELEKTRO kelas A semester 1 tahun ajaran 2024/2025 berhasil ditambahkan!', 'unread', '2024-12-08 04:45:10', '2024-12-08 04:45:10'),
(86, 8, 'Data jadwal kuliah program studi S1 TEKNIK ELEKTRO kelas A semester  tahun ajaran 2024/2025 berhasil dihapus!', 'unread', '2024-12-08 04:45:27', '2024-12-08 04:45:27'),
(87, 8, 'Data jadwal kuliah program studi INFORMATIKA kelas A semester 1 tahun ajaran 2024/2025 berhasil ditambahkan!', 'unread', '2024-12-08 04:45:44', '2024-12-08 04:45:44'),
(88, 8, 'Data jadwal kuliah program studi FISIKA MURNI kelas A semester 1 tahun ajaran 2024/2025 berhasil diedit!', 'unread', '2024-12-08 04:51:17', '2024-12-08 04:51:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `id_prodi` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_fakultas` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`id_prodi`, `nama`, `id_fakultas`, `created_at`, `updated_at`) VALUES
(1, 'S1 TEKNIK ELEKTRO', 2, '2024-12-06 03:02:27', '2024-12-06 03:02:27'),
(2, 'INFORMATIKA', 2, '2024-12-06 03:09:11', '2024-12-06 03:09:11'),
(4, 'FISIKA MURNI', 3, '2024-12-06 03:10:29', '2024-12-06 03:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE `ruang` (
  `kode_ruang` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gedung_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`kode_ruang`, `nama`, `kapasitas`, `created_at`, `updated_at`, `gedung_id`) VALUES
(16, 'Ruang 1 Z', 50, '2024-12-01 12:15:55', '2024-12-01 12:17:53', 3),
(17, 'Ruangan 3Z', 50, '2024-12-01 14:01:40', '2024-12-01 14:01:40', 3),
(18, 'Ruangan Lab Kimia', 30, '2024-12-05 22:48:24', '2024-12-05 22:48:45', 2),
(19, 'Ruangan Lab Biologi', 30, '2024-12-05 22:51:36', '2024-12-05 22:52:24', 2),
(20, 'Lab Komputer', 40, '2024-12-07 11:42:22', '2024-12-07 11:42:42', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VTIhewDqKUwl8Qo3tCiXkCoDhT4XV93yatdNDho3', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoib2t1cW9nYVBCbWpyZjlzM3c3MjV5WG40b0x0ZjBETENuVEVkdmVBWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTE1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvZ2V0LWphZHdhbD9lbmQ9MjAyNC0xMi0xNVQwMCUzQTAwJTNBMDAlMkIwNyUzQTAwJmtyPTYmc3RhcnQ9MjAyNC0xMi0wOFQwMCUzQTAwJTNBMDAlMkIwNyUzQTAwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1733662395);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'kalender_akademik', 'kalender-akademik1733075118.pdf', '2024-12-01 10:43:34', '2024-12-01 10:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `status_irs`
--

CREATE TABLE `status_irs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('mahasiswa','pembimbing','dekan','kaprodi','akademik') NOT NULL DEFAULT 'mahasiswa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(7, 'akademik', 'akademik@gmail.com', NULL, '$2y$12$idS876aC0m..N6/aoZbAReVwEt.Bi2.vwpXId3eVkFLqRmKjR1.d.', NULL, '2024-11-19 01:31:40', '2024-11-19 01:31:40', 'akademik'),
(8, 'kaprodi', 'kaprodi@gmail.com', NULL, '$2y$12$laIGyBaFAmBkKLp9FBm5AuaHMbZWb/ilEt7BV3tXPz5zhpZVUWoUG', NULL, '2024-11-19 01:32:02', '2024-11-19 01:32:02', 'kaprodi'),
(9, 'pembimbing', 'pembimbing@gmail.com', NULL, '$2y$12$zqGK9VZNp2jRyl4v0LUTheEG1MrvQzb.jiEvzarywbyDhX5YLmXWS', NULL, '2024-11-19 01:32:45', '2024-11-19 01:32:45', 'pembimbing'),
(10, 'dekan', 'dekan@gmail.com', NULL, '$2y$12$StxkTb4LtZpWgQ70C8lv1ez6UfR3INckr/u1vR6FXzCL3Yzx2SuQ2', NULL, '2024-11-19 01:33:38', '2024-12-05 23:45:05', 'dekan'),
(11, 'Siswo Rihadjo Setiabudi', 'sisworiharjo@gmail.com', NULL, '$2y$12$hv2wfcUANfnemYZH5fv1g.VBFsIeWjaAh0zrVZYAG0wP9OBpqJC3a', NULL, '2024-12-01 08:25:55', '2024-12-07 01:39:30', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alokasi_ruang`
--
ALTER TABLE `alokasi_ruang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `departemen`
--
ALTER TABLE `departemen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `dosen_id_prodi_foreign` (`id_prodi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id_fakultas`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `irs`
--
ALTER TABLE `irs`
  ADD PRIMARY KEY (`id_irs`);

--
-- Indexes for table `irs_items`
--
ALTER TABLE `irs_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jadwal_items`
--
ALTER TABLE `jadwal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khs`
--
ALTER TABLE `khs`
  ADD PRIMARY KEY (`id_khs`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mahasiswa_nim_unique` (`nim`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mata_kuliah_kode_mk_unique` (`kode_mk`),
  ADD KEY `mata_kuliah_id_prodi_foreign` (`id_prodi`),
  ADD KEY `mata_kuliah_nip_dosen_foreign` (`nip_dosen`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `program_studi_id_fakultas_foreign` (`id_fakultas`);

--
-- Indexes for table `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_irs`
--
ALTER TABLE `status_irs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alokasi_ruang`
--
ALTER TABLE `alokasi_ruang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `departemen`
--
ALTER TABLE `departemen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id_fakultas` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `irs`
--
ALTER TABLE `irs`
  MODIFY `id_irs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `irs_items`
--
ALTER TABLE `irs_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_items`
--
ALTER TABLE `jadwal_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `khs`
--
ALTER TABLE `khs`
  MODIFY `id_khs` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `id_prodi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ruang`
--
ALTER TABLE `ruang`
  MODIFY `kode_ruang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `status_irs`
--
ALTER TABLE `status_irs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `program_studi` (`id_prodi`);

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_id_prodi_foreign` FOREIGN KEY (`id_prodi`) REFERENCES `program_studi` (`id_prodi`) ON DELETE CASCADE,
  ADD CONSTRAINT `mata_kuliah_nip_dosen_foreign` FOREIGN KEY (`nip_dosen`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD CONSTRAINT `program_studi_id_fakultas_foreign` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
