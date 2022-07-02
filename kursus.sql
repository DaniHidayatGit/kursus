CREATE DATABASE kursusq;
USE kursusq;

CREATE TABLE `data_nilai` (
  `username` VARCHAR(25) DEFAULT NULL,
  `kode_mata_pelajaran` INT(11) DEFAULT NULL,
  `nama_mata_pelajaran` VARCHAR(50) DEFAULT NULL,
  `nilai` VARCHAR(3) DEFAULT NULL,
  `kode_pengajar` INT(11) NOT NULL,
  `nama_pengajar` VARCHAR(30) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `data_nilai` (`username`, `kode_mata_pelajaran`, `nama_mata_pelajaran`, `nilai`, `kode_pengajar`, `nama_pengajar`) VALUES
('danihidayat', 6, 'Bahasa Inggris Dasar I', '100', 354179, 'mita');

CREATE TABLE `data_user` (
  `username` VARCHAR(25) NOT NULL,
  `foto_profil` VARCHAR(50) DEFAULT 'undraw_rocket.svg',
  `bukti_pembayaran` VARCHAR(50) DEFAULT NULL,
  `jenis_kelamin` VARCHAR(25) DEFAULT NULL,
  `nomor_telepon` VARCHAR(25) DEFAULT NULL,
  `valid` VARCHAR(1) DEFAULT 'f',
  `masa_aktif` DATE DEFAULT NULL,
  `paket` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `data_user` (`username`, `foto_profil`, `bukti_pembayaran`, `jenis_kelamin`, `nomor_telepon`, `valid`, `masa_aktif`, `paket`) VALUES
('danihidayat', 'undraw_rocket.svg', NULL, 'laki-laki', '(+62) 822-8493-0726_', 'f', NULL, NULL);

CREATE TABLE `mata_pelajaran` (
  `kode_mata_pelajaran` INT(11) NOT NULL,
  `nama_mata_pelajaran` VARCHAR(50) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `mata_pelajaran` (`kode_mata_pelajaran`, `nama_mata_pelajaran`) VALUES
(6, 'Bahasa Inggris Dasar I'),
(7, 'Bahasa Inggris Dasar II');

CREATE TABLE `pengajar` (
  `kode_pengajar` INT(11) NOT NULL,
  `nama_pengajar` VARCHAR(30) DEFAULT NULL,
  `nik` VARCHAR(17) DEFAULT NULL,
  `alamat` VARCHAR(100) DEFAULT NULL,
  `nomor_telepon` VARCHAR(20) DEFAULT NULL,
  `jenis_kelamin` VARCHAR(15) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pengajar` (`kode_pengajar`, `nama_pengajar`, `nik`, `alamat`, `nomor_telepon`, `jenis_kelamin`) VALUES
(354179, 'mita', '1234567890123456', 'pekanbaru', '(+62) 812-3456-7890_', 'perempuan'),
(354182, 'zuriati', '1234567890123455', 'sibolga', '(+62) 812-3456-7899_', 'perempuan');

CREATE TABLE `_user` (
  `id` INT(11) NOT NULL,
  `nama_depan` VARCHAR(20) DEFAULT NULL,
  `nama_belakang` VARCHAR(20) DEFAULT NULL,
  `username` VARCHAR(25) DEFAULT NULL,
  `password` VARCHAR(25) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `level_user` VARCHAR(5) DEFAULT 'user',
  `status` VARCHAR(2) DEFAULT 't'
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4;

INSERT INTO `_user` (`id`, `nama_depan`, `nama_belakang`, `username`, `password`, `email`, `level_user`, `status`) VALUES
(2, 'admin', 'admin', 'Admin', 'Admin', 'admin@gmail.com', 'admin', 'f'),
(6, 'dani', 'hidayat', 'danihidayat', 'Dani', 'danihidayat@gmail.com', 'user', 'f');

ALTER TABLE `data_nilai`
  ADD KEY `fk_username_nilai` (`username`);

ALTER TABLE `data_user`
  ADD PRIMARY KEY (`username`);

ALTER TABLE `mata_pelajaran`
  ADD PRIMARY KEY (`kode_mata_pelajaran`);

ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`kode_pengajar`);

ALTER TABLE `_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username` (`username`);

ALTER TABLE `mata_pelajaran`
  MODIFY `kode_mata_pelajaran` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `pengajar`
  MODIFY `kode_pengajar` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462215;

ALTER TABLE `_user`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE `data_nilai`
  ADD CONSTRAINT `fk_username_nilai` FOREIGN KEY (`username`) REFERENCES `data_user` (`username`);
COMMIT;