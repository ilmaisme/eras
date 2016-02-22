-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2016 at 06:35 AM
-- Server version: 10.0.21-MariaDB
-- PHP Version: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_erasoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions_maintenance`
--

CREATE TABLE `actions_maintenance` (
  `id_actions` int(11) NOT NULL,
  `nama_action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions_maintenance`
--

INSERT INTO `actions_maintenance` (`id_actions`, `nama_action`) VALUES
(1, 'Backup Data '),
(2, 'Database Performance'),
(3, 'Data Integrity'),
(4, 'Erasoft Registry Check'),
(5, 'Server Performance'),
(6, 'Connection Performance'),
(7, 'Virus Check');

-- --------------------------------------------------------

--
-- Table structure for table `am_detail`
--

CREATE TABLE `am_detail` (
  `id_am_detail` int(11) NOT NULL,
  `id_am` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `am_detail`
--

INSERT INTO `am_detail` (`id_am_detail`, `id_am`, `nama`) VALUES
(4, 1, 'Daily'),
(5, 1, 'Weekly'),
(6, 1, 'Monthly'),
(7, 2, 'Compact / Repair Data'),
(8, 2, 'Compact Log File'),
(9, 2, 'Database / Harddisk Capacity'),
(10, 3, 'Data Capacity'),
(11, 3, 'Data Quality'),
(14, 5, 'Memory Usage'),
(15, 5, 'CPU Usage'),
(16, 5, 'Local Area Connection'),
(19, 4, 'Server'),
(20, 4, 'Client'),
(21, 6, 'Client to Server'),
(22, 6, 'Client to Client'),
(23, 7, 'Server'),
(24, 7, 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `bugs`
--

CREATE TABLE `bugs` (
  `id_bugs` int(11) NOT NULL,
  `nama_bugs` varchar(100) NOT NULL,
  `penyelesaian` text NOT NULL,
  `id_software` int(11) NOT NULL,
  `id_modul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bugs`
--

INSERT INTO `bugs` (`id_bugs`, `nama_bugs`, `penyelesaian`, `id_software`, `id_modul`) VALUES
(1, 'test', 'test estest se', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nama_pt` varchar(50) NOT NULL,
  `pic` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `id_user` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id_client`, `nama_pt`, `pic`, `alamat`, `no_telepon`, `id_user`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(2, 'PT Singoedan', 'Ilma', 'Cannot determine address at this location.', '08421231', 12, 0, 0, '2016-02-11 03:52:21', '2016-02-11 03:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `client_support`
--

CREATE TABLE `client_support` (
  `id_cs` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_support` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_support`
--

INSERT INTO `client_support` (`id_cs`, `id_client`, `id_support`, `created_at`, `updated_at`) VALUES
(2, 2, 7, '2016-02-11 03:52:22', '2016-02-11 03:52:22'),
(3, 2, 13, '2016-02-11 03:52:22', '2016-02-11 03:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `rencana_kunjungan`
--

CREATE TABLE `rencana_kunjungan` (
  `id_rk` int(11) NOT NULL,
  `tgl_kunjungan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jam_berangkat` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `aktifitas` text NOT NULL,
  `tipe` enum('kunjungan','remote') NOT NULL,
  `id_support` int(11) NOT NULL,
  `id_tiket` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rk_detail`
--

CREATE TABLE `rk_detail` (
  `id_rk_detail` int(11) NOT NULL,
  `id_bugs` int(11) NOT NULL,
  `id_rk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `server_maintenance`
--

CREATE TABLE `server_maintenance` (
  `id_sm` int(11) NOT NULL,
  `periode` varchar(2) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tgl_check` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_support` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sm_detail`
--

CREATE TABLE `sm_detail` (
  `id_sm_detail` int(11) NOT NULL,
  `id_sm` int(11) NOT NULL,
  `id_action` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `software`
--

CREATE TABLE `software` (
  `id_software` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `versi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software`
--

INSERT INTO `software` (`id_software`, `nama`, `versi`) VALUES
(1, 'Aplikasi Hendors', '1.0'),
(2, 'Aplikasi Web 3', '2.0');

-- --------------------------------------------------------

--
-- Table structure for table `software_detail`
--

CREATE TABLE `software_detail` (
  `id_detail` int(11) NOT NULL,
  `id_software` int(11) NOT NULL,
  `nama_modul` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `software_detail`
--

INSERT INTO `software_detail` (`id_detail`, `id_software`, `nama_modul`) VALUES
(3, 2, 'accounting'),
(4, 2, 'finance'),
(10, 1, 'hrd'),
(11, 1, 'crm');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `masalah` text NOT NULL,
  `id_support` int(11) NOT NULL,
  `status` enum('open','process','finish','cancelled') NOT NULL,
  `tgl_selesai` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_client`, `masalah`, `id_support`, `status`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(1, 2, 'Tidak bisa tambah jurnal', 13, 'cancelled', '2016-02-12 02:17:31', '2016-02-11 04:06:01', '2016-02-11 04:06:01'),
(2, 2, 'Kurang TIdur', 13, 'open', '2016-02-12 02:17:31', '2016-02-11 04:13:57', '2016-02-11 04:13:57'),
(3, 2, 'begadang', 0, 'open', '2016-02-12 02:17:31', '2016-01-24 09:24:21', '2016-01-24 09:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` enum('administrator','client','pm','support') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Project Manager', 'pm@kompas.com', '$2y$10$eWv0KaGtaKZkSfniIURMhuB4FnjyBCX4XotMisKx/kNVSMjy4UnxO', 'pm', 'active', 'pmcSvLW3pE6XM8RXjdRiJIBAtHUroa7LazDnbqhNaT6NH6x7fONmRibYwwI8', '2016-02-13 06:35:07', '2016-02-13 06:35:07'),
(7, 'Tech Support', 'support@kompas.com', '$2y$10$gyGVrqvFhQTbDtey2dFz4.xwO7oCnRMBneJ/lYZZYlW32MOLeBjpq', 'support', 'active', 'J8owt7mOhieG0M9jjEYST0CytleYcCtrqFDk5XNas4b0josrXYkOlyHR8THA', '2016-02-11 03:39:22', '2016-02-11 03:39:22'),
(9, 'Client', 'client@kompas.com', '$2y$10$xZIe3QXrPFHocOuqwKxRju4Q56qVVitekNzL6zrG7ui44k38dW40G', 'client', 'active', 'BKglRbqjBN3pQAOnwHcKMKLCgs6GjEEgPcwrOHcKNT1dBMHwaHEVJyJ0Ce5D', '2016-01-24 07:48:01', '2016-01-24 00:48:01'),
(10, 'Admin', 'admin@kompas.com', '$2y$10$0nU7h6Seey9PUq5A98qUPu3o1cWQeAx7YOIFYuWuEsJ7t7SqtoPNS', 'administrator', 'active', 'yBz0Hb2lnrOMYJUpypvFlvZFMnjDlU4MpqzL4LUDLYl8uMsPwcWXE2UJ7aDm', '2016-01-24 06:54:59', '2016-01-23 23:54:59'),
(12, 'PT Singoedan', 'ilma@gmail.com', '$2y$10$EFsRUUTC8IZZeq8Z986az.4mJaKCC9C1/ONUuej4CCSZoSG0eIwOG', 'client', 'active', 'wkW1ZD0Tu0hcTgYxAN2iEox8VMLDBD4WPfh3o3POwQBtSSwsoz7MCk3PE8L2', '2016-01-24 09:12:01', '2016-01-24 02:12:01'),
(13, 'chandra', 'chandra@gmail.com', '$2y$10$wKZKWzbjqcJxONsGXgP00eraVuSWd3DNMhANyjc5bQDgMPDfMmpEi', 'support', 'active', 'rjpXNXgs6Sh9PlYe7wsceW0v7KYMETKHi7Gbgld7gb3dY0D5dfWlZPQwwGM9', '2016-02-13 06:28:15', '2016-02-13 06:28:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions_maintenance`
--
ALTER TABLE `actions_maintenance`
  ADD PRIMARY KEY (`id_actions`);

--
-- Indexes for table `am_detail`
--
ALTER TABLE `am_detail`
  ADD PRIMARY KEY (`id_am_detail`);

--
-- Indexes for table `bugs`
--
ALTER TABLE `bugs`
  ADD PRIMARY KEY (`id_bugs`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `client_support`
--
ALTER TABLE `client_support`
  ADD PRIMARY KEY (`id_cs`);

--
-- Indexes for table `rencana_kunjungan`
--
ALTER TABLE `rencana_kunjungan`
  ADD PRIMARY KEY (`id_rk`);

--
-- Indexes for table `rk_detail`
--
ALTER TABLE `rk_detail`
  ADD PRIMARY KEY (`id_rk_detail`);

--
-- Indexes for table `server_maintenance`
--
ALTER TABLE `server_maintenance`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indexes for table `sm_detail`
--
ALTER TABLE `sm_detail`
  ADD PRIMARY KEY (`id_sm_detail`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`id_software`);

--
-- Indexes for table `software_detail`
--
ALTER TABLE `software_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions_maintenance`
--
ALTER TABLE `actions_maintenance`
  MODIFY `id_actions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `am_detail`
--
ALTER TABLE `am_detail`
  MODIFY `id_am_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `bugs`
--
ALTER TABLE `bugs`
  MODIFY `id_bugs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `client_support`
--
ALTER TABLE `client_support`
  MODIFY `id_cs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rencana_kunjungan`
--
ALTER TABLE `rencana_kunjungan`
  MODIFY `id_rk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rk_detail`
--
ALTER TABLE `rk_detail`
  MODIFY `id_rk_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `server_maintenance`
--
ALTER TABLE `server_maintenance`
  MODIFY `id_sm` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sm_detail`
--
ALTER TABLE `sm_detail`
  MODIFY `id_sm_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `id_software` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `software_detail`
--
ALTER TABLE `software_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
