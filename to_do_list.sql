-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2023 pada 18.25
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to_do_list`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pet`
--

CREATE TABLE `tb_pet` (
  `id` int(11) NOT NULL,
  `pet_level` int(11) NOT NULL,
  `pet_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pet`
--

INSERT INTO `tb_pet` (`id`, `pet_level`, `pet_score`) VALUES
(1, 1, 20),
(2, 2, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_priority`
--

CREATE TABLE `tb_priority` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `priority_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_reminder`
--

CREATE TABLE `tb_reminder` (
  `id` int(11) NOT NULL,
  `reminder_date` date NOT NULL,
  `reminder_time` time NOT NULL,
  `reminder_repetition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status`
--

CREATE TABLE `tb_status` (
  `id` int(11) NOT NULL,
  `status` enum('done','expired','') NOT NULL,
  `status_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_task`
--

CREATE TABLE `tb_task` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `task_date` date NOT NULL,
  `task_desc` varchar(255) NOT NULL,
  `priority_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `reminder_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `fullname`, `email`, `password`, `pet_id`) VALUES
(1, 'Della', 'Fredella', 'della@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pet`
--
ALTER TABLE `tb_pet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_priority`
--
ALTER TABLE `tb_priority`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_reminder`
--
ALTER TABLE `tb_reminder`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `reminder_id` (`reminder_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_pet`
--
ALTER TABLE `tb_pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_priority`
--
ALTER TABLE `tb_priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_reminder`
--
ALTER TABLE `tb_reminder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_status`
--
ALTER TABLE `tb_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_task`
--
ALTER TABLE `tb_task`
  ADD CONSTRAINT `tb_task_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `tb_priority` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_10` FOREIGN KEY (`status_id`) REFERENCES `tb_status` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_6` FOREIGN KEY (`reminder_id`) REFERENCES `tb_reminder` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_7` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_8` FOREIGN KEY (`category_id`) REFERENCES `tb_category` (`id`),
  ADD CONSTRAINT `tb_task_ibfk_9` FOREIGN KEY (`reminder_id`) REFERENCES `tb_reminder` (`id`);

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `tb_pet` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
