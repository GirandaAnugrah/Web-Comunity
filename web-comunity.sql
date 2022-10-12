-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 08:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-comunity`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_postingan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `jml_like` int(11) DEFAULT NULL,
  `tanggal_comment` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id_postingan`, `id_user`, `comment`, `jml_like`, `tanggal_comment`) VALUES
(1, 10, 'Keren banget', 2, '2022-10-08 00:00:00'),
(1, 5, 'Keren Banget', NULL, '2022-10-08 00:00:00'),
(2, 5, 'sangat bermanfaat', NULL, '2022-10-08 00:00:00'),
(20, 9, 'Setuju', NULL, '2022-10-09 00:00:00'),
(2, 5, 'sangat bermanfaat', NULL, '2022-10-09 00:00:00'),
(24, 23, 'Keren Banget Hamdan', NULL, '2022-10-09 00:00:00'),
(22, 23, 'Mantap Agus mama kamu pasti bangga', NULL, '2022-10-09 00:00:00'),
(20, 5, 'Hii', NULL, '2022-10-10 00:00:00'),
(22, 5, 'keren banget', NULL, '2022-10-10 00:00:00'),
(23, 5, 'bener', NULL, '2022-10-10 00:00:00'),
(23, 5, 'sangat menyenangkan', NULL, '2022-10-10 00:00:00'),
(3, 5, 'sangat bermanfaat', NULL, '2022-10-10 00:00:00'),
(8, 5, 'sangat menarik', NULL, '2022-10-10 00:00:00'),
(1, 5, 'HMM menarik', NULL, '2022-10-10 00:00:00'),
(1, 5, 'Semoga sukses selalu', NULL, '2022-10-10 00:00:00'),
(18, 5, 'Hmm Memang susah sih', NULL, '2022-10-10 00:00:00'),
(8, 5, 'bagi mentahan gambarnya donk', NULL, '2022-10-10 00:00:00'),
(24, 5, 'Belajar lagi yang giat', NULL, '2022-10-10 00:00:00'),
(23, 5, 'matamu menyenangkan sosah cokkk', NULL, '2022-10-10 00:00:00'),
(2, 5, '', NULL, '2022-10-10 00:00:00'),
(17, 5, 'konten yang bermanfaat', NULL, '2022-10-10 00:00:00'),
(2, 5, 'hmmm masa sihhh', NULL, '2022-10-10 00:00:00'),
(20, 5, 'kyknya lu kurang memahami dasar programmingnya', NULL, '2022-10-10 00:00:00'),
(22, 5, 'bohong lu gus', NULL, '2022-10-10 00:00:00'),
(23, 5, 'BENER BANGET', NULL, '2022-10-10 00:00:00'),
(21, 5, 'JAVA MMG cocok untuk OOP', NULL, '2022-10-10 00:00:00'),
(20, 5, 'HI', NULL, '2022-10-10 00:00:00'),
(20, 5, 'bootcamp aja biar ada mentornya', NULL, '2022-10-10 00:00:00'),
(23, 5, 'BENER BANGET', NULL, '2022-10-10 00:00:00'),
(8, 5, 'Sangat bermanfaat', NULL, '2022-10-10 00:00:00'),
(23, 5, 'Tergantung sihh', NULL, '2022-10-10 00:00:00'),
(22, 5, 'Spil Chanel youtubenya dong', NULL, '2022-10-10 00:00:00'),
(22, 5, 'Biar bisa belajar juga', NULL, '2022-10-10 00:00:00'),
(22, 5, 'Gus bagi password Wifi dong', NULL, '2022-10-10 00:00:00'),
(22, 5, 'Yang benerr', NULL, '2022-10-10 00:00:00'),
(23, 5, 'Bohong luu', NULL, '2022-10-10 00:00:00'),
(24, 5, 'Keren Hamdan', NULL, '2022-10-10 00:00:00'),
(3, 5, 'Bermanfaat bagi kesehatan', NULL, '2022-10-10 00:00:00'),
(3, 5, 'Fungsional dimananya?', NULL, '2022-10-10 00:00:00'),
(3, 5, 'SUSAh KAh', NULL, '2022-10-10 00:00:00'),
(3, 5, 'Hi', NULL, '2022-10-10 00:00:00'),
(23, 17, 'BEner sihh', NULL, '2022-10-10 00:00:00'),
(24, 17, 'NOde Js Susah sih', NULL, '2022-10-10 00:00:00'),
(8, 17, 'Postingan yg sangat bermanfaat bagi kesehatan', NULL, '2022-10-10 01:46:05'),
(8, 17, 'sekarang jam brpa', NULL, '2022-10-10 01:46:39'),
(1, 17, 'Gimana kabarnya', NULL, '2022-10-10 02:12:12'),
(1, 17, 'lagi dmna Sekarang', NULL, '2022-10-10 02:12:27'),
(21, 17, 'Keren dito', NULL, '2022-10-10 02:14:11'),
(21, 17, 'OOP belajarnya dari mana ya?', NULL, '2022-10-10 02:14:29'),
(21, 17, 'spil chanel youtubenya dong', NULL, '2022-10-10 02:14:40'),
(2, 17, '', NULL, '2022-10-10 02:17:55'),
(2, 17, '', NULL, '2022-10-10 02:19:32'),
(20, 17, 'Kurang paham di dasarnya', NULL, '2022-10-10 02:19:56'),
(3, 17, 'Sangat bermanfaat renfred', NULL, '2022-10-10 02:22:13'),
(21, 17, 'bener', NULL, '2022-10-10 02:41:44'),
(17, 22, 'Sangat Bermanfaat', NULL, '2022-10-10 04:05:25'),
(18, 22, 'saran klo masih belajar mending javascript atau phyton aja', NULL, '2022-10-10 04:06:03'),
(17, 22, '', NULL, '2022-10-10 04:13:55'),
(8, 22, '', NULL, '2022-10-10 04:16:51'),
(8, 22, '', NULL, '2022-10-10 04:17:13'),
(8, 22, '', NULL, '2022-10-10 04:19:22'),
(8, 22, '', NULL, '2022-10-10 04:20:23'),
(8, 22, '', NULL, '2022-10-10 04:22:32'),
(17, 22, '', NULL, '2022-10-10 04:24:19'),
(17, 22, 'Hi renferd', NULL, '2022-10-10 04:24:34'),
(24, 22, '', NULL, '2022-10-10 04:25:58'),
(1, 22, '', NULL, '2022-10-10 04:27:16'),
(20, 22, 'Hi renfred', NULL, '2022-10-10 04:32:14'),
(20, 22, 'hi dito', NULL, '2022-10-10 04:33:02'),
(23, 22, 'hi laura', NULL, '2022-10-10 04:34:01'),
(23, 22, 'coba belajar java', NULL, '2022-10-10 04:38:03'),
(20, 22, 'Lu gak belajar kan?', NULL, '2022-10-10 04:43:45'),
(24, 22, 'Keren Hamdan', NULL, '2022-10-10 04:44:45'),
(2, 22, 'boong', NULL, '2022-10-10 04:46:49'),
(1, 20, 'konten yg menarik', NULL, '2022-10-10 04:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `id_user` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `date_follow` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`id_user`, `id_follower`, `date_follow`) VALUES
(5, 7, '2022-10-06'),
(5, 8, '2022-10-06'),
(5, 9, '2022-10-06'),
(5, 10, '2022-10-06'),
(5, 17, '2022-10-06'),
(5, 18, '2022-10-06'),
(5, 19, '2022-10-06'),
(5, 20, '2022-10-06'),
(5, 21, '2022-10-06'),
(5, 22, '2022-10-06'),
(5, 23, '2022-10-06'),
(9, 5, '2022-10-09'),
(9, 18, '2022-10-09'),
(9, 23, '2022-10-09'),
(17, 5, '2022-10-09'),
(17, 18, '2022-10-09'),
(17, 23, '2022-10-09'),
(19, 9, '2022-10-09'),
(19, 18, '2022-10-09'),
(19, 20, '2022-10-10'),
(19, 23, '2022-10-09'),
(23, 18, '2022-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `nama_forum` varchar(50) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `banner` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `nama_forum`, `deskripsi`, `banner`) VALUES
(1, 'Javascript', 'JavaScript is a text-based programming language used both on the client-side and server-side that allows you to make web pages interactive.', 'bann-javascript.png'),
(2, 'Php', 'PHP: Hypertext Preprocessor atau hanya PHP saja, adalah bahasa skrip dengan fungsi umum yang terutama digunakan untuk pengembangan web.', 'bann-php.png'),
(3, 'Java', 'Java is a widely used object-oriented programming language and software platform that runs on billions of devices, including notebook computers, mobile devices, gaming consoles, medical devices, and m', 'bann-java.png'),
(4, 'Golang', 'Go (also called Golang or Go language) is an open-source programming language used for general purposes. Go was developed by Google engineers to create dependable and efficient software. Most similarl', 'bann-golang.png'),
(5, 'Ruby', 'Ruby is mainly used to build web applications and is useful for other programming projects. It is widely used for building servers and data processing, web scraping, and crawling. The leading framewor', 'bann-ruby.png'),
(6, 'C++', 'C++ (or “C-plus-plus”) is a general-purpose programming and coding language. C++ is used in developing browsers, operating systems, and applications, as well as in-game programming, software engineeri', 'bann-c++.png');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id_postingan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_postingan`, `id_user`, `waktu`) VALUES
(1, 20, '2022-10-10 04:59:05'),
(1, 22, '2022-10-10 04:31:14'),
(2, 18, '2022-10-10 03:30:31'),
(2, 20, '2022-10-10 04:59:10'),
(2, 22, '2022-10-10 04:31:16'),
(3, 17, '2022-10-10 03:04:11'),
(3, 22, '2022-10-10 03:55:17'),
(8, 22, '2022-10-10 03:51:33'),
(17, 22, '2022-10-10 03:55:41'),
(18, 20, '2022-10-10 04:59:14'),
(18, 22, '2022-10-10 03:51:40'),
(19, 22, '2022-10-10 04:31:10'),
(20, 19, '2022-10-10 03:37:23'),
(20, 20, '2022-10-10 04:51:48'),
(20, 22, '2022-10-10 03:45:36'),
(20, 23, '2022-10-10 03:38:57'),
(21, 18, '2022-10-10 03:32:39'),
(21, 20, '2022-10-10 04:51:50'),
(21, 22, '2022-10-10 03:51:29'),
(21, 23, '2022-10-10 03:39:45'),
(22, 20, '2022-10-10 04:51:52'),
(23, 17, '2022-10-10 03:04:06'),
(23, 20, '2022-10-10 04:51:54'),
(24, 17, '2022-10-10 03:04:08'),
(24, 18, '2022-10-10 03:29:06'),
(25, 20, '2022-10-10 05:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_forum` int(11) DEFAULT NULL,
  `postingan_gambar` varchar(120) DEFAULT NULL,
  `postingan_text` varchar(300) DEFAULT NULL,
  `tanggal_posting` date DEFAULT NULL,
  `jml_like` int(11) DEFAULT NULL,
  `kategori` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postingan`
--

INSERT INTO `postingan` (`id`, `id_user`, `id_forum`, `postingan_gambar`, `postingan_text`, `tanggal_posting`, `jml_like`, `kategori`) VALUES
(1, 5, 1, '2.jpg', 'JavaScript adalah bahasa pemrograman tingkat tinggi dan dinamis. JavaScript populer di internet dan dapat bekerja di sebagian besar penjelajah web populer seperti Google Chrome, Internet Explorer, Mozilla Firefox, Netscape dan Opera. Kode JavaScript dapat disisipkan dalam halaman web menggunakan tag', '2022-10-03', 2, 'javascript'),
(2, 5, 1, '-1', 'Perbedaan Java dan JavaScript adalah, Java merupakan bahasa pemrograman, sedangkan JavaScript adalah skrip pemrograman. Kode JavaScript ditulis dalam teks dan bisa langsung diinterpretasikan browser, sedangkan Java harus di-compile menjadi bytecode yang bisa dipahami dan dijalankan komputer.', '2022-10-03', 3, 'javascript'),
(3, 5, 1, '-1', 'Tahukah kamu bahwa JavaScript adalah bahasa pemrograman yang digunakan dalam pengembangan website agar lebih dinamis dan interaktif. Kalau sebelumnya kamu hanya mengenal HTML dan CSS, nah sekarang kamu jadi tahu bahwa JavaScript dapat meningkatkan fungsionalitas pada halaman web.', '2022-10-08', NULL, 'javascript'),
(8, 5, 2, 'jk.png', 'PHP: Hypertext Preprocessor atau hanya PHP saja, adalah bahasa skrip dengan fungsi umum yang terutama digunakan untuk pengembangan web. Bahasa ini awalnya dibuat oleh seorang pemrogram Denmark-Kanada Rasmus Lerdorf pada tahun 1994. Implementasi referensi PHP sekarang diproduksi oleh The PHP Group.', '2022-10-08', NULL, 'php'),
(17, 5, 6, '-1', 'C++ adalah bahasa pemrograman komputer yang dibuat oleh Bjarne Stroustrup, yang merupakan perkembangan dari bahasa C dikembangkan di Bell Labs. Pada awal tahun 1970-an, bahasa itu merupakan peningkatan dari bahasa sebelumnya, yaitu B', '2022-10-08', NULL, 'c++'),
(18, 5, 4, '-1', 'Saya lagi belajar Golang saat ini ternyata susah banget', '2022-10-08', NULL, 'golang'),
(19, 5, 6, '-1', 'SELECT @@version', '2022-10-08', NULL, 'all'),
(20, 5, 2, '-1', 'Belajar PHP sangat menyenangkan saya 1 hari cuman bengong doang hadepin soal web programming yg belum selesai', '2022-10-09', 3, 'php'),
(21, 9, 3, '-1', 'Hari ini saya sedang belajar Java, OOP di java mudah melajari sangat cocok bagi orang-orang yang baru belajar OOP', '2022-10-09', NULL, 'java'),
(22, 17, 4, '-1', 'Hari ini saya belajar golang secara otodidak melaui youtube', '2022-10-09', NULL, 'golang'),
(23, 19, 1, '-1', 'Belajar javasript sangat menyenangkan', '2022-10-09', NULL, 'javascript'),
(24, 23, 1, '189a2ee543e2daa4299fdf35f43ac5069a39295539b26ad540212244cdf3aead.png', 'Hi nama saya hamdan kelas 10 SMA kali ini saya sedang memperdalam pemrograman javascript karena ketertarikan saya dengan web design.\r\n-HTML\r\n-Javascript\r\n-NodeJS', '2022-10-09', NULL, 'javascript'),
(25, 20, 1, '-1', 'Spill Chanel youtube buat belajar javascript dong', '2022-10-10', NULL, 'javascript');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usertype` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(120) NOT NULL,
  `foto_profil` varchar(120) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `usertype`, `email`, `password`, `foto_profil`, `description`) VALUES
(5, 'renfredLeeman', 'Renfred ', 'admin', 'renfred@gmail.com', '$2y$10$Hd5hVkOrQvDQ3OdywCVvzejjsYhQsa1D8htc9nJ5zRDo09LbfDV8C', '4c468b3b16999fd9578189576d5f770cb4a16ad9fca0e798a251f00a54a87c5d.jpg', 'Nama saya Renfred Leeman domisili tangerang, saya suka belajar coding sejak SMA. Kali ini saya sedang memperdalam Php,Laravel, C++, Golang, serta tailwind.'),
(7, 'dodidot', 'Dodi Kurniawan', 'user', 'dodi@gmail.com', '$2y$10$k1Oj8FUC8uwer3B/ZC1BUOS8PHpvaHJnNLKlde50vmWum9pz9fbH2', 'default-profile.png', ''),
(8, 'm4y4cynkR3H4n', 'Maya', 'user', 'maya@gmail.com', '$2y$10$aPv1mMf5W8a6dlma9BElre/UZVA5uFNiXEAjuj9ZwGoBPWtAe58JS', 'default-profile.png', ''),
(9, 'ditoAja', 'Dito', 'user', 'dito@gmail.com', '$2y$10$Jom1rI9KnZs4x57GzeRNfeZCVJmwvz0ZmUgxgTw0OwsylLFD5wnIC', 'default-profile.png', ''),
(10, 'amandacryt', 'Amanda', 'user', 'amanda@gmail.com', '$2y$10$gNTD2K1fE.bXYBvzT8o7H.QcVu.eXWSPRAmL0zrtI9xjS7ErI0b4O', 'default-profile.png', ''),
(12, 'aziz akmal', 'Aziz Akmal', 'user', 'aziz@gmail.com', '$2y$10$jZK9lPaC36f.9e8vtStrg.iwjb6XAuxebr8GuHKKHdHeB/4maRxIS', 'default-profile.png', ''),
(14, 'gio oktada', 'Giofari', 'user', 'gio@gmail.com', '$2y$10$jdKGo/pM0Sw7U5TtGSkRoulF9.q76Bwr/Dc8/B8/WBfnGoxHSVYVe', 'default-profile.png', ''),
(16, 'ahmad muad', 'ahmad', 'user', 'ahm@gmail.com', '$2y$10$K..ZNy9Rw7hhnaT949./FutG9ZQiimerv9316wRVJgJKVJjHhByca', 'default-profile.png', ''),
(17, 'agus', 'Agus', 'agus@gmail.com', 'user', '$2y$10$0WHZlDsGHnP23zMv8A8DIuy/ZafhsbHipvfn8h/D8YBus2MMNE4rC', 'c1e926a877e1df4d7129440d1946eefb91e95fbdeaf922bb6bed853203f2fdcf.jpg', ''),
(18, 'oktookto', 'okto', 'user', 'okto@gmail.com', '$2y$10$nsqQP2RbzwdPvrTRgTGZyufp/fxuFNVtr0DaYHY/IE4/zH3OGFIYm', 'default-profile.png', ''),
(19, 'lauraAja', 'Laura', 'user', 'laur@gmail.com', '$2y$10$bFbUl9mUhkYESzBsmG1Xc.8WYwLafQk71Japnyk4nghqSEJWPX.Jq', 'default-profile.png', ''),
(20, 'sudung', 'sudung', 'user', 'sud@gmail.com', '$2y$10$VJMSWkfzbdHgllkEelu9SeB2LFISn7JBUB3/Sww7/AK9Qrsqe7LbK', 'default-profile.png', ''),
(21, 'ziziziz', 'zizi', 'user', 'zizizi@gmail.com', '$2y$10$KikYr8bZWzsFPtnVfzLR2eQcjhmXFq9.eUBGcvICxsqYtRKQ5mtzi', 'default-profile.png', ''),
(22, 'lisalis', 'lisa', 'user', 'lisa@gmail.com', '$2y$10$mBNn7Ig3QfFMkcpYpY18lOYc.clIJhkhSKvrLf1iE7/vqH418cWYS', 'default-profile.png', ''),
(23, 'hamdan', 'hamdan', 'user', 'hamdan@gmail.com', '$2y$10$TpYcF/iQO27tt/rnjv3Fg.tMhcSYYU2ckL/i8PEy66xEzXVyvJ9Nu', 'default-profile.png', ''),
(35, 'jasonst', 'Jason S', 'user', 'jason@gmail.com', '$2y$10$JrP6OdfCUygGSMUs71ctQuC6nnGLecpv.BxDjkOiCLvQubRny9si.', 'default-profile.png', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD KEY `id_postingan` (`id_postingan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`id_user`,`id_follower`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_follower` (`id_follower`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_forum` (`nama_forum`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_postingan`,`id_user`),
  ADD UNIQUE KEY `id_postingan_2` (`id_postingan`,`id_user`),
  ADD KEY `id_postingan` (`id_postingan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_forum` (`id_forum`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD UNIQUE KEY `username_3` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_postingan`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`id_follower`) REFERENCES `user` (`id`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_postingan`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `postingan_ibfk_2` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
