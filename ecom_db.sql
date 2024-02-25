-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2022 at 09:14 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_layanan`
--

CREATE TABLE `data_layanan` (
  `id_layanan` int(255) NOT NULL,
  `id_toko` int(255) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `jenis_layanan` varchar(50) NOT NULL,
  `harga_layanan` decimal(15,2) NOT NULL,
  `deskripsi_layanan` text NOT NULL,
  `foto_layanan` varchar(255) NOT NULL DEFAULT 'Frame 23.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_layanan`
--

INSERT INTO `data_layanan` (`id_layanan`, `id_toko`, `nama_layanan`, `jenis_layanan`, `harga_layanan`, `deskripsi_layanan`, `foto_layanan`) VALUES
(11, 6, 'Bimbel', 'lesprivate', '150000.00', 'Ini bimbel online', 'IMG-62a0aaf9117dd5.61904655.jpg'),
(16, 6, 'MC Keren Sekali', 'mc', '550500.00', 'Ini mc yang sangat keren sekali', 'IMG-62a1290934e876.79999925.jpg'),
(17, 6, 'Shoe Cleaner Keliling', 'shoecleaning', '30000.00', 'Ini shoe cleaner yang dapat berkeliling', 'IMG-62a1292a0eec53.92795407.jpg'),
(18, 6, 'MC Cukup Keren', 'mc', '400000.00', 'Ini mc yang tidak begitu keren', 'IMG-62a129549b3e06.20475671.jpg'),
(19, 8, 'MC Cantik Gemoy', 'mc', '1000000.00', 'Ini mc yang sangat memikat hati', 'IMG-62a133abaf3a26.49748484.jpg'),
(20, 8, 'Band Keren Purbalingga', 'band', '1500000.00', 'Band ini sangat keren, berbasis di Purbalingga', 'IMG-62a13446d81575.06787803.jpg'),
(21, 8, 'Barbershop Awikwok', 'barbershop', '50000.00', 'Barbershop ini menjamin ketampanan anda', 'IMG-62a135a1b4c349.34127071.jpg'),
(22, 8, 'Cleaning Service Awikwok', 'cleaningservice', '100000.00', 'Cleaning service ini sangat professional, sehingga rumah anda tampak seperti baru.', 'IMG-62a136b9990115.33718143.jpg'),
(23, 8, 'Pijat Brutal', 'massage', '1000000.00', 'Penderitaan anda adalah kepuasan kami. Ket: Pemijat bukan pemilik toko.', 'IMG-62a138cd7f0081.60735214.png'),
(24, 6, 'Elektro Wizard', 'technician', '300000.00', 'Solusi masalah kelistrikan anda!', 'IMG-62a1397411dea4.56144868.jpg'),
(25, 6, 'Bimbel Bahasa Ukraina', 'lesprivate', '400000.00', 'Setelah mengikuti bimbel ini, anak anda dijamin fasih berbahasa Ukraina.', 'IMG-62a13a1a211585.16858497.jpg'),
(26, 6, 'Joki Tugas Ez', 'jokitugas', '1500000.00', 'Anda terlalu malas untuk menyelesaikan tugas dari dosen? Pesan joki tugas kami sekarang juga!', 'IMG-62a13bc77fadf5.83999832.jpg'),
(27, 9, 'Make Up Romi', 'makeup', '450000.00', 'Cocok untuk badut ulang tahun.', 'IMG-62a13d0a2ab616.67939590.jpg'),
(29, 9, 'romi les', 'lesprivate', '20000.00', 'Test', 'IMG-62a2b399e80783.11807032.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `data_toko`
--

CREATE TABLE `data_toko` (
  `id_toko` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `email_toko` varchar(100) NOT NULL,
  `handphone_toko` varchar(20) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  `detail_alamat` text NOT NULL,
  `deskripsi_toko` text NOT NULL,
  `foto_toko` varchar(255) NOT NULL DEFAULT 'Frame 23.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_toko`
--

INSERT INTO `data_toko` (`id_toko`, `username`, `nama_toko`, `email_toko`, `handphone_toko`, `kecamatan`, `kode_pos`, `detail_alamat`, `deskripsi_toko`, `foto_toko`) VALUES
(6, 'ilhan', 'Toko Ilhan', 'ilhan@mail.com', '0832489237', 'kutasari', 34562, 'Jl. Pengadengan', 'Ini toko keren', 'IMG-62a06759f12db3.55140236.jpeg'),
(8, 'suci', 'Toko Suci Cantik', 'sucicantik@gmail.com', '085839385939', 'karanganyar', 37923, 'Jl. Sidomulyo', 'Toko ini milik pacar saya', 'IMG-62a133594fb9e4.67719947.jpg'),
(9, 'romi', 'Ahmad Karomi Services', 'karomi@gmail.com', '08567458394', 'bukateja', 45782, 'Jl. Terminal Keren', 'Servis professional kelas dunia', 'IMG-62a13ccd579972.98048373.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `data_transaksi`
--

CREATE TABLE `data_transaksi` (
  `id_transaksi` int(255) NOT NULL,
  `id_layanan` int(255) NOT NULL,
  `id_toko` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `jumlah_order` int(255) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `alamat_tujuan` text NOT NULL,
  `hari_pemesanan` date NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_transaksi`
--

INSERT INTO `data_transaksi` (`id_transaksi`, `id_layanan`, `id_toko`, `username`, `jumlah_order`, `total_harga`, `alamat_tujuan`, `hari_pemesanan`, `metode_pembayaran`, `status`) VALUES
(1, 16, 6, 'suci', 3, '1661500.00', 'Jl. Kota Baru Indah', '2022-06-09', 'cashondelivery', 'cancelled'),
(2, 18, 6, 'suci', 3, '1210000.00', 'Jl. Kota Baru Indah', '2022-06-10', 'cashondelivery', 'cancelled'),
(3, 24, 6, 'suci', 1, '310000.00', 'Jl. Kota Baru Indah', '2022-06-10', 'cashondelivery', 'finished'),
(9, 20, 8, 'ilhan', 1, '1510000.00', 'Jl. Djuanda Timur', '2022-06-10', 'cashondelivery', 'finished'),
(10, 23, 8, 'ilhan', 2, '2010000.00', 'Jl. Djuanda Timur', '2022-06-10', 'cashondelivery', 'unfinished'),
(11, 22, 8, 'kontol', 1, '110000.00', '', '2022-06-10', 'cashondelivery', 'unfinished');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_user` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `handphone` varchar(20) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'kucingsopan.jpeg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_user`, `username`, `nama`, `password`, `email`, `handphone`, `jenis_kelamin`, `tanggal_lahir`, `alamat`, `foto`) VALUES
(16, 'ilhan', 'Ilhan Mahardika Pratama', '$2y$10$tnz1uBeL71SCMsRul/lPb.BDZ8ohhjTdKxZ4OmOMre6Mz7ulQbylO', 'ilhan@mail.com', '83783463', 'laki-laki', '2022-06-24', 'Jl. Djuanda Timur', 'IMG-629d91ab6069f0.79829016.jpg'),
(17, 'suci', 'Suci Asri Dwiforessa Cantik', '$2y$10$HeeZqy69MGiCkmvnvPUKKejVbjAMdvxXK7we7rlhrrklgbo.4rvQW', 'sucicantik@gmail.com', '84732567834', 'perempuan', '2001-10-06', 'Jl. Kota Baru Indah', 'IMG-629ccdf274a588.05746350.jpg'),
(18, 'romi', 'Ahmad Karomi Al Hamidy', '$2y$10$3Rv24C73kuA/o669jQ.F8.wLTDm.IePilq1j8jZF2IcGOVcVWwrJC', 'a@a', '81383093303', 'laki-laki', '2022-06-23', 'Jl. Karakngso', 'IMG-62a1a597ddfc80.22449166.jpeg'),
(26, 'kontol', '', '$2y$10$HSkjVgpR1jXXeKX6LCrAruFfGUfDROma/0CWx0kvrOwkz5wiHTzfy', 'kontol@gmail.com', '86754367854', '', '0000-00-00', '', 'kucingsopan.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_layanan`
--
ALTER TABLE `data_layanan`
  ADD PRIMARY KEY (`id_layanan`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `data_toko`
--
ALTER TABLE `data_toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD UNIQUE KEY `email_toko` (`email_toko`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_layanan` (`id_layanan`),
  ADD KEY `username` (`username`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_layanan`
--
ALTER TABLE `data_layanan`
  MODIFY `id_layanan` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `data_toko`
--
ALTER TABLE `data_toko`
  MODIFY `id_toko` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  MODIFY `id_transaksi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_layanan`
--
ALTER TABLE `data_layanan`
  ADD CONSTRAINT `data_layanan_ibfk_1` FOREIGN KEY (`id_toko`) REFERENCES `data_toko` (`id_toko`);

--
-- Constraints for table `data_toko`
--
ALTER TABLE `data_toko`
  ADD CONSTRAINT `data_toko_ibfk_1` FOREIGN KEY (`username`) REFERENCES `data_user` (`username`);

--
-- Constraints for table `data_transaksi`
--
ALTER TABLE `data_transaksi`
  ADD CONSTRAINT `data_transaksi_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `data_layanan` (`id_layanan`),
  ADD CONSTRAINT `data_transaksi_ibfk_2` FOREIGN KEY (`username`) REFERENCES `data_user` (`username`),
  ADD CONSTRAINT `data_transaksi_ibfk_3` FOREIGN KEY (`id_toko`) REFERENCES `data_toko` (`id_toko`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
