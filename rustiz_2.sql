-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 11, 2024 at 06:13 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rustiz_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `danas`
--

CREATE TABLE `danas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `danas`
--

INSERT INTO `danas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'GOPAY HMIF', NULL, NULL),
(2, 'BNI HMIF', NULL, NULL),
(3, 'Cash Melyana', NULL, NULL),
(4, 'Cash Fani', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` bigint UNSIGNED NOT NULL,
  `pengurus_id` bigint UNSIGNED NOT NULL,
  `raplen` int NOT NULL DEFAULT '0',
  `jahim` int NOT NULL DEFAULT '0',
  `wisuda` int NOT NULL DEFAULT '0',
  `pesek` int NOT NULL DEFAULT '0',
  `proker` int NOT NULL DEFAULT '0',
  `lainya` int NOT NULL DEFAULT '0',
  `sisa` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `pengurus_id`, `raplen`, `jahim`, `wisuda`, `pesek`, `proker`, `lainya`, `sisa`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(2, 2, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(3, 3, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(4, 4, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(5, 5, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 6, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(7, 7, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(8, 8, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(9, 9, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(10, 10, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(11, 11, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(12, 12, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(13, 13, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(14, 14, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(15, 15, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(16, 16, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(17, 17, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(18, 18, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(19, 19, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(20, 20, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(21, 21, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(22, 22, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(23, 23, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(24, 24, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(25, 25, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(26, 26, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(27, 27, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(28, 28, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(29, 29, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(30, 30, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(31, 31, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(32, 32, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(33, 33, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(34, 34, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(35, 35, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(36, 36, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(37, 37, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(38, 38, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(39, 39, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(40, 40, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(41, 41, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(42, 42, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(43, 43, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(44, 44, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(45, 45, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(46, 46, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(47, 47, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(48, 48, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(49, 49, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(50, 50, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(51, 51, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(52, 52, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(53, 53, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(54, 54, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(55, 55, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(56, 56, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(57, 57, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(58, 58, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(59, 59, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(60, 60, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(61, 61, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(62, 62, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(63, 63, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deposit_histories`
--

CREATE TABLE `deposit_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deposit_id` bigint UNSIGNED NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_payments`
--

CREATE TABLE `deposit_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `deposit_id` bigint UNSIGNED NOT NULL,
  `dana_id` bigint UNSIGNED NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ilteks`
--

CREATE TABLE `ilteks` (
  `id` bigint UNSIGNED NOT NULL,
  `bulan` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemasukan` int DEFAULT NULL,
  `pj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengeluaran` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` bigint UNSIGNED NOT NULL,
  `pengurus_id` bigint UNSIGNED NOT NULL,
  `april` int NOT NULL DEFAULT '0',
  `mei` int NOT NULL DEFAULT '0',
  `juni` int NOT NULL DEFAULT '0',
  `juli` int NOT NULL DEFAULT '0',
  `agustus` int NOT NULL DEFAULT '0',
  `september` int NOT NULL DEFAULT '0',
  `oktober` int NOT NULL DEFAULT '0',
  `november` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `pengurus_id`, `april`, `mei`, `juni`, `juli`, `agustus`, `september`, `oktober`, `november`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(7, 7, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(8, 8, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(9, 9, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(10, 10, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(11, 11, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(12, 12, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(13, 13, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(14, 14, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(15, 15, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(16, 16, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(17, 17, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(18, 18, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(19, 19, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(20, 20, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(21, 21, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(22, 22, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(23, 23, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(24, 24, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(25, 25, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(26, 26, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(27, 27, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(28, 28, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(29, 29, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(30, 30, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(31, 31, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(32, 32, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(33, 33, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(34, 34, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(35, 35, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(36, 36, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(37, 37, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(38, 38, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(39, 39, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(40, 40, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(41, 41, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(42, 42, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(43, 43, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(44, 44, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(45, 45, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(46, 46, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(47, 47, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(48, 48, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(49, 49, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(50, 50, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(51, 51, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(52, 52, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(53, 53, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(54, 54, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(55, 55, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(56, 56, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(57, 57, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(58, 58, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(59, 59, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(60, 60, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(61, 61, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(62, 62, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL),
(63, 63, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kas_histories`
--

CREATE TABLE `kas_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `dana_id` bigint UNSIGNED NOT NULL,
  `kas_id` bigint UNSIGNED NOT NULL,
  `bulan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kreuses`
--

CREATE TABLE `kreuses` (
  `id` bigint UNSIGNED NOT NULL,
  `bulan` int NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proker` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pemasukan` int DEFAULT NULL,
  `pj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengeluaran` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penguruses`
--

CREATE TABLE `penguruses` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penguruses`
--

INSERT INTO `penguruses` (`id`, `nama`, `divisi`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Rian Syaifullah Ritonga', 'BPH', NULL, NULL),
(2, 'Athifa Nathania', 'BPH', NULL, NULL),
(3, 'Eka Belandini', 'BPH', NULL, NULL),
(4, 'Melyana Rizky Ramadhani', 'BPH', NULL, NULL),
(5, 'Ayu Fitrianingsih', 'BPH', NULL, NULL),
(6, 'Fina Julianti', 'BPH', NULL, NULL),
(7, 'Revalina Fidiya Anugrah', 'BPH', NULL, NULL),
(8, 'Desvania Tirta Izzati', 'ILTEK', NULL, NULL),
(9, 'Firyal Aufa Fahrudin', 'ILTEK', NULL, NULL),
(10, 'Annida Aiska Humairoh', 'ILTEK', NULL, NULL),
(11, 'Brian Cahya Purnama', 'ILTEK', NULL, NULL),
(12, 'Ageng Praba Wijaya', 'ILTEK', NULL, NULL),
(13, 'Ghaza Indra Pratama', 'ILTEK', NULL, NULL),
(14, 'Athallah Tsany Satriyaji', 'ILTEK', NULL, NULL),
(15, 'Rizki Arif Saifudin', 'ILTEK', NULL, NULL),
(16, 'Aditya Fathan Naufaldi', 'ILTEK', NULL, NULL),
(17, 'Anindya Diva Talitha', 'EDUKASI', NULL, NULL),
(18, 'Nabila Winanda Meirani', 'EDUKASI', NULL, NULL),
(19, 'Dwi Bagus Purwo Aji', 'EDUKASI', NULL, NULL),
(20, 'Luthfi Emillulfata', 'EDUKASI', NULL, NULL),
(21, 'Defit Bagus Saputra', 'EDUKASI', NULL, NULL),
(22, 'Farah Tsani Maulida', 'EDUKASI', NULL, NULL),
(23, 'Fawwaz Aufa Al Ghautsa Rafi', 'EDUKASI', NULL, NULL),
(24, 'Fauzia Azahra Depriani', 'EDUKASI', NULL, NULL),
(25, 'Mochamad Azizan', 'HUMAS', NULL, NULL),
(26, 'Reva Septia Wulandari', 'HUMAS', NULL, NULL),
(27, 'Muhammad Naufal Dzakwan', 'HUMAS', NULL, NULL),
(28, 'Sufyan Abdur Rofiq', 'HUMAS', NULL, NULL),
(29, 'Rasyad Dhawiabyaz', 'HUMAS', NULL, NULL),
(30, 'Hidayatul Mangunah', 'HUMAS', NULL, NULL),
(31, 'Dyah Ghaniya Putri', 'HUMAS', NULL, NULL),
(32, 'Mufthie Alie', 'HUMAS', NULL, NULL),
(33, 'Muhammad Ilham rafiqi', 'HUMAS', NULL, NULL),
(34, 'Claresta Berthalita Jatmika', 'MEDKOM', NULL, NULL),
(35, 'Nurafina Nazwani', 'MEDKOM', NULL, NULL),
(36, 'Raia Digna Amanda', 'MEDKOM', NULL, NULL),
(37, 'Muhamad Galih', 'MEDKOM', NULL, NULL),
(38, 'Abhirama Rizqi Pratama', 'MEDKOM', NULL, NULL),
(39, 'Nadzare Kafah Alfatiha', 'MEDKOM', NULL, NULL),
(40, 'Prasetyo Angga Permana', 'MEDKOM', NULL, NULL),
(41, 'Arsy wicaksono', 'MEDKOM', NULL, NULL),
(42, 'Hamas Izzuddin Fathi', 'PSDM', NULL, NULL),
(43, 'Ariza Nola Rufiana', 'PSDM', NULL, NULL),
(44, 'Muhammad Fadhel Fausta', 'PSDM', NULL, NULL),
(45, 'Abdul Aziz Fahmi \'Alauddin', 'PSDM', NULL, NULL),
(46, 'Ukhti Nisa', 'PSDM', NULL, NULL),
(47, 'Kintan Kinasih Mahaputri ', 'PSDM', NULL, NULL),
(48, 'Nisa Izzatul Ummah', 'PSDM', NULL, NULL),
(49, 'Audi Makrufianto Afetama', 'PSDM', NULL, NULL),
(50, 'Achmad Aulia Difiputra', 'MIKAT', NULL, NULL),
(51, 'Kamila Fajar Pertiwi', 'MIKAT', NULL, NULL),
(52, 'Isma Fadhilatizzahra', 'MIKAT', NULL, NULL),
(53, 'Fawwaz Afkar Muzakky', 'MIKAT', NULL, NULL),
(54, 'Athaya Raihan Annafi', 'MIKAT', NULL, NULL),
(55, 'Bilqis Sabrina Shatila', 'MIKAT', NULL, NULL),
(56, 'Darrell Gibran', 'MIKAT', NULL, NULL),
(57, 'Syifa Rahmadani', 'KREUS', NULL, NULL),
(58, 'Fatimah Nurmawati', 'KREUS', NULL, NULL),
(59, 'Jasmine Adzra Fakhirah', 'KREUS', NULL, NULL),
(60, 'Nicholas Hasian', 'KREUS', NULL, NULL),
(61, 'Ratu Naurah Calista', 'KREUS', NULL, NULL),
(62, 'Mukhammad Alfaen Fadillah', 'KREUS', NULL, NULL),
(63, 'Simon Dimas Pramudya', 'KREUS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksis`
--

CREATE TABLE `transaksis` (
  `id` bigint UNSIGNED NOT NULL,
  `dana_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 'bendahara', 'Bendahara', '$2y$10$z8UNCvveSmLcn3T4tjLfiOeSMEkEwNKIB62JDUZbZ4j/lvHIG7PHy', NULL, '2024-04-07 08:44:14'),
(2, 'kreus', 'Kreus', '$2y$10$EDfjV9qJF3f5jWAwOMxINOu2qa8je99.u4cIBUCIsbYeG5X0BUlnu', NULL, NULL),
(3, 'iltek', 'Iltek', '$2y$10$sfdTPiXUya5jyVTaFGE5S.EvkBayjqKubA3dJ9tf0zXx7MqizArgS', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `danas`
--
ALTER TABLE `danas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_histories`
--
ALTER TABLE `deposit_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_payments`
--
ALTER TABLE `deposit_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilteks`
--
ALTER TABLE `ilteks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kas_histories`
--
ALTER TABLE `kas_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kreuses`
--
ALTER TABLE `kreuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penguruses`
--
ALTER TABLE `penguruses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `transaksis`
--
ALTER TABLE `transaksis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `danas`
--
ALTER TABLE `danas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `deposit_histories`
--
ALTER TABLE `deposit_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_payments`
--
ALTER TABLE `deposit_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ilteks`
--
ALTER TABLE `ilteks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `kas_histories`
--
ALTER TABLE `kas_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kreuses`
--
ALTER TABLE `kreuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penguruses`
--
ALTER TABLE `penguruses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksis`
--
ALTER TABLE `transaksis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
