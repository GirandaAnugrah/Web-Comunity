-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Okt 2022 pada 08.56
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-uts`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_postingan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `jml_like` int(11) DEFAULT NULL,
  `tanggal_comment` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id`, `id_postingan`, `id_user`, `comment`, `jml_like`, `tanggal_comment`) VALUES
(3, 2, 5, 'sangat bermanfaat', NULL, '2022-10-08 00:00:00'),
(5, 24, 23, 'Keren Banget Hamdan', NULL, '2022-10-09 00:00:00'),
(15, 24, 5, 'Belajar lagi yang giat', NULL, '2022-10-10 00:00:00'),
(17, 17, 5, 'konten yang bermanfaat', NULL, '2022-10-10 00:00:00'),
(18, 2, 5, 'hmmm masa sihhh', NULL, '2022-10-10 00:00:00'),
(22, 20, 5, 'bootcamp aja biar ada mentornya', NULL, '2022-10-10 00:00:00'),
(28, 24, 5, 'Keren Hamdan', NULL, '2022-10-10 00:00:00'),
(33, 24, 17, 'NOde Js Susah sih', NULL, '2022-10-10 00:00:00'),
(34, 8, 17, 'Postingan yg sangat bermanfaat bagi kesehatan', NULL, '2022-10-10 01:46:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `commentlike`
--

CREATE TABLE `commentlike` (
  `id_comment` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `commentlike`
--

INSERT INTO `commentlike` (`id_comment`, `id_user`) VALUES
(5, 35),
(15, 35),
(28, 35),
(3, 35),
(1, 35),
(2, 35),
(33, 35),
(11, 35),
(22, 37),
(40, 37),
(8, 37),
(22, 37),
(40, 37),
(35, 5),
(34, 5),
(23, 5),
(10, 5),
(14, 5),
(22, 5),
(40, 5),
(1, 37),
(2, 37),
(11, 37),
(1, 37),
(1, 37),
(10, 37),
(14, 37),
(23, 37),
(34, 37),
(10, 35),
(23, 35),
(34, 35),
(22, 35),
(17, 35),
(34, 17),
(66, 17),
(68, 17),
(18, 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `follower`
--

CREATE TABLE `follower` (
  `id_user` int(11) DEFAULT NULL,
  `id_follower` int(11) DEFAULT NULL,
  `date_follow` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `follower`
--

INSERT INTO `follower` (`id_user`, `id_follower`, `date_follow`) VALUES
(5, 10, '2022-10-06'),
(5, 7, '2022-10-06'),
(5, 8, '2022-10-06'),
(5, 17, '2022-10-06'),
(5, 23, '2022-10-06'),
(5, 20, '2022-10-06'),
(17, 5, '2022-10-09'),
(17, 23, '2022-10-09'),
(5, 35, '2022-10-13'),
(17, 35, '2022-10-14'),
(23, 35, '2022-10-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum`
--

CREATE TABLE `forum` (
  `id` int(11) NOT NULL,
  `nama_forum` varchar(50) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `banner` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `forum`
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
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id_postingan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`id_postingan`, `id_user`, `waktu`) VALUES
(20, 17, '2022-10-10 02:59:34'),
(20, 17, '2022-10-10 02:59:38'),
(20, 17, '2022-10-10 03:00:02'),
(20, 17, '2022-10-10 03:00:38'),
(20, 17, '2022-10-10 03:01:08'),
(20, 17, '2022-10-10 03:02:25'),
(20, 17, '2022-10-10 03:02:53'),
(20, 17, '2022-10-10 03:03:57'),
(24, 17, '2022-10-10 03:04:08'),
(24, 18, '2022-10-10 03:29:06'),
(20, 18, '2022-10-10 03:32:37'),
(20, 18, '2022-10-10 03:33:13'),
(20, 18, '2022-10-10 03:33:14'),
(20, 23, '2022-10-10 03:38:57'),
(8, 23, '2022-10-10 03:39:48'),
(8, 23, '2022-10-10 03:39:50'),
(8, 23, '2022-10-10 03:39:51'),
(8, 17, NULL),
(30, 5, NULL),
(24, 35, NULL),
(8, 35, NULL),
(17, 35, NULL),
(20, 37, NULL),
(24, 37, NULL),
(8, 37, NULL),
(17, 37, NULL),
(24, 5, NULL),
(8, 5, NULL),
(17, 5, NULL),
(20, 5, NULL),
(20, 35, NULL),
(2, 35, NULL),
(60, 17, NULL),
(2, 17, NULL),
(17, 17, NULL),
(60, 35, NULL),
(62, 35, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `postingan`
--

CREATE TABLE `postingan` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_forum` int(11) DEFAULT NULL,
  `postingan_gambar` varchar(120) DEFAULT NULL,
  `postingan_text` varchar(300) DEFAULT NULL,
  `tanggal_posting` datetime DEFAULT NULL,
  `jml_like` int(11) DEFAULT NULL,
  `kategori` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `postingan`
--

INSERT INTO `postingan` (`id`, `id_user`, `id_forum`, `postingan_gambar`, `postingan_text`, `tanggal_posting`, `jml_like`, `kategori`) VALUES
(2, 5, 1, '-1', 'Perbedaan Java dan JavaScript adalah, Java merupakan bahasa pemrograman, sedangkan JavaScript adalah skrip pemrograman. Kode JavaScript ditulis dalam teks dan bisa langsung diinterpretasikan browser, sedangkan Java harus di-compile menjadi bytecode yang bisa dipahami dan dijalankan komputer.', '2022-10-03 00:00:00', 3, 'javascript'),
(8, 5, 2, 'jk.png', 'PHP: Hypertext Preprocessor atau hanya PHP saja, adalah bahasa skrip dengan fungsi umum yang terutama digunakan untuk pengembangan web. Bahasa ini awalnya dibuat oleh seorang pemrogram Denmark-Kanada Rasmus Lerdorf pada tahun 1994. Implementasi referensi PHP sekarang diproduksi oleh The PHP Group.', '2022-10-08 00:00:00', NULL, 'php'),
(17, 5, 6, '-1', 'C++ adalah bahasa pemrograman komputer yang dibuat oleh Bjarne Stroustrup, yang merupakan perkembangan dari bahasa C dikembangkan di Bell Labs. Pada awal tahun 1970-an, bahasa itu merupakan peningkatan dari bahasa sebelumnya, yaitu B', '2022-10-08 00:00:00', NULL, 'c++'),
(20, 5, 2, '-1', 'Belajar PHP sangat menyenangkan saya 1 hari cuman bengong doang hadepin soal web programming yg belum selesai', '2022-10-09 00:00:00', NULL, 'php'),
(24, 23, 1, '189a2ee543e2daa4299fdf35f43ac5069a39295539b26ad540212244cdf3aead.png', 'Hi nama saya hamdan kelas 10 SMA kali ini saya sedang memperdalam pemrograman javascript karena ketertarikan saya dengan web design.\r\n-HTML\r\n-Javascript\r\n-NodeJS', '2022-10-09 00:00:00', NULL, 'javascript'),
(60, 17, 2, '-1', 'rekomendasi bootcamp murahh dong buat belajar PHP', '2022-10-14 06:10:29', NULL, 'php'),
(62, 35, 4, '-1', 'Hari ini saya Belajar Golang', '2022-10-14 07:34:29', NULL, 'golang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `usertype` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(120) NOT NULL,
  `foto_profil` varchar(120) NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `tmp_bann` datetime DEFAULT NULL,
  `code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `nama`, `usertype`, `email`, `password`, `foto_profil`, `description`, `status`, `tmp_bann`, `code`) VALUES
(5, 'renfredLeeman', 'Renfred ', 'admin', 'jontor.hebat@gmail.com', '$2y$10$Hd5hVkOrQvDQ3OdywCVvzejjsYhQsa1D8htc9nJ5zRDo09LbfDV8C', '4c468b3b16999fd9578189576d5f770cb4a16ad9fca0e798a251f00a54a87c5d.jpg', 'Nama saya Renfred Leeman domisili tangerang, saya suka belajar coding sejak SMA. Kali ini saya sedang memperdalam Php,Laravel, C++, Golang, serta tailwind.', NULL, NULL, NULL),
(7, 'dodidot', 'Dodi Kurniawan', 'user', 'dodi@gmail.com', '$2y$10$k1Oj8FUC8uwer3B/ZC1BUOS8PHpvaHJnNLKlde50vmWum9pz9fbH2', 'default-profile.png', '', NULL, NULL, NULL),
(8, 'm4y4cynkR3H4n', 'Maya', 'user', 'maya@gmail.com', '$2y$10$aPv1mMf5W8a6dlma9BElre/UZVA5uFNiXEAjuj9ZwGoBPWtAe58JS', 'default-profile.png', '', NULL, NULL, NULL),
(10, 'amandacryt', 'Amanda', 'user', 'amanda@gmail.com', '$2y$10$gNTD2K1fE.bXYBvzT8o7H.QcVu.eXWSPRAmL0zrtI9xjS7ErI0b4O', 'default-profile.png', '', NULL, NULL, NULL),
(17, 'agusta', 'Agus', 'agus@gmail.com', 'agus@hmail.com', '$2y$10$0WHZlDsGHnP23zMv8A8DIuy/ZafhsbHipvfn8h/D8YBus2MMNE4rC', 'c1e926a877e1df4d7129440d1946eefb91e95fbdeaf922bb6bed853203f2fdcf.jpg', 'Saya mahasiswa UMN', NULL, NULL, NULL),
(19, 'lauraAja', 'Laura', 'user', 'laur@gmail.com', '$2y$10$bFbUl9mUhkYESzBsmG1Xc.8WYwLafQk71Japnyk4nghqSEJWPX.Jq', 'default-profile.png', '', NULL, NULL, NULL),
(20, 'sudung', 'sudung', 'user', 'sud@gmail.com', '$2y$10$VJMSWkfzbdHgllkEelu9SeB2LFISn7JBUB3/Sww7/AK9Qrsqe7LbK', 'default-profile.png', '', NULL, NULL, NULL),
(23, 'hamdan', 'hamdan', 'user', 'hamdan@gmail.com', '$2y$10$TpYcF/iQO27tt/rnjv3Fg.tMhcSYYU2ckL/i8PEy66xEzXVyvJ9Nu', 'default-profile.png', '', NULL, NULL, NULL),
(35, 'girandaAnugrah', 'Giranda Anugrah Aja', 'admin', 'giranda19okt2003@gmail.com', '$2y$10$9UoxamgwC4mlv5Uv6I19s.W9FL2hlwQXvWV1kagQfrX3oEaYuFxLG', '7d2e097b26d7042e5096865127487b3daa7bc29342eb2237d03065023b125f43.png', 'Hallo nama saya Giranda Anugrah saya mahasiswa UMN angkatan 2021 &lt;h1&gt;Gasskeun&lt;/h1&gt;', NULL, NULL, 762457),
(36, 'renfredAja', 'renfred Leeman', 'user', 'renfred.leeman@student.umn.ac.id', '$2y$10$QQgXJ.xf1xO46Xh4VhRZRemG0AfYPa2RHARIqL4k.bI8bH5TWAkVu', 'default-profile.png', '', NULL, NULL, 853746),
(37, 'girandaAbdul', 'abdul Giran', 'user', 'girandaanugrah@gmail.com', '$2y$10$F6/XmQNXQrXNsy3xvIpuzejsMqamS51pzsT9tRN/e.zsOInePrGje', 'default-profile.png', 'Hi nama saya Giranda Anugrah, saat ini sedang menempuh pendidikan di Universitas Multimedia Nusantara ', NULL, NULL, 682870);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_postingan` (`id_postingan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `commentlike`
--
ALTER TABLE `commentlike`
  ADD KEY `id_comment` (`id_comment`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `follower`
--
ALTER TABLE `follower`
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_follower` (`id_follower`);

--
-- Indeks untuk tabel `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_forum` (`nama_forum`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD KEY `id_postingan` (`id_postingan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_forum` (`id_forum`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `forum`
--
ALTER TABLE `forum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `postingan`
--
ALTER TABLE `postingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_postingan`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `commentlike`
--
ALTER TABLE `commentlike`
  ADD CONSTRAINT `commentlike_ibfk_1` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `commentlike_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `follower_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `follower_ibfk_2` FOREIGN KEY (`id_follower`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_postingan`) REFERENCES `postingan` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `postingan`
--
ALTER TABLE `postingan`
  ADD CONSTRAINT `postingan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `postingan_ibfk_2` FOREIGN KEY (`id_forum`) REFERENCES `forum` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
