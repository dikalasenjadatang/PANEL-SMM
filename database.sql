-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Okt 2018 pada 06.41
-- Versi server: 5.7.23
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `pulsaind_o`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_game`
--

CREATE TABLE `akun_game` (
  `id` int(10) NOT NULL,
  `id_game` text COLLATE utf8_swedish_ci NOT NULL,
  `pw_game` text COLLATE utf8_swedish_ci NOT NULL,
  `akun` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `pemilik` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `hpk` bigint(20) NOT NULL,
  `ket` text CHARACTER SET latin1 NOT NULL,
  `stock` enum('ready','kosong') CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `akun_game`
--

INSERT INTO `akun_game` (`id`, `id_game`, `pw_game`, `akun`, `pemilik`, `hpk`, `ket`, `stock`) VALUES
(1, 'memek test doang', 'test memek', 'pb', 'dreamspedia', 0, '', 'kosong');

-- --------------------------------------------------------

--
-- Struktur dari tabel `balance_history`
--

CREATE TABLE `balance_history` (
  `id` int(10) NOT NULL,
  `username` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `action` enum('Add Balance','Cut Balance') COLLATE utf8_swedish_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `msg` text COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `time` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('INFO','WARNING','UPDATE') NOT NULL,
  `warna` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposits_history`
--

CREATE TABLE `deposits_history` (
  `id` int(10) NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `quantity` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `pengirim` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `get_balance` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `link_confirm` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `method` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `time` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `status` enum('Pending','Processing','Error','Success') COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `deposits_history`
--

INSERT INTO `deposits_history` (`id`, `user`, `code`, `quantity`, `pengirim`, `get_balance`, `link_confirm`, `method`, `date`, `time`, `status`) VALUES
(646, '12345', 'RP-DEPOSIT-5ZchAp', '141241', '1233214', '112992.8', '', 'Tsel-8044', '2018-05-20', '05:59:05', 'Pending'),
(645, 'ilhamgans', 'RP-DEPOSIT-fgAViH', '5000', '082232019310', '4000', '', 'Tsel-8044', '2018-05-19', '07:07:20', 'Error'),
(647, 'dino', 'RP-DEPOSIT-681b06', '50000', '082223862188', '40000', '', 'Tsel-8044', '2018-05-29', '04:51:46', 'Pending'),
(648, 'Kontol', 'RP-DEPOSIT-OYsRs7', '10000', '02020020', '8000', 'http://link', 'Tsel-8044', '2018-05-29', '10:06:10', 'Error'),
(649, 'teguh42', 'RP-DEPOSIT-1FsesV', '5000', '085334669520', '4000', 'https://postimg.cc/image/inm6riijf/', 'Tsel-8044', '2018-05-30', '05:59:05', 'Processing'),
(650, 'faiq69', 'RP-DEPOSIT-NtYRHC', '10000', 'https://web.facebook.com/photo.php?fbid=9278350607', '8000', '', 'Tsel-8044', '2018-05-30', '15:42:50', 'Error'),
(651, '23tutupbotolll', 'RP-DEPOSIT-T47mfW', '20000', '0899999', '16000', '', 'Tsel-8044', '2018-05-30', '18:54:29', 'Pending'),
(652, 'wahyu', 'RP-DEPOSIT-bbu84v', '1000000', '261356532', '90', '', 'BRI', '2018-05-30', '21:38:35', 'Pending'),
(653, 'Rizalichwan', 'RP-DEPOSIT-sg5zm8', '100000', '', '90000', '', 'BRI', '2018-05-31', '10:49:32', 'Pending'),
(654, 'developer', 'RP-DEPOSIT-TWXvTT', '656664', 'Hhsus', '545031.12', '', 'Tsel-8044', '2018-06-01', '13:10:47', 'Error'),
(655, 'rendi', 'RP-DEPOSIT-YxtIpC', '10000', 'Rt', '10000', '', 'BRI', '2018-06-05', '09:09:56', 'Pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deposits_method`
--

CREATE TABLE `deposits_method` (
  `id` int(10) NOT NULL,
  `tipe` enum('Bank','Pulsa') COLLATE utf8_swedish_ci NOT NULL,
  `method` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `rate` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `note` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `deposits_method`
--

INSERT INTO `deposits_method` (`id`, `tipe`, `method`, `rate`, `note`) VALUES
(3, 'Pulsa', 'Tsel-1', '0.80', '085264520165'),
(542, 'Bank', 'BRI', '1.0', '754201004833531'),
(2, 'Pulsa', 'BANK BRI', '1.0', 'BRI 551001005723534');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_topup`
--

CREATE TABLE `history_topup` (
  `id` int(11) NOT NULL,
  `provider` enum('XL','TSEL') CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `jumlah_transfer` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `no_pengirim` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` enum('NO','YES','CANCEL') CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `type` enum('WEB','API','REG') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `history_topup`
--

INSERT INTO `history_topup` (`id`, `provider`, `amount`, `jumlah_transfer`, `username`, `no_pengirim`, `date`, `time`, `status`, `type`) VALUES
(320, 'TSEL', '10000', '10000', 'andinas', '6282198473982', '2018-10-05', '11:50:41', 'YES', 'WEB'),
(314, 'TSEL', '5000', '5000', 'DEVELOVER', '62884848888', '2018-10-04', '21:38:37', 'NO', 'WEB'),
(324, 'TSEL', '40000', '40000', 'Crew1', '6282113994217', '2018-10-06', '22:41:21', 'YES', 'WEB'),
(322, 'TSEL', '8643894', '8643894', 'demo', '6282938283929293', '2018-10-06', '20:48:00', 'NO', 'WEB'),
(323, 'TSEL', '10000', '10000', 'Crew1', '6282113994217', '2018-10-06', '21:32:59', 'YES', 'WEB'),
(326, 'TSEL', '30000', '30000', 'Crew1', '6282113994217', '2018-10-07', '08:36:51', 'YES', 'WEB'),
(331, 'TSEL', '30000', '30000', 'Diditagen', '6282120017213', '2018-10-27', '20:31:12', 'NO', 'WEB');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invitecode`
--

CREATE TABLE `invitecode` (
  `id` int(100) DEFAULT NULL,
  `code` int(50) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `status` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `invitecode`
--

INSERT INTO `invitecode` (`id`, `code`, `jumlah`, `status`) VALUES
(3189863, 0, 1, 0),
(2264115, 0, 1, 0),
(938879, 0, 1, 0),
(9252505, 0, 1, 0),
(780426, 0, 1, 0),
(2045987, 0, 1, 0),
(2489680, 0, 1, 0),
(8298200, 0, 1, 0),
(6863188, 0, 1, 0),
(7393783, 0, 1, 0),
(2431933, 0, 1, 0),
(3246523, 0, 1, 0),
(9865610, 0, 1, 0),
(8830498, 0, 1, 0),
(2974043, 0, 1, 0),
(3145734, 0, 1, 0),
(4638706, 0, 1, 0),
(2859884, 0, 1, 0),
(8501189, 0, 1, 0),
(2597552, 0, 1, 0),
(5566307, 0, 1, 0),
(8946122, 0, 1, 0),
(6157300, 0, 1, 0),
(9721169, 0, 1, 0),
(8025106, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` int(10) NOT NULL,
  `date` date NOT NULL,
  `content` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `news`
--

INSERT INTO `news` (`id`, `date`, `content`) VALUES
(10, '2018-10-05', 'Followers fast hari ini ; instagram followers-27\r\nTop up via pulsa no rate !'),
(11, '2018-10-05', 'Founder & ceo hanya \r\n1. Nyobez -( dirhank jr. )\r\n2. Ruby Nur cahyo\r\nTop up manual bisa hubungi kami lewat ticket suport atau facebook :D'),
(12, '2018-10-06', 'FITUR PULSA AKAN SEGERA AKTIF GUYS ðŸ˜‹ Rajin top up akan dapat bonus mingguan mulai 50k sampai 300k loh'),
(13, '2018-10-06', 'Fitur pulsa sudah fix 100% dan harga sangat murah :D dan sudah bisa transaksi\r\nVia api ya guys \r\nTop up via pulsa no rate\r\nTop up via bank bonus 5%');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `poid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `link` text COLLATE utf8_swedish_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `remains` int(10) NOT NULL,
  `start_count` int(10) NOT NULL,
  `price` double NOT NULL,
  `status` enum('Pending','Processing','Error','Partial','Success','Completed','Canceled') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `provider` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `place_from` enum('WEB','API') COLLATE utf8_swedish_ci NOT NULL,
  `refund` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `oid`, `poid`, `user`, `service`, `link`, `quantity`, `remains`, `start_count`, `price`, `status`, `date`, `provider`, `place_from`, `refund`) VALUES
(213, '3829515', '7852', 'nyobezz', 'Instagram Likes S-7 [Likes Instagram] [URL]', 'ceksss', 50, 0, 0, 130, 'Error', '2018-10-05', 'SMP', 'WEB', 0),
(214, '9733158', '7853', 'ruby', 'Instagram Followers S-44', 'rizki_market', 100, 0, 2079, 875, 'Success', '2018-10-05', 'SMP', 'WEB', 0),
(215, '8491135', '7854', 'nyobezz', 'Instagram Followers S-52', 'investasi_syariah_rakyat', 110, 1, 719, 1155, 'Partial', '2018-10-05', 'SMP', 'WEB', 0),
(216, '2644602', '7904', 'andinas', 'Instagram Followers Indonesia Aktif Sulawesi', 'Daeng_nass', 50, 0, 597, 2107.5, 'Success', '2018-10-06', 'SMP', 'WEB', 0),
(217, '9797483', '7907', 'andinas', 'Instagram Followers Indonesia   Aktif [BONUS++] [INSTAN]', 'Daeng_nass', 180, 0, 0, 7587, '', '2018-10-07', 'SMP', 'WEB', 0),
(218, '6312212', '', 'ruby', 'Instagram Followers S-45', 'rizki_market', 200, 0, 0, 1750, 'Pending', '2018-10-24', 'SMP', 'WEB', 0),
(219, '1750087', '', 'Diditagen', 'Instagram Followers Indonesia   Aktif [BONUS++] [INSTAN]', 'didit_purnama13', 100, 0, 0, 4215, 'Pending', '2018-10-24', 'SMP', 'WEB', 0),
(220, '4029840', '', 'Diditagen', 'Instagram Followers Indonesia   Aktif [BONUS++] [INSTAN]', 'https://www.instagram.com/didit_purnama13/', 100, 0, 0, 4215, 'Pending', '2018-10-24', 'SMP', 'WEB', 0),
(221, '5422460', '', 'yugha2', 'Youtube Subscribers [50K] [REFILL ] 30 Hari', 'https://www.youtube.com/channel/UCx7DGKfR-H5ingYT2AVq-Jg?view_as=subscriber', 25, 0, 0, 1350, 'Success', '2018-10-24', 'SMP', 'WEB', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_diamond`
--

CREATE TABLE `orders_diamond` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `service` varchar(100) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `zoneid` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `status` enum('Pending','Processing','Error','Success') NOT NULL,
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders_diamond`
--

INSERT INTO `orders_diamond` (`id`, `oid`, `user`, `service`, `userid`, `zoneid`, `price`, `status`, `date`) VALUES
(1, '', 'ilham', 'ML001 - 11 DIAMONDS - RP 3000', '4201566', '2004', 3000, 'Success', '2018-01-21'),
(2, '', 'ilham', 'ML001 - 11 DIAMONDS - RP 3000', '130928991', '2664', 3000, 'Success', '2018-01-21'),
(0, '', 'developer', 'ML001 - 11 DIAMONDS - RP 4000', '202882037', '9043', 4000, 'Success', '2018-05-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_line`
--

CREATE TABLE `orders_line` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `note` text COLLATE utf8_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `status` enum('Pending','Processing','Error','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `place_from` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'WEB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders_pulsa`
--

CREATE TABLE `orders_pulsa` (
  `id` int(10) NOT NULL,
  `oid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `status` enum('Pending','Processing','Error','Success') COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `place_from` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT 'WEB',
  `refund` int(1) NOT NULL DEFAULT '0',
  `sn` varchar(1000) COLLATE utf8_swedish_ci NOT NULL,
  `pid` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `orders_pulsa`
--

INSERT INTO `orders_pulsa` (`id`, `oid`, `user`, `service`, `phone`, `price`, `status`, `date`, `place_from`, `refund`, `sn`, `pid`) VALUES
(1, '86188', 'ruby', 'TELKOMSEL 1000', '085298144789', 3675, 'Success', '2018-10-06', 'WEB', 0, '', '242998845'),
(2, '40448', 'ruby', 'TELKOMSEL 1000', '085298144789', 3675, 'Success', '2018-10-06', 'WEB', 0, '', '669445050'),
(3, '59276', 'ruby', 'THREE 5000', '0895332415774', 7599, 'Success', '2018-10-06', 'WEB', 0, '', '640018607'),
(4, '38600', 'Crew1', 'THREE 2000', '089659439032', 4487, 'Success', '2018-10-06', 'WEB', 0, '', '844380298'),
(5, '36934', 'Crew1', 'AXIS 30000', '083833585659', 31888, 'Success', '2018-10-07', 'WEB', 0, '', '562219434'),
(6, '94089', 'ruby', 'TELKOMSEL 1000', '085264520165', 2100, 'Success', '2018-10-25', 'WEB', 0, '', '887998410'),
(7, '51986', 'Diditagen', 'INDOSAT 5000', '6285520763188', 6975, 'Success', '2018-10-25', 'WEB', 0, '', '480786927'),
(8, '58885', 'ruby', 'TELKOMSEL 1000', '085264520165', 2100, 'Success', '2018-10-25', 'WEB', 0, '', '107408354'),
(9, '81081', 'Diditagen', 'INDOSAT 5000', '085520756536', 6975, 'Pending', '2018-10-26', 'WEB', 0, '', '54981217'),
(10, '3607', 'Diditagen', 'INDOSAT 5000', '6285872885191', 6975, 'Pending', '2018-10-28', 'WEB', 0, '', '332170925');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_history`
--

CREATE TABLE `order_history` (
  `id` int(10) NOT NULL,
  `order_id` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `poid` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `buyer` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `service` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `quantity` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `price` int(10) NOT NULL,
  `startcount` int(10) NOT NULL,
  `remains` int(10) NOT NULL,
  `status` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `status_refund` enum('NO','YES') COLLATE utf8_swedish_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `time` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `provider`
--

CREATE TABLE `provider` (
  `id` int(10) NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `provider`
--

INSERT INTO `provider` (`id`, `code`, `link`, `api_key`) VALUES
(1, 'PULSAMEDIA', 'https://pulsamedia.net/api/json.php', 'CMOq37IlTLzuhjk1xpbfAXN0F5DUZi'),
(2, 'SMP', 'SMP', 'SMP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `provider_pulsa`
--

CREATE TABLE `provider_pulsa` (
  `id` int(11) NOT NULL,
  `code` varchar(225) NOT NULL,
  `link` varchar(225) NOT NULL,
  `api_key` varchar(225) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `provider_pulsa`
--

INSERT INTO `provider_pulsa` (`id`, `code`, `link`, `api_key`) VALUES
(1, 'ATL', 'https://api.atlantic-pedia.co.id/order/pulsa', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `refferal`
--

CREATE TABLE `refferal` (
  `id` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `kode` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `refferal`
--

INSERT INTO `refferal` (`id`, `username`, `kode`) VALUES
(1, 'admin', 'Q4P4sru2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `sid` int(10) NOT NULL,
  `category` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `service` text COLLATE utf8_swedish_ci NOT NULL,
  `note` text COLLATE utf8_swedish_ci NOT NULL,
  `min` int(10) NOT NULL,
  `max` int(10) NOT NULL,
  `price` int(11) NOT NULL,
  `status` enum('Active','Not active') COLLATE utf8_swedish_ci NOT NULL,
  `pid` int(10) NOT NULL,
  `provider` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `refund` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `sid`, `category`, `service`, `note`, `min`, `max`, `price`, `status`, `pid`, `provider`, `refund`) VALUES
(1, 1, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia   Aktif [BONUS++] [INSTAN]', 'REAL INDO , INPUT USERNAME ONLY JANGAN PAKE LINK , PROSES 0-10 JAM', 100, 2000, 42150, 'Active', 1, 'SMP', 1),
(2, 2, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-52', '1 new', 100, 5000, 10500, 'Active', 2, 'SMP', 1),
(3, 3, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-57', '- 0 - 30 mins Start- Speed 5K- No refill - No refund', 300, 15000, 10650, 'Active', 3, 'SMP', 1),
(4, 4, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-67', 'SUPER INSTANT', 200, 10000, 13000, 'Active', 4, 'SMP', 1),
(5, 5, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-73', 'Username OnlyNo Refill / No Refund0-1 Hour Start!Super Instant DeliveryMinimum 100', 200, 5000, 12750, 'Active', 5, 'SMP', 1),
(6, 6, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-12 [Guaranteed]', '[MAKS.25K] - [HQ] - [30 Days Refill]', 100, 5000, 20550, 'Active', 6, 'SMP', 1),
(7, 7, 'Instagram Likes', 'Instagram Likes S-16 [Likes Instagram] [URL]', 'New &amp;amp; INSTANT', 100, 5000, 3400, 'Active', 7, 'SMP', 1),
(8, 8, 'Instagram Likes', 'Instagram Likes S-17 [Likes Instagram] [URL]', '[5K] [INSTANT]', 100, 5000, 3950, 'Active', 8, 'SMP', 1),
(9, 9, 'Instagram Likes', 'Instagram Likes S-19 [Likes Instagram] [URL]', 'Ã¢Å¡Â¡Ã¯Â¸Â SUPER INSTANT Ã¢Å¡Â¡Ã¯Â¸Â Instagram Likes [9K] [INSTANT] [MIN 100]', 100, 9000, 4150, 'Active', 9, 'SMP', 1),
(10, 10, 'Instagram Views', 'Instagram Views   1 [999K] [REAL - INSTANT]', '[*Link Only], REAL Online, Super FAST', 100, 999000, 2849, 'Active', 10, 'SMP', 1),
(11, 11, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto View', 'USERNAME ONLY (Normal Speed)', 20, 1000000, 4150, 'Active', 11, 'SMP', 1),
(12, 12, 'Youtube Likes / Comments / Favs...', 'Youtube Shares', '(INSTANT - 1500 / Day Speed)', 500, 150000, 37150, 'Active', 12, 'SMP', 1),
(13, 13, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-17 [Guaranteed]', '[MAKS.50K] - [HQ] - [30 Days Refill]', 100, 7000, 22650, 'Active', 13, 'SMP', 1),
(14, 14, 'SoundCloud', 'SoundCloud Followers R1', '[FAST]', 20, 1000000, 36150, 'Active', 14, 'SMP', 1),
(15, 15, 'SoundCloud', 'SoundCloud Likes R1', '[FAST]', 20, 1000000, 29150, 'Active', 15, 'SMP', 1),
(16, 16, 'SoundCloud', 'SoundCloud Plays', '(SUPER FAST) (S1) [MULTIPLE OF 100] 	Quantity = MULTIPLE OF 100 ONLY !', 20, 10000000, 3650, 'Active', 16, 'SMP', 1),
(17, 17, 'Pinterest', 'Pinterest Followers', '(UNLIMITED) [INSTANT]', 20, 1000000000, 44150, 'Active', 17, 'SMP', 1),
(18, 18, 'Pinterest', 'Pinterest Pin Likes', '(UNLIMITED) [INSTANT]', 200, 1000000, 44150, 'Active', 18, 'SMP', 1),
(19, 19, 'Pinterest', 'Pinterest RePins', '(UNLIMITED) [INSTANT]', 20, 1000000, 44150, 'Active', 19, 'SMP', 1),
(20, 20, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-22 [Guaranteed]', '[20K] - [INSTANT] - [NON DROP] - [60 DAYS REFILL]', 50, 20000, 36650, 'Active', 20, 'SMP', 1),
(21, 21, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-49', '(USERNAME ONLY) [10K] (NO REFILL NO REFUND)', 100, 6000, 9150, 'Active', 21, 'SMP', 1),
(22, 22, 'Instagram Likes', 'Instagram Likes S-22 [Likes Instagram] [URL]', '[50K] [REAL - INSTANT]', 20, 50000, 5150, 'Active', 22, 'SMP', 1),
(23, 23, 'Instagram Likes', 'Instagram Likes S-18 [Likes Instagram] [URL]', '[*Link Only], REAL HQ, Super FAST', 100, 15000, 3950, 'Active', 23, 'SMP', 1),
(24, 24, 'Instagram Likes', 'Instagram Likes S-20 [Likes Instagram] [URL]', '[*Link Only], REAL Online, Super FAST', 20, 60000, 4150, 'Active', 24, 'SMP', 1),
(25, 25, 'Youtube Likes / Comments / Favs...', 'Youtube Shares [ New &amp;amp; Best Server ]', '(INSTANT - 1500 / Day Speed)', 1000, 150000, 38150, 'Active', 25, 'SMP', 1),
(26, 26, 'Telegram', 'Telegram Channel Members', 'MAX 25K', 100, 25000, 107150, 'Active', 26, 'SMP', 1),
(27, 27, 'Telegram', 'Telegram Post Views', '[ Last 5 post ]', 100, 5000, 107150, 'Active', 27, 'SMP', 1),
(28, 28, 'Google', 'Google Followers', 'USERNAME OR LINK', 100, 7000, 114150, 'Active', 28, 'SMP', 1),
(29, 29, 'Google', 'Google Website +1', 'LINK', 50, 5000, 262150, 'Active', 29, 'SMP', 1),
(30, 30, 'Google', 'Google Post +1', 'LINK', 20, 2000, 127150, 'Active', 30, 'SMP', 1),
(31, 31, 'Google', 'Google Reshares', 'Google Reshares', 20, 2000, 137150, 'Active', 31, 'SMP', 1),
(32, 32, 'Instagram Auto Likes', '80 Auto Likes + Views - 7 Days', 'Please Enter Your IG Username Only !', 1, 1, 35002150, 'Active', 32, 'SMP', 1),
(33, 33, 'Instagram Auto Likes', '150 Auto Likes + Views - 7 Days', 'USERNAME', 1, 1, 70002150, 'Active', 33, 'SMP', 1),
(34, 34, 'Instagram Auto Likes', '300 Auto Likes + Views - 7 Days', 'USENAME', 1, 1, 105002150, 'Active', 34, 'SMP', 1),
(35, 35, 'Instagram Auto Likes', '600 Auto Likes + Views - 7 Days', 'USERNAME', 1, 1, 175002150, 'Active', 35, 'SMP', 1),
(36, 36, 'Instagram Auto Likes', '1500 Auto Likes + Views - 7 Days', 'USERNAME', 1, 1, 314002150, 'Active', 36, 'SMP', 1),
(37, 37, 'Instagram Auto Likes', '80 Auto Likes + Views - 30 Days', 'USERNAME', 1, 1, 140002150, 'Active', 37, 'SMP', 1),
(38, 38, 'Instagram Auto Likes', '150 Auto Likes + Views - 30 Days', 'USERNAME', 1, 1, 228002150, 'Active', 38, 'SMP', 1),
(39, 39, 'Instagram Views', 'Instagram Views  [300k Per Day]', '[300k Per Day] - [INSTANT] - [Super FAST]', 100, 999000, 4050, 'Active', 39, 'SMP', 1),
(40, 40, 'Instagram Auto Likes', '300 Auto Likes + Views - 30 Days', 'USERNAME', 1, 1, 314002150, 'Active', 40, 'SMP', 1),
(41, 41, 'Instagram Auto Likes', '600 Auto Likes + Views - 30 Days', 'USERNAME', 1, 1, 490002150, 'Active', 41, 'SMP', 1),
(42, 42, 'Instagram Auto Likes', '1500 Auto Likes + Views - 30 Days', 'USERNAME', 1, 1, 820002150, 'Active', 42, 'SMP', 1),
(43, 43, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-23 [Guaranteed]', '[20K] [ARAB - IRAN - INSTANT] [NON DROP - 30 DAYS REFILL]', 50, 20000, 37150, 'Active', 43, 'SMP', 1),
(44, 44, 'Instagram Story / Impressions / Saves', 'Instagram Story Views UNLIMITED (USERNAME ONLY) (S1)', 'Instagram Story Views UNLIMITED (USERNAME ONLY) (S1)', 50, 10000000, 16150, 'Active', 44, 'SMP', 1),
(45, 45, 'Instagram Story / Impressions / Saves', 'Instagram Story Views [20k] (USERNAME ONLY) (S2)', 'Instagram Story Views [20k] (USERNAME ONLY) (S2)', 100, 20000, 22150, 'Active', 45, 'SMP', 1),
(46, 46, 'Instagram Story / Impressions / Saves', 'Instagram Impressions [20k] [INSTANT] (S1)', 'Instagram Impressions [20k] [INSTANT] (S1)', 500, 20000, 29150, 'Active', 46, 'SMP', 1),
(47, 47, 'Instagram Story / Impressions / Saves', 'Instagram Saves [UNLIMITED] [20k/Day - INSTANT]', 'Instagram Saves [UNLIMITED] [20k/Day - INSTANT]', 20, 30000, 18150, 'Active', 47, 'SMP', 1),
(48, 48, 'Instagram Likes', 'Instagram Likes S-26 [Likes Instagram] [URL]', 'Instagram Likes [70K] [BRAZIL - INSTANT]', 20, 70000, 7150, 'Active', 48, 'SMP', 1),
(49, 49, 'Instagram Likes', 'Instagram Likes S-27 [Likes Instagram] [URL]', 'Instagram Likes [35K] [RUSSIA - INSTANT - HQ]', 20, 35000, 7150, 'Active', 49, 'SMP', 1),
(50, 50, 'Instagram Likes', 'Instagram Likes S-28 [Likes Instagram] [URL]', 'Instagram Likes [3k] [JAPAN - HQ - INSTANT]', 20, 3000, 7150, 'Active', 50, 'SMP', 1),
(51, 51, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto Likes (USA - MAX 30K)', 'Instagram Auto Likes (USA - MAX 30K)', 20, 30000, 8150, 'Active', 51, 'SMP', 1),
(52, 52, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto Likes (CHINA - MAX 30K)', 'Instagram Auto Likes (CHINA - MAX 30K)', 10, 30000, 9150, 'Active', 52, 'SMP', 1),
(53, 53, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto Likes + Impressions (30k Max)', 'Instagram Auto Likes + Impressions (30k Max)', 50, 30000, 8150, 'Active', 53, 'SMP', 1),
(54, 54, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto Views (Fast Speed)', 'Instagram Auto Views (Fast Speed)', 100, 60000, 5150, 'Active', 54, 'SMP', 1),
(55, 55, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Auto Impressions (MAX UNLIMITED)', 'Instagram Auto Impressions (MAX UNLIMITED)', 20, 1000000, 49150, 'Active', 55, 'SMP', 1),
(56, 56, 'Facebook Video Views / Live Stream', 'Facebook Live Stream Views [30 Mins Watch]', 'Facebook Live Stream Views [30 Mins Watch]', 100, 1000, 322150, 'Active', 56, 'SMP', 1),
(57, 57, 'Twitter Views / Impressions / Live / Comments', 'Twitter Views (INSTANT)', 'Twitter Views (INSTANT)', 100, 1000000, 26150, 'Active', 57, 'SMP', 1),
(58, 58, 'Twitter Views / Impressions / Live / Comments', 'Twitter Impressions (INSTANT)', 'Twitter Impressions (INSTANT)', 100, 1000000, 26150, 'Active', 58, 'SMP', 1),
(59, 59, 'Twitter Poll Votes', 'Twitter Poll Votes (1k to 5k per day)', 'Twitter Poll Votes (1k to 5k per day) (&amp;quot;www....com?vote=ButtonNumber&amp;quot;)', 100, 1000000000, 46150, 'Active', 59, 'SMP', 1),
(60, 60, 'Twitter Poll Votes', 'Twitter Poll Votes (100k per day)', 'Twitter Poll Votes (100k per day) (&amp;quot;www....com?vote=ButtonNumber&amp;quot;)', 100, 1000000, 111150, 'Active', 60, 'SMP', 1),
(61, 61, 'Instagram Likes', 'Instagram Likes S-25 [Likes Instagram] [URL]', 'Instagram Likes + Impressions [30K] [REAL - INSTANT]', 100, 30000, 6550, 'Active', 61, 'SMP', 1),
(62, 62, 'Instagram Auto Likes - 7 Days Subscription', '80 Auto Likes + Views - 7 Days', '80 Auto Likes + Views - 7 Days', 1, 1, 35002150, 'Active', 62, 'SMP', 1),
(63, 63, 'Instagram Auto Likes - 7 Days Subscription', '150 Auto Likes + Views - 7 Days', '150 Auto Likes + Views - 7 Days', 1, 1, 69502150, 'Active', 63, 'SMP', 1),
(64, 64, 'Instagram Auto Likes - 7 Days Subscription', '300 Auto Likes + Views - 7 Days', 'Please Enter Your IG Username Only !', 1, 1, 103002150, 'Active', 64, 'SMP', 1),
(65, 65, 'Instagram Auto Likes - 7 Days Subscription', '1500 Auto Likes + Views - 7 Days', 'Please Enter Your IG Username Only !', 1, 1, 308002150, 'Active', 65, 'SMP', 1),
(66, 66, 'Instagram Auto Likes - 7 Days Subscription', '80 Auto Likes + Views - 30 Days', 'USERNAME ONLY', 1, 1, 128002150, 'Active', 66, 'SMP', 1),
(67, 67, 'Instagram Auto Likes - 7 Days Subscription', '150 Auto Likes + Views - 30 Days', 'USERNAME ONLY', 1, 1, 223002150, 'Active', 67, 'SMP', 1),
(68, 68, 'Instagram Auto Likes - 7 Days Subscription', '300 Auto Likes + Views - 30 Days', 'USERNAME ONLY', 1, 1, 308002150, 'Active', 68, 'SMP', 1),
(69, 69, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-53', '- 0 - 2h start- No Refill - No refund', 100, 10000, 9650, 'Active', 69, 'SMP', 1),
(70, 71, 'Instagram Likes', 'Instagram Likes S-15 [Likes Instagram] [URL]', '[ MAX 5K ] - INSTANT', 100, 7000, 2950, 'Active', 71, 'SMP', 1),
(71, 72, 'Instagram Likes', 'Instagram Likes S-7 [Likes Instagram] [URL]', 'TERMURAH DI INDONESIA-RealSuper Instant Delivery!', 50, 7000, 2600, 'Active', 72, 'SMP', 1),
(72, 77, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-68', '( Very Less Drop )', 100, 5000, 12150, 'Active', 77, 'SMP', 1),
(73, 78, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-76', '(Minimum Drop)', 100, 7000, 15850, 'Active', 78, 'SMP', 1),
(74, 79, 'Musical.ly', 'Musical.ly Followers [20K]', 'Username Only without &amp;quot; @ &amp;quot; ! 5-10k / Day Speed ! Min 20 - Max 20k Instant !', 20, 20000, 192150, 'Active', 79, 'SMP', 1),
(75, 80, 'Musical.ly', 'Musical.ly HQ Followers [15K]', 'HQ Followers Username Only without &amp;quot; @ &amp;quot; ! 5-10k / Day Speed ! Min 20 - Max 15k Instant !', 20, 15000, 252150, 'Active', 80, 'SMP', 1),
(76, 81, 'Musical.ly', 'Musical.ly Hearts [15K] Ã¢Å¡Â¡Ã¯Â¸Â?', 'Username Only without &amp;quot; @ &amp;quot; ! 5-10k / Day Speed ! Min 20 - Max 15k Instant !', 20, 15000, 192150, 'Active', 81, 'SMP', 1),
(77, 82, 'Musical.ly', 'Musical.ly HQ Hearts [15K]', 'HQ Accounts Username Only without &amp;quot; @ &amp;quot; ! 5-10k / Day Speed ! Min 20 - Max 15k Instant !', 20, 150000, 252150, 'Active', 82, 'SMP', 1),
(78, 83, 'Musical.ly', 'Musical.ly Likes [15K]', 'Input Musical.ly Link ! 5-10k / Day Speed ! Min 20 - Max 15k Instant !', 20, 15000, 192150, 'Active', 83, 'SMP', 1),
(79, 84, 'Musical.ly', 'Musical.ly HQ Likes [15K]', 'HQ Accounts ! Input Musical.ly Link ! 5-10k / Day Speed ! Min 20 - Max 15k Instant !', 20, 15000, 252150, 'Active', 84, 'SMP', 1),
(80, 85, 'Twitter Followers', 'Twitter Followers [500K] [HQ] [R30]', 'Refill (30 Days Maximum) Username Only HQ 0-1 Hour Start! 5K - 7K/Day Minimum 100', 100, 500000, 37150, 'Active', 85, 'SMP', 1),
(81, 86, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-69', '1-24 jam', 100, 30000, 12150, 'Active', 86, 'SMP', 1),
(82, 87, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-78', '[Max 7K - 1 MÃ„Â°N START Minimum Drop]', 100, 7000, 19250, 'Active', 87, 'SMP', 1),
(83, 88, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-79', '( Max 25k - UltraFast ) ( Working Less Drop )', 100, 25000, 19250, 'Active', 88, 'SMP', 1),
(84, 89, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-81', '10K PERHARI MAX 55K INSTANT', 100, 10000, 23850, 'Active', 89, 'SMP', 1),
(85, 90, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-82', '(Fast) (15 Days Refill ) | (MIN 300 - Max - 10k)', 1000, 10000, 24650, 'Active', 90, 'SMP', 1),
(86, 91, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-84', 'Real &amp;amp; Active (Fast) (Max - 25k) (30 days refill)', 100, 25000, 28150, 'Active', 91, 'SMP', 1),
(87, 92, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-83', 'Real Refill (30 Days Maximum) 0-1 start Followers', 1000, 10000, 24650, 'Active', 92, 'SMP', 1),
(88, 93, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-58', 'Waktu Mulai 5 menit sampai 6 jam Drop Followers  tidak terlalu banyak kita Privat DB', 100, 10000, 10700, 'Active', 93, 'SMP', 1),
(89, 94, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia   1 FAST', '1X24 JAM REAL indonesia PERSUBMIT 2K jangan lebih setelah 2k submit lagi', 100, 5000, 47150, 'Active', 94, 'SMP', 1),
(90, 95, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Semarang', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 37150, 'Active', 95, 'SMP', 1),
(91, 96, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Magelang', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 37150, 'Active', 96, 'SMP', 1),
(92, 97, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Sukabumi', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 37150, 'Active', 97, 'SMP', 1),
(93, 98, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Bandung', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 2000, 42150, 'Active', 98, 'SMP', 1),
(94, 99, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Bekasi', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 39150, 'Active', 99, 'SMP', 1),
(95, 100, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Bali', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 45150, 'Active', 100, 'SMP', 1),
(96, 101, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Jakarta', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 2000, 43150, 'Active', 101, 'SMP', 1),
(97, 102, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Cirebon', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 39150, 'Active', 102, 'SMP', 1),
(98, 103, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Lampung', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 41150, 'Active', 103, 'SMP', 1),
(99, 104, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Palembang', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 42150, 'Active', 104, 'SMP', 1),
(100, 105, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Aceh', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 42150, 'Active', 105, 'SMP', 1),
(101, 106, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Surabaya', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 41150, 'Active', 106, 'SMP', 1),
(102, 107, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Bogor', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 42150, 'Active', 107, 'SMP', 1),
(103, 108, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Cimahi', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 999, 41150, 'Active', 108, 'SMP', 1),
(104, 109, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Tangerang', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 42150, 'Active', 109, 'SMP', 1),
(105, 110, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Purbalingga', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 40150, 'Active', 110, 'SMP', 1),
(106, 111, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Sulawesi', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 50, 1000, 42150, 'Active', 111, 'SMP', 1),
(107, 112, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Kalimantan', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 41150, 'Active', 112, 'SMP', 1),
(108, 113, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Makasar', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 100, 1000, 43150, 'Active', 113, 'SMP', 1),
(109, 114, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Solo', '50% target 50% random ,20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM', 150, 1000, 39150, 'Active', 114, 'SMP', 1),
(110, 115, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia AKTIP SPECIAL MAX 15K FOLLOWERS INDONESIA', '20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM,PERSUBMIT 2K FOLLOWERS', 50, 5000, 49150, 'Active', 115, 'SMP', 1),
(111, 116, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-75', 'FAST ERVICE', 500, 50000, 15650, 'Active', 116, 'SMP', 1),
(112, 117, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-66', '( Min 200 | MAX 5K ) ( 0-6 hours start )', 200, 50000, 11850, 'Active', 117, 'SMP', 1),
(113, 118, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-59', '( 0-6 hours Start ) Min 500 -MAX 5K', 500, 5000, 11050, 'Active', 118, 'SMP', 1),
(114, 119, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-77', '5 Mint Delivery Max 2K - No refill, No refund', 200, 2000, 16150, 'Active', 119, 'SMP', 1),
(115, 120, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-19 [Guaranteed]', 'Real Refill (30 Days Maximum) 0-12 Hours Start! Minimum 100', 100, 10000, 24650, 'Active', 120, 'SMP', 1),
(116, 121, 'Youtube Subscribers', 'Youtube Subscribers S2 1-5 DAYS [ Real | 250-500/day 40% Drop | Max 30k ] ( NO Refill )', '[ Real | 250-500/day | 10-40% Drop | Max 30k ] ( NO Refill )', 500, 30000, 107150, 'Active', 121, 'SMP', 1),
(117, 122, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia  Laki-Laki AKTIP', 'AKURASI MENCAPAI 90% - PROSES 1X24JAM !!!', 100, 3000, 40150, 'Active', 122, 'SMP', 1),
(118, 123, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Perempuan/Wanita AKTIP', 'AKURASI MENCAPAI 90% - PROSES 1X24JAM !!!', 100, 1500, 40150, 'Active', 123, 'SMP', 1),
(119, 126, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-50', 'no refund no refill', 200, 4000, 9150, 'Active', 126, 'SMP', 1),
(120, 127, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Dani Aktif FAST [MAX 2K CHEAP IN THE MARKET]', '20% Masuk Hitungan Detik Sisa Folowers masuk paling lama 1X24 JAM, PER USERNAME MAX 2K FOLLOWERS INDONESIA', 100, 2000, 37150, 'Active', 127, 'SMP', 1),
(121, 128, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-55', '- SUPER FAST DELIVERY ( 5 - 10 Mins ) - Min 100 - Max 10K - NO REFILL - NO REFUND', 100, 5000, 10150, 'Active', 128, 'SMP', 1),
(122, 129, 'Instagram Views', 'Instagram Views Cheapest In Market Murahnya Gila [MAX10K]', '( Cheapest in the Market )', 50, 10000, 2247, 'Active', 129, 'SMP', 1),
(123, 130, 'Facebook Followers / Friends / Group Members', 'Facebook Followers (Instant) |[Max : 100k] ( 30 days Refill )', 'Facebook Followers (Instant) |[Max : 100k] ( 30 days Refill )', 50, 1000000, 43150, 'Active', 130, 'SMP', 1),
(124, 131, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-61', 'Instagram Followers Privat S1 instant Work Norefund No refill CUMA DI', 200, 4500, 11240, 'Active', 131, 'SMP', 1),
(125, 132, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-44', 'Instagram Followers Privat S1 instant Work Norefund No refill CUMA DI', 100, 4500, 8750, 'Active', 132, 'SMP', 1),
(126, 133, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-30', 'Cheapest In Market', 100, 6000, 7050, 'Active', 133, 'SMP', 1),
(127, 134, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-33', 'Complete In 6-12 Hour, Partial / Cancel issues', 100, 3000, 7250, 'Active', 134, 'SMP', 1),
(128, 135, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-48', 'MAX 5K NO REFILL NO REFUND', 200, 5000, 9000, 'Active', 135, 'SMP', 1),
(129, 136, 'Facebook Page Likes', 'Facebook Page Likes S5 [HQ] [Non Drop, 60 Days Auto Refill, Super Fast]', 'Facebook Page Likes [HQ] [Non Drop, 60 Days Auto Refill, Super Fast] - INSTANT', 100, 1000000, 47150, 'Active', 136, 'SMP', 1),
(130, 138, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-39', 'FAST DELIVERY NO REFILL NO REFUND', 100, 4000, 8250, 'Active', 138, 'SMP', 1),
(131, 139, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-6 [Guaranteed]', '- Instant - Speed 5k/Day - 30 days refill', 100, 10000, 17150, 'Active', 139, 'SMP', 1),
(132, 142, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-18 [Guaranteed]', '30 DAYS REFILL FAST', 100, 10000, 23750, 'Active', 142, 'SMP', 1),
(133, 143, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-22', 'Norefund No refill start 1 jam Harga Berbanding Lurus Dengan Kualitas', 100, 2500, 6150, 'Active', 143, 'SMP', 1),
(134, 144, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-64', '10-30 MENIT START NO REFILL NO REFUND', 200, 10000, 11750, 'Active', 144, 'SMP', 1),
(135, 145, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-65', '[ Super FAST ] - No Partial no refund no refill -  	- No Refill / No Refund - 6 Hour Start - Superfast Speed - Minimum 100', 200, 10000, 11750, 'Active', 145, 'SMP', 1),
(136, 146, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-74', '[NO REFUND NO REFILL- Max 5k ] [ 0 - 1Hrs Complete ]', 300, 5000, 13150, 'Active', 146, 'SMP', 1),
(137, 150, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-26', 'START 0-2 JAM NO REFILL NO REFUND', 100, 3000, 6450, 'Active', 150, 'SMP', 1),
(138, 151, 'Instagram Auto Comments / Impressions / Saves', 'Instagram Impressions [1M]', 'Real Instant Delivery! Minimum 100', 100, 1000000, 4250, 'Active', 151, 'SMP', 1),
(139, 152, 'Instagram Story / Impressions / Saves', 'Instagram Story Views [30K]', 'No Refill / No Refund 0-1 Hour Start! 10K/Day Minimum 50', 100, 30000, 15650, 'Active', 152, 'SMP', 1),
(140, 157, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-62', 'NO REFILL NO REFUND', 100, 10000, 11550, 'Active', 157, 'SMP', 1),
(141, 158, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-63', 'SUPER FAST NO REFILL NO REFUND', 100, 10000, 11650, 'Active', 158, 'SMP', 1),
(142, 160, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-8 [Guaranteed]', '1,5-2K/ DAYS', 100, 4000, 17350, 'Active', 160, 'SMP', 1),
(143, 161, 'Facebook Followers / Friends / Group Members', 'Facebook Followers (0-6) |[Max : 5k] ( 30 days Refill )', 'Starts in 0-6 H 30 Days refill Guarantee', 500, 5000, 23750, 'Active', 161, 'SMP', 1),
(144, 162, 'Instagram Story / Impressions / Saves', 'Instagram Last Story S1 - Only Username - No Refund', 'Instagram Last Story - Only Username - No Refund', 500, 10000, 4650, 'Active', 162, 'SMP', 1),
(145, 163, 'Instagram Story / Impressions / Saves', 'Instagram last Story - 1 Mint Delivery - Only Username - No refund', 'Instagram last Story - 1 Mint Delivery - Only Username - No refund', 400, 10000, 6750, 'Active', 163, 'SMP', 1),
(146, 164, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-51', 'No Refill / No Refund 0-1 Hour Start! Super Instant Delivery Minimum 100 Maximum = 10k Daily !', 100, 10000, 9350, 'Active', 164, 'SMP', 1),
(147, 165, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-23', '0-1 JAM START NO REFUND NO REFILL', 100, 4000, 6150, 'Active', 165, 'SMP', 1),
(148, 167, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-45', 'NO REFILL NO REFUND', 200, 10000, 8750, 'Active', 167, 'SMP', 1),
(149, 168, 'Youtube Subscribers', 'Youtube Subscribers 0-12 JAM 4K/DAYS FASTTEST AND CHEAP [7K]', 'SUBMIT SEHARI 4K', 100, 4000, 147150, 'Active', 168, 'SMP', 1),
(150, 169, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-70', 'no refund no refill', 100, 5000, 12150, 'Active', 169, 'SMP', 1),
(151, 170, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-46', 'START 0-12 JAM', 200, 10000, 8950, 'Active', 170, 'SMP', 1),
(152, 171, 'Twitter Retweets', 'Twitter Retweets [500K]', 'No Refill / No Refund 0-1 Hour Start! 1K - 5K/Day Minimum 20', 20, 500000, 66150, 'Active', 171, 'SMP', 1),
(153, 172, 'Twitter Retweets', 'witter Retweets [50M] REFILL 30 DAYS', 'Refill (30 Days Maximum) 0-1 Hour Start! Arab 1K - 5K/Day Minimum 20', 20, 5000000, 110150, 'Active', 172, 'SMP', 1),
(154, 175, 'Instagram Likes', 'Instagram Likes S-21 [Likes Instagram] [URL]', 'Real Super Instant Delivery! Minimum 100', 100, 15000, 4150, 'Active', 175, 'SMP', 1),
(155, 177, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-20 [Guaranteed]', '{30 Days Refill- 2 hour Start] MAX 10k', 100, 10000, 25150, 'Active', 177, 'SMP', 1),
(156, 178, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif Instant Cheap[2K]', 'JIKA LAMBAT LAYAAN INI MENGALAMI OVERLOAD', 50, 2000, 33150, 'Active', 178, 'SMP', 1),
(157, 179, 'Instagram Likes', 'Instagram Likes S-24 [Likes Instagram] [URL]', 'Submit jangan pake link seperti ini https://www.instagram.com/p/BkNSDjMAqi0/ Pake link  https://www.instagram.com/p/BkNSDjMAqi0/?utm_source=ig_share_sheet&amp;amp;igshid=1wodc812v31tk Cara mandapatkan link seprti ini perbarui dulu aplikasi instagram !!!!', 25, 7000, 6050, 'Active', 179, 'SMP', 1),
(158, 182, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-13', 'LOW QUALTY KADANG MASUK GK SESUAI SAMA SUBMIT KADANG DROP CEPET AKUN BOT SEMUA NO REFUND NO REFILL YA GUYS', 100, 4000, 5150, 'Active', 182, 'SMP', 1),
(159, 183, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-60', 'NO REFILL NO REFUND', 100, 10000, 11150, 'Active', 183, 'SMP', 1),
(160, 187, 'Instagram Story / Impressions / Saves', 'Instagram Last Story [MAX5K]', 'No Refill / No Refund', 100, 5000, 4150, 'Active', 187, 'SMP', 1),
(161, 189, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-71', '10 DAYS REFILL', 100, 3000, 12150, 'Active', 189, 'SMP', 1),
(162, 190, 'Instagram TV', 'Instagram TV Views [1M]', 'INTANT', 2000, 1000000000, 2750, 'Active', 190, 'SMP', 1),
(163, 191, 'Instagram TV', 'Instagram TV Views [5M]', 'INSTANT', 1000, 500000000, 2940, 'Active', 191, 'SMP', 1),
(164, 192, 'Instagram TV', 'Instagram TV Likes - Instant Start', 'INSTANT', 500, 3000, 4050, 'Active', 192, 'SMP', 1),
(165, 193, 'Facebook Followers / Friends / Group Members', 'Facebook Followers [50K] [REFILL30 DAYS]', 'For Facebook Profiles And Not Pages Real Refill (30 Days Maximum) 0-6 Hour Start! 500 - 2K/Day Minimum 100', 100, 50000, 22050, 'Active', 193, 'SMP', 1),
(166, 194, 'Facebook Followers / Friends / Group Members', 'Facebook Group Members [500K]', 'Group Must Be Public ! You Need to Accept the First 5 Members First ! No Refill / No Refund ! Min = 500 Max = 500k 0 to 12 Hours Start ! 500 to 2k / Day Speed !', 500, 500000, 23850, 'Active', 194, 'SMP', 1),
(167, 195, 'Instagram TV', 'Instagram TV Views [ULTRA FAST] ( Min 100 | Max 1 Million )', 'IGTV Random Comments ! Full TV Video Link Needed ! INSTANT Start ! Min = 100! Example URL- https://www.instagram.com/tv/BkSp-6VF5fg/', 100, 100000000, 2390, 'Active', 195, 'SMP', 1),
(168, 201, 'Instagram TV', 'IGTV Random Comments [1M]', 'IGTV Random Comments ! Full TV Video Link Needed ! INSTANT Start ! Min = 10!', 10, 10000000, 34150, 'Active', 201, 'SMP', 1),
(169, 202, 'Instagram TV', 'IGTV Random Emoji Comments [1M]', 'IGTV Random Emoji Comments ! Full TV Video Link Needed ! INSTANT Start ! Min = 10! Ã¢â„¢â€º Instagram Auto Likes', 10, 10000000, 34150, 'Active', 202, 'SMP', 1),
(170, 203, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-11 [Guaranteed]', 'INSTANT', 100, 5000, 20150, 'Active', 203, 'SMP', 1),
(171, 204, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-15 [Guaranteed]', 'INSTANT', 100, 10000, 21750, 'Active', 204, 'SMP', 1),
(172, 205, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-80', 'INSTANT', 1000, 100000, 23650, 'Active', 205, 'SMP', 1),
(173, 206, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-4 [Guaranteed]', 'Refill (10 Days Maximum) 0-24 Hours Start! 1k - 2K/Day Minimum 100 Slow proses', 100, 5000, 12950, 'Active', 206, 'SMP', 1),
(174, 207, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-5 [Guaranteed]', 'Refill (20 Days Maximum) 0-24 Hours Start! 2k - 3K/Day Minimum 100', 100, 20000, 14550, 'Active', 207, 'SMP', 1),
(175, 208, 'Instagram Views', 'Instagram Views [300K] [SUPER FAST]', 'INSTANT START ! VERY FAST ! 300K / Hour !', 100, 300000, 2050, 'Active', 208, 'SMP', 1),
(176, 209, 'Instagram Views', 'Instagram Views [3M] [SUPER FAST]', '300k to 500k Per Hour ! Very Fast ! Instant !', 100, 30000000, 2225, 'Active', 209, 'SMP', 1),
(177, 210, 'Instagram Views', 'Instagram Views + Impressions [FAST] [1M]', 'INSTANT 300K to 500K / Hour Speed ! FAST !', 100, 100000000, 2250, 'Active', 210, 'SMP', 1),
(178, 211, 'Instagram Views', 'Instagram Views + Impressions [TRENDING HITS] [1M]', 'INSTANT', 100, 10000000, 2300, 'Active', 211, 'SMP', 1),
(179, 213, 'Instagram Comments', 'Instagram Random Comments - Min 100 | Max 10K - ULTRAFAST - 1H', 'INSTANT', 100, 10000, 10350, 'Active', 213, 'SMP', 1),
(180, 214, 'Facebook Page Likes', 'Real Facebook Page Likes - [ Non drop ] [ 5k-10k/day ] [ Max - 100k ] INSTANT', 'REAL LIKES INSTANT START LIFE TIME GUARANTEED NON DROP MIN 100 MAX 100K', 100, 100000, 81150, 'Active', 214, 'SMP', 1),
(181, 215, 'Youtube Views', 'Youtube - Views SMP 4 [ 100k-300k/day ] ( AUTO REFILL ) [ Life Time Guaranteed ] INSTANT', 'Best Service! - Life Time Guaranteed - 100k-300k/day - 3-5mins Retention - Auto refill ( System Check in every 12hrs ) -&gt; Usually refill will be done within 24hrs, but we need maximum time of 96hrs. - 60-80% Retention', 1000, 10000000, 5550, 'Active', 215, 'SMP', 1),
(182, 216, 'Youtube Views', 'Youtube - Views SMP 5 [ 1M-1.5M/DAY ] ( AUTO REFILL ) [ Life Time Guaranteed ] INSTANT', '- Life Time Guaranteed - 1Million to 1.5Million Per day - Auto refill ( System Check in every 12hrs ) -&gt; Usually refill will be done within 24hrs, but we need maximum time of 96hrs. - 60-80% Retention', 5000, 1000000000, 9000, 'Active', 216, 'SMP', 1),
(183, 217, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-37', 'INSTANT-4HRS Real Followers 10,000 Per day Min 100 Max 10,000', 300, 5000, 7950, 'Active', 217, 'SMP', 1),
(184, 220, 'Facebook Page Likes', 'Facebook Page Likes (10K) 30 Days Refill', '30 Days refill Instant -3 hour Start', 100, 100000, 52150, 'Active', 220, 'SMP', 1),
(185, 224, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-32', 'Ultra Fast and Less Drop No Refill / No Refund 0-1 Hour Start! Super Instant Delivery Minimum 150', 100, 6000, 7150, 'Active', 224, 'SMP', 1),
(186, 226, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-10', 'No Refill / No Refund', 100, 6000, 5050, 'Active', 226, 'SMP', 1),
(187, 227, 'Instagram Story / Impressions / Saves', 'Instagram Story Views [5K] - All Story', 'Instagram Story Views [5K] - All Story', 100, 5000, 3450, 'Active', 227, 'SMP', 1),
(188, 228, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-36', 'NO REFIL NO REFINDD', 100, 5000, 7400, 'Active', 228, 'SMP', 1),
(189, 229, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-13 [Guaranteed]', '30 days refill', 100, 80000, 20550, 'Active', 229, 'SMP', 1),
(190, 230, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia Aktif  [FAST][4K]', 'INSTANT', 100, 4000, 34500, 'Active', 230, 'SMP', 1),
(191, 233, 'Instagram Views', 'Instagram Views MAX 1K SLOW', 'NONDROP INSTANT', 100, 1000, 2151, 'Active', 233, 'SMP', 1),
(192, 236, 'Instagram Live Video', 'Ã„Â°nstagram Live Video Max 1', 'Ã„Â°nstagram Live Video Max 1', 100, 1000, 18850, 'Active', 236, 'SMP', 1),
(193, 237, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-10 [Guaranteed]', 'daily speed 7-10K Refill - Within 24-48 hours Drop - 5% Drop', 100, 30000, 18950, 'Active', 237, 'SMP', 1),
(194, 238, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-7 [Guaranteed]', '- Instant - Speed 5k/Day - 30 days refill', 100, 10000, 17150, 'Active', 238, 'SMP', 1),
(195, 239, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-41', 'NO REFIL NO REFINDD', 100, 10000, 8550, 'Active', 239, 'SMP', 1),
(196, 241, 'Instagram TV', 'Instagram TV Views- Cheapest In Market [1M] 10K/DAY', 'Instagram TV Views- Cheapest In Market [1M] 10K/DAY', 100, 100000000, 2290, 'Active', 241, 'SMP', 1),
(197, 242, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-14', 'Instagram Followers ( Max - 5k ) ( NO REFILL ) INSTANT-6hrs', 100, 5000, 5200, 'Active', 242, 'SMP', 1),
(198, 243, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-20', 'No Refill / No Refund\r\n0-6 Hour Start\r\nSuperfast Speed\r\nMinimum 100\r\nMaximum 20,000', 100, 5000, 5950, 'Active', 243, 'SMP', 1),
(199, 244, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-25', 'INSTANT-6HRS\r\nReal Followers\r\n6,000 Per day\r\nMin 100\r\nMax 6,000', 100, 6000, 6350, 'Active', 244, 'SMP', 1),
(200, 245, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-38', 'INSTANT-4HRS\r\nReal Followers\r\n10,000 Per day\r\nMin 100\r\nMax 10,000', 100, 10000, 8050, 'Active', 245, 'SMP', 1),
(201, 246, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-47', '{Super fast} real followers. Data is renewed everyday. You can send followers even you used the max 10K for your profile.', 100, 10000, 10000, 'Active', 246, 'SMP', 1),
(202, 247, 'Instagram Followers Indonesia', 'Instagram Followers Manado', 'ISNTANT HITUNGAN DETIK', 50, 2000, 39150, 'Active', 247, 'SMP', 1),
(203, 249, 'Youtube Subscribers', 'Youtube Subribers Instant- 20k/Day-Lifetime Guarantee [MAX60K]', 'instant.\r\nnondrop', 100, 60000, 88000, 'Active', 249, 'SMP', 1),
(204, 250, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-11', 'INSTANT', 100, 5000, 5149, 'Active', 250, 'SMP', 1),
(205, 252, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia [NEW][MAX 12K] INSTANT S2', 'INPUT 5K 2 KALI  !!! INSTANT', 100, 5000, 40150, 'Active', 252, 'SMP', 1),
(206, 253, 'Instagram Followers Indonesia', 'Instagram Followers Aktif Maluku', 'Instagram Followers Aktip Maluku', 50, 1300, 40150, 'Active', 253, 'SMP', 1),
(207, 254, 'Instagram Followers Indonesia', 'Instagram Followers Aktif Nusa Tenggara Barat', 'Instagram Followers Aktip  Nusa Tenggara Barat', 100, 1500, 42150, 'Active', 254, 'SMP', 1),
(208, 255, 'Instagram Followers Indonesia', 'Instagram Followers Aktif Cilegon', 'fast', 100, 2000, 42150, 'Active', 255, 'SMP', 1),
(209, 256, 'Instagram Followers Indonesia', 'Instagram Followers Aktif  Serang', 'intant', 100, 3500, 41150, 'Active', 256, 'SMP', 1),
(210, 257, 'Instagram Followers Indonesia', 'Instagram Followers Aktif Jambi', 'instant', 100, 1200, 42150, 'Active', 257, 'SMP', 1),
(211, 258, 'Instagram Followers Indonesia', 'Instagram Followers Banjar Indonesia', 'Instagram Followers Banjar Indonesia', 100, 2000, 41150, 'Active', 258, 'SMP', 1),
(212, 259, 'Instagram Followers Indonesia', 'Instagram Followers Pekalongan Indonesia', 'Instagram Followers Pekalongan Indonesia', 100, 1600, 42150, 'Active', 259, 'SMP', 1),
(213, 260, 'Instagram Followers Indonesia', 'Instagram Followers Purwokerto Indonesia', 'Instagram Followers Purwokerto Indonesia', 100, 1800, 39150, 'Active', 260, 'SMP', 1),
(214, 262, 'Youtube Likes / Comments / Favs...', 'Youtube Likes 5k ( Min 50 ) - No refill', 'Youtube Likes 5k ( Min 50 ) - No refill', 50, 10000, 21650, 'Active', 262, 'SMP', 1),
(215, 263, 'Youtube Likes / Comments / Favs...', 'Youtube Likes[ No Refill, Fastest ] [ Max 50k ] INSTANT', '[ No Refill, Fastest ] [ Max 50k ] INSTANT', 20, 50000, 21550, 'Active', 263, 'SMP', 1),
(216, 264, 'Youtube Likes / Comments / Favs...', 'Youtube Likes[ No refill, Ultrafast ] [ Max 400k ] SUPER INSTANT', 'Youtube Likes[ No refill, Ultrafast ] [ Max 400k ] SUPER INSTANT', 50, 400000, 22249, 'Active', 264, 'SMP', 1),
(217, 265, 'Instagram Followers Indonesia', 'Followers Aktif Indo Laki - Laki DB2 username only', 'INSTNT', 50, 2500, 43150, 'Active', 265, 'SMP', 1),
(218, 266, 'Instagram Followers Indonesia', 'Followers Aktif Indo Perempuan/Wanita DB2 username only', 'INStant', 50, 1500, 44150, 'Active', 266, 'SMP', 1),
(219, 267, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-27', 'START 0-12 JAM', 100, 10000, 7000, 'Active', 267, 'SMP', 1),
(220, 268, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube Views ( S1 ) [ G60 - 80% Retention ] [ Speed 200+/D ]', '- Watch Page Views\r\n&bull; 85% Retention - ~500-1000 Views Per Day\r\n&bull; 100% Real Human YouTube Viewers!\r\n&bull; 60 Days of auto-refill Guarantee\r\n&bull; INSTANT START\r\n&bull; up to 50 minutes watch time!\r\n&bull; Windows Desktop Watch Page Views\r\n&bull; 100% Unique Traffic\r\n&bull; Social Referrers\r\n&bull; World-Wide Views Added in a NON-STOP Natural Pattern\r\n&bull; OK for VEVO\r\n&bull; Must be Unrestricted &amp;amp; Open for ALL countries\r\n&bull; Cancel any Time with Full/Partial Refund\r\n&bull; Over-Delivery Guaranteed', 1000, 100000000, 32150, 'Active', 268, 'SMP', 1),
(221, 269, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube Views ( S2 ) [ G60 - 95% Retention ] [ Speed 500+/D ]', '- Ultra High Retention\r\n&bull; 95% Retention - ~500-1000 Views Per Day\r\n&bull; 100% Real Human YouTube Viewers!\r\n&bull; 60 Days of auto-refill Guarantee\r\n&bull; INSTANT START\r\n&bull; up to 60 minutes watch time!\r\n&bull; Windows Desktop Watch Page Views\r\n&bull; 100% Unique Traffic\r\n&bull; Social Referrers\r\n&bull; World-Wide Views Added in a NON-STOP Natural Pattern\r\n&bull; OK for VEVO\r\n&bull; Must be Unrestricted &amp;amp; Open for ALL countries\r\n&bull; Cancel any Time with Full/Partial Refund\r\n&bull; Over-Delivery Guaranteed', 1000, 100000000, 62150, 'Active', 269, 'SMP', 1),
(222, 271, 'Instagram Comments', 'Instagram Komen Indonesia', 'PERBARIS INSTANT', 2, 1000, 10150, 'Active', 271, 'SMP', 1),
(223, 272, 'Instagram Story / Impressions / Saves', 'VIew Story Indonesia', 'INPUT USERNAME FAST', 100, 2001, 8150, 'Active', 272, 'SMP', 1),
(224, 275, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-4', 'NO REFILL NO REFUND', 100, 2000, 4750, 'Active', 275, 'SMP', 1),
(225, 276, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-2 [Guaranteed]', 'Instagram Followers [ Max - 5k ] [ 15 Days Refill ] INSTANT-6HRS NEW', 100, 5000, 11149, 'Active', 276, 'SMP', 1),
(226, 278, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-42', 'Instagram Followers', 100, 3000, 8650, 'Active', 278, 'SMP', 1),
(227, 279, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-9 [Guaranteed]', '- Instant\r\n- Speed 5k/Day\r\n- 30 days refill', 100, 10000, 18350, 'Active', 279, 'SMP', 1),
(228, 280, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-14 [Guaranteed]', 'REFILL BUTTON !\r\n1 - 6 Hours Start !\r\n5 to 10K per Day!\r\nR30 = Refill For 30 Days !\r\n24 to 48 Hours For Refill !\r\nMin = 300 !\r\n5 - 10% Drop Ratio !', 100, 30000, 21250, 'Active', 280, 'SMP', 1),
(229, 281, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-31', 'NO REFILL NO REFUND', 100, 15000, 7300, 'Active', 281, 'SMP', 1),
(230, 282, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-40', 'NO REFILL NO REFUND', 100, 45000, 8300, 'Active', 282, 'SMP', 1),
(231, 284, 'Instagram Views', 'Instagram Views [400K] [SLOW]', 'SLOW !!!', 100, 400000, 2186, 'Active', 284, 'SMP', 1),
(232, 285, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-12', '0-3 JAM START', 100, 6000, 5150, 'Active', 285, 'SMP', 1),
(233, 286, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-35', 'INSTAGRAM FOLLOWERS MAX 6K - INSTANT START [Recommended]', 100, 6000, 7350, 'Active', 286, 'SMP', 1),
(234, 287, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-85', 'input 5K 3 KALI \r\nSETELAH ORDERAN PERTAAMA SUKSES\r\nHITUNGAN DETIK \r\nCEPAT MASUK', 100, 5000, 41150, 'Active', 287, 'SMP', 1),
(235, 289, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-9', 'Instant-6hrs\r\nFastest\r\nMin 100\r\nNo refill Guaranted', 100, 3000, 5050, 'Active', 289, 'SMP', 1),
(236, 290, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia   PASIF', 'NO REFILL NO REFUND \r\nUSERNAME ONLY', 100, 1000, 37150, 'Active', 290, 'SMP', 1),
(237, 292, 'Youtube Views', 'Youtube - Views [ NO REFILL ] [ HR ] [ Speed - 10k-20k ] INSTANT REKOMENDED', 'Instant Start\r\nNo Refill Guarantee\r\n60-80% Retention\r\nWorldwide', 100, 10000, 19750, 'Active', 292, 'SMP', 1),
(238, 293, 'Website Traffic', 'Website Traffic [1M]', 'No Adfly / Linkshrink / Etc...\r\nYou Can Use Goo.gl To See The Traffic\r\n12 Hours Start!\r\n10K/Day\r\nMinimum 1000', 1000, 100000000, 4550, 'Active', 293, 'SMP', 1),
(239, 294, 'Website Traffic', 'Website Traffic [10M] [WW]', 'Instant Start !\r\n0 to 1 Hour !\r\nDaily Speed = 5k-10k\r\n100% Real People !!\r\nGoogle Analytics Supported\r\nAdSense Safe\r\nMin = 100', 100, 100000000, 11350, 'Active', 294, 'SMP', 1),
(240, 295, 'Website Traffic', 'Website Traffic From Facebook [10M] [WW]', 'Traffic From Facebook !\r\nInstant Start !\r\n0 to 1 Hour !\r\nDaily Speed = 5k-10k\r\n100% Real People !!\r\nGoogle Analytics Supported\r\nAdSense Safe\r\nMin = 100', 100, 1000000000, 11350, 'Active', 295, 'SMP', 1),
(241, 296, 'Website Traffic', 'Website Traffic From Instagram [10M] [WW]', 'Traffic From Instagram !\r\nInstant Start !\r\n0 to 1 Hour !\r\nDaily Speed = 5k-10k\r\n100% Real People !!\r\nGoogle Analytics Supported\r\nAdSense Safe\r\nMin = 100', 100, 1000000000, 11350, 'Active', 296, 'SMP', 1),
(242, 297, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-17', 'FASTER IN MARKET', 100, 5000, 5500, 'Active', 297, 'SMP', 1),
(243, 299, 'Youtube Subscribers', 'Youtube Subscribers [50K] [REFILL ] 30 Hari', 'REFILL 30 Hari', 25, 50000, 54000, 'Active', 299, 'SMP', 1),
(244, 300, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-3', 'Very slow [Harga berbanding lurus dengan kualitas]', 100, 2000, 3499, 'Active', 300, 'SMP', 1),
(245, 302, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-28', 'SPECIAL SERVICE [ONLY USERNAME/NOT LINK]', 500, 20000, 7000, 'Active', 302, 'SMP', 1),
(246, 304, 'Youtube Views', 'Youtube Views ,[ GEO WORLDWIDE ] [ Life Time Guaranteed ] [ 50k-100k/day ] SUPER INSTANT', 'Life Time Guaranteed', 1000, 100000000, 17000, 'Active', 304, 'SMP', 1),
(247, 306, 'Instagram Likes Indonesia', 'Likes Aktif Indonesia SUPERFAST 1 in', 'Likes Aktif Indonesia', 10, 3000, 7000, 'Active', 306, 'SMP', 1),
(248, 307, 'Instagram Followers Indonesia', 'Followers Aktif Indo [NEW]', 'Aktif Indonesia', 100, 4000, 45000, 'Active', 307, 'SMP', 1),
(249, 308, 'Instagram Followers Indonesia', 'Followers Pasif Indo [NEW]', 'Followers Pasif No Refill No Refund', 50, 12000, 42000, 'Active', 308, 'SMP', 1),
(250, 309, 'Instagram Followers Indonesia', 'Followers Aktif Indo - Gender MALE [NEW]', 'Gender Male', 10, 2500, 45000, 'Active', 309, 'SMP', 1),
(251, 310, 'Instagram Followers Indonesia', 'Followers Aktif Indo - Gender FAMALE [NEW]', 'Gender Famale', 10, 1500, 45000, 'Active', 310, 'SMP', 1),
(252, 311, 'Instagram Likes Indonesia', 'Likes Aktif Indonesia SUPERFAST 2 in', 'Like Real indonesia', 10, 5500, 7000, 'Active', 311, 'SMP', 1),
(253, 312, 'Youtube Subscribers', 'Youtube Subscribers 0-12 Hour Start-Fastest and Cheapest-4k/day', '0-12 Hour Start-Fastest and Cheapest', 25, 170000, 182000, 'Active', 312, 'SMP', 1),
(254, 313, 'Facebook Page Likes', 'Real Facebook Page Likes - [ Max - 500k ] [ 10k-20k/day ] INSTANT-1HRS', 'Page Like', 100, 5000000, 92000, 'Active', 313, 'SMP', 1),
(255, 314, 'Instagram Views', 'Instagram Views {Speed 100K - Instant Start}', 'Views instant', 1000, 1000000000, 2300, 'Active', 314, 'SMP', 1),
(256, 315, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-18', 'Low Quality [NO COMMENT]', 1000, 2000, 4100, 'Active', 315, 'SMP', 1),
(257, 316, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-54', 'RECOMENDED FOR SELLER', 100, 15000, 10000, 'Active', 316, 'SMP', 1),
(258, 317, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-56', 'High Quality', 20, 30000, 10500, 'Active', 317, 'SMP', 1),
(259, 318, 'Instagram Story / Impressions / Saves', 'Instagram Story View (Last Story)', 'Last story', 50, 20000, 6000, 'Active', 318, 'SMP', 1),
(260, 319, 'Facebook Page Likes', 'Facebook Page Likes SMP1 [15 Days Refill]', 'Refill 15 days', 100, 20000, 17000, 'Active', 319, 'SMP', 1),
(261, 320, 'Instagram Live Video', 'Instagram Live Video Likes SMP1 [FAST]', 'Live Vidio', 200, 10000, 7700, 'Active', 320, 'SMP', 1),
(262, 322, 'Instagram Story / Impressions / Saves', 'Instagram Vote Indo (Yes / Agree / Green Color)', '-4000', 10, 4000, 6100, 'Active', 322, 'SMP', 1),
(263, 323, 'Instagram Story / Impressions / Saves', 'Instagram Vote Indo (No / Disagree/ Red Color)', '-', 10, 4000, 6100, 'Active', 323, 'SMP', 1),
(264, 324, 'Instagram Auto Views', 'Instagram Auto Views Story 1 Hari [100]', 'VIEW 1 HARI', 1000, 1000, 5000, 'Active', 324, 'SMP', 1),
(265, 325, 'Instagram Auto Views', 'Instagram Auto Views Story 7 Hari [100]', 'VIEW 7 HARI', 1000, 1000, 16000, 'Active', 325, 'SMP', 1),
(266, 326, 'Instagram Auto Views', 'Instagram Auto Views Story 14 Hari [100]', 'VIEW 14 HARI', 1000, 1000, 27000, 'Active', 326, 'SMP', 1),
(267, 327, 'Instagram Auto Likes', 'Instagram Auto Likes SMP1', '[REAL] - [SUPERINSTANT] - [FULL LINK FOTO] - [1-5Menit Setelah Post] - [NO REFILL-NOREFUND]', 20, 10000, 5000, 'Active', 327, 'SMP', 1),
(268, 328, 'Instagram Auto Likes', 'Instagram Auto Likes SMP2', '[REAL] - [SUPERINSTANT] - [FULL LINK FOTO] - [1-5Menit Setelah Post] - [NO REFILL-NOREFUND]', 100, 4000, 5100, 'Active', 328, 'SMP', 1),
(269, 329, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-21 [Guaranteed]', '[MAKS.10K] - [REAL HQ] - [USERNAME ONLY] - [0-1HOURS] - [30Days Refill]', 100, 10000, 26000, 'Active', 329, 'SMP', 1),
(270, 330, 'Youtube Subscribers', 'Youtube Subscribers   1 [50K] [SMP1]', '[Quality = Medium / High Quality] - [Start Time = Up to 2 Hours] - [Speed = Up to 10k Per Day] - [Refill = 30 Days Refill] - [Min = 25 ! - Max = 50K]', 25, 50000, 58000, 'Active', 330, 'SMP', 1),
(271, 332, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-29', '-', 100, 6000, 7000, 'Active', 332, 'SMP', 1),
(272, 334, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-3 [Guaranteed]', 'RANDOM ASIA+INDONESIA SUPER FAST MAX 60K', 50, 60000, 12000, 'Active', 334, 'SMP', 1),
(273, 336, 'Best', 'Instagram Views CHEAP BIG SALE', 'NO COMMENT | BEST CHEAP SERVICE', 100, 500, 2002, 'Active', 336, 'SMP', 1),
(274, 339, 'Best', 'Instagram Followers CHEAP BIG SALE [3]', '[Quality = Low] - [Start Time = Up to 24 Hours] - [Speed = Up to 2k Per Day] - [Refill = No Refill / Refund] - [Min = 100 ! - Max = 3K] - [Specs = Might Have Partial Issues]', 1000, 1000, 2999, 'Active', 339, 'SMP', 1);
INSERT INTO `services` (`id`, `sid`, `category`, `service`, `note`, `min`, `max`, `price`, `status`, `pid`, `provider`, `refund`) VALUES
(275, 340, 'Website Traffic', 'Website Traffic SMP R1', 'Website traffic', 1000, 1000000, 7000, 'Active', 340, 'SMP', 1),
(276, 341, 'Twitter Followers', 'Twitter Followers SMP1 [HQ] [7Days Refill] [Max.5K]', 'Twitter Followers', 20, 5000, 67000, 'Active', 341, 'SMP', 1),
(277, 343, 'Youtube Subscribers', 'YouTube Subscriber 80k(8-10K/Day)-Lifetime Guarantee', '80k(8-10K/Day)-Lifetime Guarantee', 25, 80000, 53000, 'Active', 343, 'SMP', 1),
(278, 344, 'Facebook Followers / Friends / Group Members', 'Facebook Followers SMP1 HQ [30Days Refill]', 'REFILL 30 Hari', 100, 40000, 22000, 'Active', 344, 'SMP', 1),
(279, 345, 'Facebook Followers / Friends / Group Members', 'Facebook Followers SMP2 HQ [30Days Refill]', '30 Days Refill', 100, 75000, 25000, 'Active', 345, 'SMP', 1),
(280, 346, 'Youtube Subscribers', 'YouTube Subscriber CHEAPS TODAY [2K]', 'NOREFILL - NOREFUND', 100, 2000, 20098, 'Active', 346, 'SMP', 1),
(281, 347, 'Youtube Likes / Comments / Favs...', 'Youtube Likes [ Max 5K ] [ Speed 50 - 100/DAYS ] - NON DROP', 'NON DROP', 10, 5000, 57000, 'Active', 347, 'SMP', 1),
(282, 348, 'Youtube Views', 'Youtube View SMP1 [1M] [HQ] [EXCLUSIVE] [FREE LIKE]', '[Quality = Normal Random Retention] - [Referral = Random] - [Start Time = Up to 2 Hours] - [Speed = 10K - 100K Per Day] - [Refill = No Refill / No Refund (Buy On Your Own Risk)] - [Min = 1k ! - Max = 10M !] - [Specs = No drop encountered at the moment + WE ARE SENDING FREE LIKES also]', 1000, 1000000, 3500, 'Active', 348, 'SMP', 1),
(283, 349, 'Youtube Views', 'Youtube View SMP 5 [200K] [NO REFILL] [UHR + DESKTOP VIEWS]', 'Up to 50K Views Per Day â€¢ 100% Real Human YouTube Viewers! â€¢ NO REFILL / NO REFUND â€¢ views include user engagement* â€¢ INSTANT START â€¢ up to 50 minutes watch time! â€¢ 95%+ Retention â€¢ Windows Desktop Watch Page Views â€¢ 100% Unique Traffic â€¢ Social Referrers â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Incremental Speed Based on Order Size â€¢ OK for VEVO â€¢ Must be Unrestricted & Open for ALL countries â€¢ Cancel any Time with Full/Partial Refund â€¢ Over-Delivery Guaranteed', 1000, 200000, 12000, 'Active', 349, 'SMP', 1),
(284, 350, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube View SMP 3 [MAX 250K] [VEVO ACCEPTED]', '20K-50k Views Per Day NO REFILL â€¢ NO REFILL / REFUND â€¢ 100% Real Human YouTube Viewers! â€¢ INSTANT START â€¢ 95% Retention Up To 50 Minutes â€¢ 20-30 Sec watch time! â€¢ No Refill Guarantee â€¢ Windows Desktop Watch Page Views â€¢ 100% Unique Traffic â€¢ Social Referrer (Facebook) â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ OK for VEVO â€¢ Must be Unrestricted & Open for ALL countries â€¢ Cancel any Time with Full/Partial Refund â€¢ Over-Delivery Guaranteed â€¢ Minimum 1000', 1000, 250000, 12000, 'Active', 350, 'SMP', 1),
(285, 351, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube View SMP 4 [10M] [HQ] [100K/Days]', 'Quality = High Quality Random Retention! - You Might Get FREE Likes With The Views ! - Referral = Random - Source: Suggested Views - Start Time =Instant to 12 Hours Start ! - Speed = 10K - 100K Per Day ! - Refill = No Refill / No Refund (Buy On Your Own Risk) - Min = 500 ! - Max = 10M ! - Specs = If order is marked as completed and you don\\\'t see the view count increased, Like your video, and refresh the page after 30 seconds, your views will appear.', 500, 10000000, 14000, 'Active', 351, 'SMP', 1),
(286, 352, 'Youtube Views', 'Youtube View SMP8 [VERY SLOW] [REAL] [MOBILE VIEWS] [NONDROP]', 'Mobile IOS Views - Lifetime Guarantee â€¢ 5 Minutes Retention - 100-250 Views Per Day â€¢ Real Human Mobile IOS Views â€¢ NON-DROP Lifetime Guarantee â€¢ INSTANT START â€¢ 100% Unique Traffic â€¢ Mobile Safari Referrer â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Over-Delivery Guaranteed', 100, 1000, 23000, 'Active', 352, 'SMP', 1),
(287, 353, 'Youtube Views', 'Youtube View SMP9 [REAL] [SLOW] [\' Retention] [DRIPFEED] [VEVO ACCEPTED]', '3 Minutes Retention - 100 /150 Views Per Day (Slow Drip-Feed) â€¢ MAX 100k â€¢ Real Human Windows Desktop Embedded Views â€¢ NON-DROP Lifetime Guarantee â€¢ INSTANT START â€¢ 100% Unique Traffic â€¢ Social Referrer (Twitter) â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ OK for VEVO â€¢ Must be Embed Enabled & Open to ALL Countries â€¢ Over-Delivery Guaranteed', 300, 10000, 26000, 'Active', 353, 'SMP', 1),
(288, 354, 'Youtube Views', 'Youtube View SMP10 [10M] [LIFETIME] [HQ]', '[Lifetime Guaranteed] - [0-1 Hour Start] - [Up to 100K / Day] - [120 Seconds Retention] - [Minimum 1000]', 1000, 10000000, 27000, 'Active', 354, 'SMP', 1),
(289, 356, 'Youtube Live Stream', 'Youtube Live Stream [MONETIZABLE] [REAL] âš¡ï¸âš¡ï¸âš¡ï¸â­', 'Avg Concurrent 400-1000 will stay for 1-2 hours â€¢ MONETIZABLE â€¢ 100% Real Human YouTube Viewers! â€¢ INSTANT START â€¢ Windows Desktop Watch Page Views â€¢ 100% Unique Traffic â€¢ NON-DROP Lifetime Guarantee â€¢ Possible User Engagements â€¢ Social Referrer (Twitter) â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Incremental Speed Based on Order Size â€¢ Must be Unrestricted & Open for ALL countries â€¢ Over-Delivery Guaranteed', 5000, 1000000, 52000, 'Active', 356, 'SMP', 1),
(290, 357, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube View SMP 11 [500K] [S30] [EXCLUSIVE] [NICHE RELATED] [HR] [VEVO ACCEPTED]', '30K-100k Views Per Day â€¢ NRVâ„¢ - Niche Related Views â€¢ 100% Real Human YouTube Viewers! â€¢ INSTANT START â€¢ 70% Retention up to 50 minutes watch time! â€¢ 30 Days Refill Guarantee â€¢ Auto refill every 24h â€¢ Windows Desktop Watch Page Views â€¢ 100% Unique Traffic â€¢ Traffic Sources: Niche related Video Suggestions & Searches â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Incremental Speed Based on Order Size â€¢ Must be PUBLIC, Unrestricted & Open for ALL countries â€¢ OK for VEVO', 5000, 500000, 27000, 'Active', 357, 'SMP', 1),
(291, 358, 'Youtube Views', 'Youtube - Views SMP 1 [ 100k-300k/day ] ( AUTO REFILL ) [ Life Time Guaranteed ] INSTANT', 'Life Time Guaranteed', 1000, 1000000, 5500, 'Active', 358, 'SMP', 1),
(292, 359, 'Youtube Views', 'Youtube Views [ 10k-50k/day ] [ HR ] [ No Refill Guarantee ] INSTANT [RECOMMENDED]', 'No Refill Guarantee', 500, 3000000, 16000, 'Active', 359, 'SMP', 1),
(293, 361, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes SMP 1 [ULTRA FAST]', '[âœ” Accept All Post] - [INSTANT] - [ULTRA FAST !]', 100, 15000, 8000, 'Active', 361, 'SMP', 1),
(294, 362, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes SMP 2 [ULTRAFAST]', '[âœ” Accept All Post] - [INSTANT] - [ULTRA FAST]', 25, 15000, 9500, 'Active', 362, 'SMP', 1),
(295, 363, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes SMP 3 [ULTRAFAST]', '[âœ” Accept All Post] - [INSTANT] - [ULTRA FAST !]', 50, 10000, 10100, 'Active', 363, 'SMP', 1),
(296, 364, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Emoticon Love]', 'Instant Start !', 100, 1000, 11000, 'Active', 364, 'SMP', 1),
(297, 365, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Emoticon HAHA]', 'Instant Start !', 100, 1000, 11000, 'Active', 365, 'SMP', 1),
(298, 366, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Emoticon WOW]', 'Instant Start !', 100, 1000, 11000, 'Active', 366, 'SMP', 1),
(299, 367, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Emoticon SAD]', 'Instant Start !', 100, 1000, 11000, 'Active', 367, 'SMP', 1),
(300, 368, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Emoticon ANGRY]', 'Instant Start !', 100, 1000, 11000, 'Active', 368, 'SMP', 1),
(301, 369, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Male]', '[Male Accounts] - [Put Link Of Facebook Profile/Page Post] - [0-10 Minutes Start!] - [BRAZIL] - [1K/Day]', 100, 1000, 12999, 'Active', 369, 'SMP', 1),
(302, 370, 'Facebook Post Likes / Comments / Shares / Events', 'Facebook Post Likes [Female]', '[Female Accounts] - [Put Link Of Facebook Profile/Page Post] - [0-10 Minutes Start!] - [BRAZIL] - [1K/Day]', 100, 1000, 3500, 'Active', 370, 'SMP', 1),
(303, 371, 'Facebook Auto Likes - 30 Days Subscription', 'Facebook Website Likes', '[Real] - [Refill 30 Days] - [1-6 Hours Start] - [3K - 5K/Day]', 100, 10000, 42000, 'Active', 371, 'SMP', 1),
(304, 372, 'Facebook Followers / Friends / Group Members', 'Facebook Followers SMP 3 HQ [Auto 30Days Refill]', '[For Facebook Profiles And Not Pages] - [Real] - [Refill (30 Days Maximum)] - [0-6 Hour Start] - [500 - 2K/Day]', 100, 50000, 32000, 'Active', 372, 'SMP', 1),
(305, 373, 'Facebook Page Likes', 'Facebook Page Likes SMP 2 HQ [Max.20K]', '[Quality = REAL] - [Start Time = Up to 48 Hours] - [Speed = Up to 20k Per Day] - [Refill = No Refill / Refund] - [Max = 20K]', 500, 20000, 27000, 'Active', 373, 'SMP', 1),
(306, 374, 'Facebook Page Likes', 'Facebook Page Likes SMP 3 HQ [Max.10K]', '[Real] - [48 Hours Start] - [500 - 2K/Day]', 500, 10000, 42000, 'Active', 374, 'SMP', 1),
(307, 375, 'Facebook Video Views / Live Stream', 'Facebook Video Views HQ', '[Start Time = Instant] - [Speed = Up to 4k Per Day] - [Refill = No Refill / Refund] - [Min = 1000] - [Max = 100K] - [Specs = Might take up to 12 Hours to start sometimes]', 1000, 100000, 7500, 'Active', 375, 'SMP', 1),
(308, 376, 'Twitter Likes', 'Twitter Likes SMP 1 [HQ]', 'Refill (30 Days Maximum) 0-1 Hour Start! 1K - 5K/Day', 100, 500000, 72000, 'Active', 376, 'SMP', 1),
(309, 377, 'Youtube Views', 'Youtube View SMP 5 [1K] [LIFETIME] [HQ] [SLOW]', 'Mobile IOS Views - Lifetime Guarantee â€¢ 5 Minutes Retention - 100-250 Views Per Day â€¢ Real Human Mobile IOS Views â€¢ NON-DROP Lifetime Guarantee â€¢ INSTANT START â€¢ 100% Unique Traffic â€¢ Mobile Safari Referrer â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Over-Delivery Guaranteed', 100, 1000, 20000, 'Active', 377, 'SMP', 1),
(310, 378, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia [TERMURAH SEINDONESIA]', '[Username only] - [EXMPLE : solosmartpedia] - [Fast Progress] - [NO PRIVATE AKUN] - [Pre Release]', 100, 4000, 35500, 'Active', 378, 'SMP', 1),
(311, 379, 'Instagram Comments', 'Instagram Comments Like (Kirim kode komentar)', '[Kirim kode Komentar] - [Start INSTANT - 24Jam] - [Real Indonesia]', 19, 4000, 6000, 'Active', 379, 'SMP', 1),
(312, 380, 'Instagram Comments', 'Instagram Comments Indonesia [REAL]', '[Instant Start] - [Real Indonesia] - [No Refill/No Refund] - [Input Comment Setelah Link]', 10, 100, 212000, 'Active', 380, 'SMP', 1),
(313, 381, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers S-16 [Guaranteed]', '[Refill (25 Days Maximum)] - [One Day Finish] - [Max Per Order 3000] - [Non Drop] - [High Quality] - [0-1 Hour Start, usually Instant]', 1000, 3000, 22000, 'Active', 381, 'SMP', 1),
(314, 382, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-15', 'No Refill/Refund', 500, 10000, 5300, 'Active', 382, 'SMP', 1),
(315, 383, 'Instagram Likes', 'Instagram Likes S-23 [Likes Instagram] [URL]', '-', 20, 50000, 5500, 'Active', 383, 'SMP', 1),
(316, 384, 'Best', 'Instagram Views CHEAP BIG SALE SMP 2', 'NO COMMENT | BEST CHEAP SERVICE', 500, 2000, 2010, 'Active', 384, 'SMP', 1),
(317, 385, 'Youtube Views [HR] [JAM TAYANG]', 'Youtube Live Stream [MONETIZABLE] [REAL]', 'Avg Concurrent 400-1000 will stay for 1-2 hours â€¢ MONETIZABLE â€¢ 100% Real Human YouTube Viewers! â€¢ INSTANT START â€¢ Windows Desktop Watch Page Views â€¢ 100% Unique Traffic â€¢ NON-DROP Lifetime Guarantee â€¢ Possible User Engagements â€¢ Social Referrer (Twitter) â€¢ World-Wide Views Added in a NON-STOP Natural Pattern â€¢ Incremental Speed Based on Order Size â€¢ Must be Unrestricted & Open for ALL countries â€¢ Over-Delivery Guaranteed', 5000, 1000000, 52000, 'Active', 385, 'SMP', 1),
(318, 386, 'Instagram Likes', 'Instagram Likes S-29 [Likes Instagram] [URL]', 'Only one order per link (example if you order 500 for same photo, you cannot order another 500 later for the same photo, only 1 order per link) Market\'s Favorite! Real Super Instant Delivery', 100, 2000, 2150, 'Active', 386, 'SMP', 1),
(319, 387, 'Instagram Likes', 'Instagram Likes S-30 [Likes Instagram] [URL]', '[MAX.1K] - [REAL] - [CLIENT FAVORITE]', 100, 1000, 2550, 'Active', 387, 'SMP', 1),
(320, 388, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-86', '[ Max - 5k ] [ 15 Days Refill ]', 100, 5000, 11500, 'Active', 388, 'SMP', 1),
(321, 389, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-87', '[Max - 60k ] [ NO PARTIAL ] SUPER INSTANT', 50, 60000, 12500, 'Active', 389, 'SMP', 1),
(322, 390, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia [PEREMPUAN] FASTES', 'AKUN PEREMPUAN', 100, 2500, 47000, 'Active', 390, 'SMP', 1),
(323, 391, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-88', 'NO REFILL-NO REFUND- INSTANT MAX 5K', 100, 5000, 8000, 'Active', 391, 'SMP', 1),
(324, 392, 'Instagram Live Video', 'Instagram Live Video Likes SMP 2', '[USERNAME ONLY] - [Likes On Live Video] - [SUPER INSTANT]', 100, 1000000, 17000, 'Active', 392, 'SMP', 1),
(325, 393, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-89', 'Quality = Low / Medium ! - Start Time = 0 to 6 Hours Start ! - Speed = 1k Per Day ! - Refill = No Refill / Refund ! - Min = 1K ! - Max = 1K ! - Specs =', 1000, 1000, 3900, 'Active', 393, 'SMP', 1),
(326, 394, 'Instagram Likes Indonesia', 'Likes Aktif Indonesia SUPERFAST 3 in', 'Likes Aktif Indonesia', 500, 2500, 4500, 'Active', 394, 'SMP', 1),
(327, 395, 'Best', 'Instagram Likes SMP 1 [BEST CHEAP SERVICE]', 'BEST CHEAP SERVICE', 100, 1000, 2060, 'Active', 395, 'SMP', 1),
(328, 396, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-90', 'Instant Start !', 100, 10000, 7500, 'Active', 396, 'SMP', 1),
(329, 397, 'Youtube Subscribers', 'Youtube Subscribers [CHEAPES]', 'MAX 10K NO REFILL/REFUND', 100, 30000, 29000, 'Active', 397, 'SMP', 1),
(330, 398, 'Youtube Views', 'Youtube - Views [CHEAPES]', 'No Refill Guarantee', 200, 20000000, 7000, 'Active', 398, 'SMP', 1),
(331, 399, 'Instagram Followers Indonesia', 'Instagram Followers Indonesia [QUICKSPEED] [CAMPURAN WW][30K]', 'Followers real indonesia + mix ww , fast speed', 100, 30000, 31000, 'Active', 399, 'SMP', 1),
(332, 400, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram followers S-91', 'HQ Very Fast MAX 10K/Account', 100, 10000, 8000, 'Active', 400, 'SMP', 1),
(333, 401, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-92', 'No refill / refund start 0 to 6 AM', 100, 5000, 5000, 'Active', 401, 'SMP', 1),
(334, 402, 'Instagram Comments Random', 'Instagram MIX Women Comments', 'MIX Women Random', 5, 1000, 17000, 'Active', 402, 'SMP', 1),
(335, 403, 'Youtube Views', 'Youtube Views CHEAP [HQ] REFILL 30DAYS', 'Refill 30Days [MAX-10M]', 100, 10000000, 9500, 'Active', 403, 'SMP', 1),
(336, 404, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-93', 'No refill / refund start 0 to 3 AM', 100, 5000, 6000, 'Active', 404, 'SMP', 1),
(337, 405, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers SMP 17 HQ [NON DROP EXCLUSIVE]', '[Exclusive Service] - [Refill (30 Days Maximum)] - [0 to 8 Hours Start] - [High Speed Delivery] - [Max = 10K] - [Super High Quality]', 200, 10000, 27000, 'Active', 405, 'SMP', 1),
(338, 406, 'Instagram Followers [Refill] [Guaranteed] [NonDrop', 'Instagram Followers SMP 18 HQ [25Days Refill] [Non Drop]', '[Refill (25 Days Maximum)] - [One Day Finish] - [Max Per Order 3000] - [Non Drop High Quality] - [0-1 Hour Start] - [usually Instant]', 1000, 3000, 23000, 'Active', 406, 'SMP', 1),
(339, 407, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-94', 'Instant Delivery -  Rekommended server', 100, 100000, 17000, 'Active', 407, 'SMP', 1),
(340, 408, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-95', 'Cheap Service', 100, 2000, 5000, 'Active', 408, 'SMP', 1),
(341, 409, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-96', 'Very Fast - Instant Delivery', 100, 10000, 7000, 'Active', 409, 'SMP', 1),
(342, 410, 'Instagram Followers No Refill/Not Guaranteed', 'Instagram Followers S-97', 'NO COMENT YA', 100, 5000, 4350, 'Active', 410, 'SMP', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_diamond`
--

CREATE TABLE `services_diamond` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `paket` varchar(15) NOT NULL,
  `game` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `status` enum('Active','Not Active') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `services_diamond`
--

INSERT INTO `services_diamond` (`id`, `name`, `paket`, `game`, `price`, `status`) VALUES
(1, 'ML001 - 11 DIAMONDS - RP 4000', 'ML001', 'ML', 4000, 'Active'),
(2, 'ML002 - 14 DIAMONDS - RP 5000', 'ML002', 'ML', 5000, 'Active'),
(3, 'ML003 - 19 DIAMONDS - RP 6000', 'ML003', 'ML', 6000, 'Active'),
(4, 'ML004 - 36 DIAMONDS - RP 11000', 'ML004', 'ML', 11000, 'Active'),
(6, 'ML006 - 220 DIAMONDS - RP 60000', 'ML006', 'ML', 60000, 'Active'),
(5, 'ML005 - 74 DIAMONDS - RP 20000', 'ML005', 'ML', 20000, 'Active'),
(7, 'ML007 - 275 Diamonds - Rp 75000', 'ML007', 'ML', 75000, 'Active'),
(8, 'ML008 - 366 Diamonds - Rp 102000', 'ML008', 'ML', 102000, 'Active'),
(9, 'ML009 - 966 Diamonds - RP 252000', 'ML009', 'ML', 252000, 'Active'),
(10, 'ML0010 - 2010 Diamonds - RP 550000', 'ML010', 'ML', 550000, 'Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_line`
--

CREATE TABLE `services_line` (
  `id` int(10) NOT NULL,
  `category` enum('S&T','PPT') COLLATE utf8_swedish_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `services_line`
--

INSERT INTO `services_line` (`id`, `category`, `name`, `price`) VALUES
(1, 'S&T', 'Stiker & Theme Line', 7000),
(81, 'S&T', 'STIKER 50C', 8000),
(82, 'S&T', 'STICKER 100C', 14000),
(83, 'S&T', 'STICKER 150C', 20000),
(84, 'S&T', 'STICKER 200C', 26000),
(85, 'S&T', 'STICKER 250C', 32000),
(91, 'S&T', '100 ADDERS', 13000),
(92, 'S&T', '200 ADDERS', 24000),
(93, 'S&T', '100 LIKE LINE POST', 7000),
(94, 'S&T', '200 LIKE LINE POST', 13000),
(95, 'S&T', '300 LIKE LINE POST', 18000),
(96, 'S&T', '400 LIKE LINE POST', 23000),
(97, 'S&T', '500 LIKE LINE POST', 28000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_pulsa`
--

CREATE TABLE `services_pulsa` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `category` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `price` double NOT NULL,
  `status` enum('Active','Not Active') COLLATE utf8_swedish_ci NOT NULL,
  `provider` varchar(11) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `services_pulsa`
--

INSERT INTO `services_pulsa` (`id`, `name`, `category`, `code`, `price`, `status`, `provider`) VALUES
(1, 'AXIS 5000', 'AXIS', 'AX5', 6250, 'Active', 'SMP'),
(2, 'AXIS 10000', 'AXIS', 'AX10', 11905, 'Active', 'SMP'),
(3, 'AXIS 25000', 'AXIS', 'AX25', 26995, 'Active', 'SMP'),
(4, 'AXIS 30000', 'AXIS', 'AX30', 31888, 'Active', 'SMP'),
(5, 'AXIS 50000', 'AXIS', 'AX50', 50225, 'Active', 'SMP'),
(6, 'AXIS 100000', 'AXIS', 'AX100', 100000, 'Active', 'SMP'),
(7, 'AXIS 15000', 'AXIS', 'AX15', 16750, 'Active', 'SMP'),
(8, 'VOUCHER AIGO 1GB 30Hr', 'AXIS AIGO (AKTIVASI *838*KODE#)', 'AIGO1', 15550, 'Active', 'SMP'),
(9, 'VOUCHER AIGO 2GB 30Hr', 'AXIS AIGO (AKTIVASI *838*KODE#)', 'AIGO2', 26150, 'Active', 'SMP'),
(10, 'VOUCHER AIGO 3GB 30Hr', 'AXIS AIGO (AKTIVASI *838*KODE#)', 'AIGO3', 32350, 'Active', 'SMP'),
(11, 'VOUCHER AIGO 5GB 30Hr', 'AXIS AIGO (AKTIVASI *838*KODE#)', 'AIGO5', 46200, 'Active', 'SMP'),
(12, 'VOUCHER AIGO 8GB 30Hr', 'AXIS AIGO (AKTIVASI *838*KODE#)', 'AIGO8', 59800, 'Active', 'SMP'),
(13, 'VOUCHER AIGO MINI 2GB 7Hr', 'AXIS AIGO MINI (AKTIVASI *838*KODE#)', 'AIM2', 18750, 'Active', 'SMP'),
(14, 'VOUCHER AIGO MINI 3GB 15Hr', 'AXIS AIGO MINI (AKTIVASI *838*KODE#)', 'AIM3', 23900, 'Active', 'SMP'),
(15, 'VOUCHER AIGO MINI 5GB 15Hr', 'AXIS AIGO MINI (AKTIVASI *838*KODE#)', 'AIM5', 35550, 'Active', 'SMP'),
(16, 'VOUCHER AIGO MINI 1GB 5Hr', 'AXIS AIGO MINI (AKTIVASI *838*KODE#)', 'AIM1', 11100, 'Active', 'SMP'),
(17, 'BRONET 300MB 7Hr', 'AXIS DATA BRONET', 'AXD300', 9925, 'Active', 'SMP'),
(18, 'BRONET 1GB 30Hr', 'AXIS DATA BRONET', 'AXD1', 20725, 'Active', 'SMP'),
(19, 'BRONET 2GB 30Hr', 'AXIS DATA BRONET', 'AXD2', 29575, 'Active', 'SMP'),
(20, 'BRONET 3GB 30Hr', 'AXIS DATA BRONET', 'AXD3', 39025, 'Active', 'SMP'),
(21, 'BRONET 5GB 30Hr', 'AXIS DATA BRONET', 'AXD5', 57425, 'Active', 'SMP'),
(22, 'BRONET 8GB 30Hr', 'AXIS DATA BRONET', 'AXD8', 78150, 'Active', 'SMP'),
(23, 'PULSA BOLT 25000', 'BOLT', 'BO25', 26925, 'Active', 'SMP'),
(24, 'PULSA BOLT 50000', 'BOLT', 'BO50', 51225, 'Active', 'SMP'),
(25, 'PULSA BOLT 100000', 'BOLT', 'BO100', 99875, 'Active', 'SMP'),
(26, 'PULSA BOLT 150000', 'BOLT', 'BO150', 148475, 'Active', 'SMP'),
(27, 'PULSA BOLT 200000', 'BOLT', 'BO200', 197100, 'Active', 'SMP'),
(28, 'BOLT Kuota 1.5GB 30Hri', 'BOLT KUOTA', 'BO29', 31075, 'Active', 'SMP'),
(29, 'BOLT Kuota 3GB 30Hri', 'BOLT KUOTA', 'BO49', 50525, 'Active', 'SMP'),
(30, 'BOLT Kuota 8GB 30Hri', 'BOLT KUOTA', 'BO99', 99125, 'Active', 'SMP'),
(31, 'BOLT Kuota 13GB 30Hri', 'BOLT KUOTA', 'BO149', 147750, 'Active', 'SMP'),
(32, 'BOLT Kuota 17GB 30Hri', 'BOLT KUOTA', 'BO199', 196375, 'Active', 'SMP'),
(33, 'SALDO GOJEK 20K', 'GOJEK', 'GJ20', 23486, 'Active', 'SMP'),
(34, 'SALDO GOJEK 25K', 'GOJEK', 'GJ25', 28486, 'Active', 'SMP'),
(35, 'SALDO GOJEK 50K', 'GOJEK', 'GJ50', 53486, 'Active', 'SMP'),
(36, 'SALDO GOJEK 100K', 'GOJEK', 'GJ100', 103486, 'Active', 'SMP'),
(37, 'SALDO GOJEK 150K', 'GOJEK', 'GJ150', 153486, 'Active', 'SMP'),
(38, 'SALDO GOJEK 200K', 'GOJEK', 'GJ200', 203525, 'Active', 'SMP'),
(39, 'SALDO GOJEK 250K', 'GOJEK', 'GJ250', 252675, 'Active', 'SMP'),
(40, 'SALDO GRAB 10K', 'GRAB', 'GB10', 13125, 'Active', 'SMP'),
(41, 'SALDO GRAB 20K', 'GRAB', 'GB20', 23125, 'Active', 'SMP'),
(42, 'SALDO GRAB 25K', 'GRAB', 'GB25', 28125, 'Active', 'SMP'),
(43, 'SALDO GRAB 40K', 'GRAB', 'GB40', 43125, 'Active', 'SMP'),
(44, 'SALDO GRAB 50K', 'GRAB', 'GB50', 53125, 'Active', 'SMP'),
(45, 'SALDO GRAB 100K', 'GRAB', 'GB100', 103125, 'Active', 'SMP'),
(46, 'SALDO GRAB 150K', 'GRAB', 'GB150', 153125, 'Active', 'SMP'),
(47, 'SALDO GRAB 200K', 'GRAB', 'GB200', 203125, 'Active', 'SMP'),
(48, 'SALDO GRAB 300K', 'GRAB', 'GB300', 303125, 'Active', 'SMP'),
(49, 'SALDO GRAB 500K', 'GRAB', 'GB500', 503125, 'Active', 'SMP'),
(50, 'INDOSAT 5000', 'INDOSAT', 'I5', 6975, 'Active', 'SMP'),
(51, 'INDOSAT 10000', 'INDOSAT', 'I10', 11895, 'Active', 'SMP'),
(52, 'INDOSAT 25000', 'INDOSAT', 'I25', 26000, 'Active', 'SMP'),
(53, 'INDOSAT 50000', 'INDOSAT', 'I50', 51000, 'Active', 'SMP'),
(54, 'INDOSAT 100000', 'INDOSAT', 'I100', 99250, 'Active', 'SMP'),
(55, 'INDOSAT 20000', 'INDOSAT', 'I20', 21690, 'Active', 'SMP'),
(56, 'INDOSAT 30000', 'INDOSAT', 'I30', 31600, 'Active', 'SMP'),
(57, 'EXTRA 2GB', 'INDOSAT DATA EXTRA', 'IDX2', 39250, 'Active', 'SMP'),
(58, 'EXTRA 4GB', 'INDOSAT DATA EXTRA', 'IDX4', 55225, 'Active', 'SMP'),
(59, 'EXTRA 6GB', 'INDOSAT DATA EXTRA', 'IDX6', 73775, 'Active', 'SMP'),
(60, 'Freedom M, 2+3GB 4G, 30hr', 'INDOSAT DATA FREEDOM', 'IFC1', 60800, 'Active', 'SMP'),
(61, 'Freedom L, 4+8GB 4G, 30hr', 'INDOSAT DATA FREEDOM', 'IFC3', 90450, 'Active', 'SMP'),
(62, 'Haji Unlimited Internet 20 Hari', 'INDOSAT DATA HAJI', 'IDJ1', 355275, 'Active', 'SMP'),
(63, 'Haji Komplit Internet Nelpon & Sms 20 Hari', 'INDOSAT DATA HAJI', 'IDJ2', 453375, 'Active', 'SMP'),
(64, 'Haji Unlimited Internet 40 Hari', 'INDOSAT DATA HAJI', 'IDJ3', 551475, 'Active', 'SMP'),
(65, 'Haji Komplit Internet Nelpon & Sms 40 Hari', 'INDOSAT DATA HAJI', 'IDJ4', 639425, 'Active', 'SMP'),
(66, 'KUOTA 1GB 1hr', 'INDOSAT DATA HARIAN', 'IDH1', 3925, 'Active', 'SMP'),
(67, 'KUOTA 1GB 3hr', 'INDOSAT DATA HARIAN', 'IDH3', 5575, 'Active', 'SMP'),
(68, 'KUOTA 1GB 7hr', 'INDOSAT DATA HARIAN', 'IDH7', 10500, 'Active', 'SMP'),
(69, 'KUOTA 1GB 15hr', 'INDOSAT DATA HARIAN', 'IDH15', 13100, 'Active', 'SMP'),
(70, 'MINI 1GB+500MB Lokal+1GB Malam+500MB Apps 30Hr', 'INDOSAT DATA MINI', 'IDM1', 17025, 'Active', 'SMP'),
(71, 'MINI 2GB+500MB Lokal+3.5GB Malam+500MB Apps 30Hr', 'INDOSAT DATA MINI', 'IDM2', 33175, 'Active', 'SMP'),
(72, 'KUOTA 1GB 30hr', 'INDOSAT DATA REGULER', 'IDN1', 21900, 'Active', 'SMP'),
(73, 'KUOTA 2GB 30hr', 'INDOSAT DATA REGULER', 'IDN2', 34100, 'Active', 'SMP'),
(74, 'KUOTA 3GB + SMS Sesama 30hr', 'INDOSAT DATA REGULER', 'IDN3', 46650, 'Active', 'SMP'),
(75, 'KUOTA 10GB + SMS&Telp Sesama 30hr', 'INDOSAT DATA REGULER', 'IDN10', 83650, 'Active', 'SMP'),
(76, 'KUOTA 7GB + SMS Sesama 30hr', 'INDOSAT DATA REGULER', 'IDN7', 64150, 'Active', 'SMP'),
(77, 'KUOTA 15GB + SMS&Telp Sesama 30hr', 'INDOSAT DATA REGULER', 'IDN15', 109850, 'Active', 'SMP'),
(78, 'KUOTA Unlimited + SMS&Telp Sesama 30hr', 'INDOSAT DATA REGULER', 'IDN99', 149475, 'Active', 'SMP'),
(79, '300 SMS sesama Isat + 100 SMS operator lain', 'INDOSAT SMS', 'I5S', 8425, 'Active', 'SMP'),
(80, '600 SMS sesama Isat + 200 SMS operator lain', 'INDOSAT SMS', 'I10S', 13925, 'Active', 'SMP'),
(81, '2000 SMS sesama Isat + 500 SMS operator lain', 'INDOSAT SMS', 'I25S', 30025, 'Active', 'SMP'),
(82, 'Telepon Sesama Isat (1000 menit, 1Hari)', 'INDOSAT TELEPON', 'IT1', 4460, 'Active', 'SMP'),
(83, 'Telepon Sesama Isat (300 menit, 7Hari)', 'INDOSAT TELEPON', 'IT2', 14460, 'Active', 'SMP'),
(84, 'INDOSAT TRANSFER PULSA 50000', 'INDOSAT TRANSFER PULSA', 'ITR50', 49525, 'Active', 'SMP'),
(85, 'INDOSAT TRANSFER PULSA 100000', 'INDOSAT TRANSFER PULSA', 'ITR100', 96525, 'Active', 'SMP'),
(86, 'iTunes Gift Card $10', 'iTunes Gift Card', 'ITN10', 147750, 'Active', 'SMP'),
(87, 'iTunes Gift Card $15', 'iTunes Gift Card', 'ITN15', 197750, 'Active', 'SMP'),
(88, 'iTunes Gift Card $25', 'iTunes Gift Card', 'ITN25', 327750, 'Active', 'SMP'),
(89, 'iTunes Gift Card $50', 'iTunes Gift Card', 'ITN50', 657750, 'Active', 'SMP'),
(90, 'iTunes Gift Card $100', 'iTunes Gift Card', 'ITN100', 1377750, 'Active', 'SMP'),
(91, 'ORANGE TV 50.000', 'ORANGE TV', 'OV50', 48750, 'Active', 'SMP'),
(92, 'ORANGE TV 80.000', 'ORANGE TV', 'OV80', 76350, 'Active', 'SMP'),
(93, 'ORANGE TV 100.000', 'ORANGE TV', 'OV100', 94750, 'Active', 'SMP'),
(94, 'ORANGE TV 150.000', 'ORANGE TV', 'OV150', 140750, 'Active', 'SMP'),
(95, 'ORANGE TV 300.000', 'ORANGE TV', 'OV300', 278750, 'Active', 'SMP'),
(96, 'ORANGE TV 1.000.000', 'ORANGE TV', 'OV1000', 922750, 'Active', 'SMP'),
(97, 'SMARTFREN 5000', 'SMARTFREN', 'SM5', 7350, 'Active', 'SMP'),
(98, 'SMARTFREN 10000', 'SMARTFREN', 'SM10', 12275, 'Active', 'SMP'),
(99, 'SMARTFREN 20000', 'SMARTFREN', 'SM20', 22100, 'Active', 'SMP'),
(100, 'SMARTFREN 25000', 'SMARTFREN', 'SM25', 27100, 'Active', 'SMP'),
(101, 'SMARTFREN 30000', 'SMARTFREN', 'SM30', 32175, 'Active', 'SMP'),
(102, 'SMARTFREN 50000', 'SMARTFREN', 'SM50', 51300, 'Active', 'SMP'),
(103, 'SMARTFREN 100000', 'SMARTFREN', 'SM100', 101100, 'Active', 'SMP'),
(104, 'SMARTFREN 60000', 'SMARTFREN', 'SM60', 61400, 'Active', 'SMP'),
(105, 'SMARTFREN 150000', 'SMARTFREN', 'SM150', 151100, 'Active', 'SMP'),
(106, 'SMARTFREN 200000', 'SMARTFREN', 'SM200', 201100, 'Active', 'SMP'),
(107, 'SMARTFREN 300000', 'SMARTFREN', 'SM300', 301100, 'Active', 'SMP'),
(108, 'SMARTFREN VOLUME 2GB + 2GB Malam 7Hr', 'SMARTFREN DATA VOLUME', 'SMV20', 22650, 'Active', 'SMP'),
(109, 'SMARTFREN VOLUME 4GB + 4GB Malam 14Hr', 'SMARTFREN DATA VOLUME', 'SMV30', 32450, 'Active', 'SMP'),
(110, 'SMARTFREN VOLUME 8GB + 8GB Malam 30Hr', 'SMARTFREN DATA VOLUME', 'SMV60', 61950, 'Active', 'SMP'),
(111, 'SMARTFREN VOLUME 15GB + 15GB Malam 30Hr', 'SMARTFREN DATA VOLUME', 'SMV100', 101050, 'Active', 'SMP'),
(112, 'SMARTFREN VOLUME 22.5GB + 22.5GB Malam 30Hr', 'SMARTFREN DATA VOLUME', 'SMV150', 150350, 'Active', 'SMP'),
(113, 'SMARTFREN VOLUME 30GB + 30GB Malam 30Hr', 'SMARTFREN DATA VOLUME', 'SMV200', 200350, 'Active', 'SMP'),
(114, 'WIFI ID-1Hari', 'SPEEDY (@WIFI ID)', 'WIFI1', 6625, 'Active', 'SMP'),
(115, 'WIFI ID-7Hari', 'SPEEDY (@WIFI ID)', 'WIFI7', 20725, 'Active', 'SMP'),
(116, 'WIFI ID-30Hari', 'SPEEDY (@WIFI ID)', 'WIFI30', 46725, 'Active', 'SMP'),
(117, 'TELKOMSEL 5000', 'TELKOMSEL', 'S5', 6950, 'Active', 'SMP'),
(118, 'TELKOMSEL 10000', 'TELKOMSEL', 'S10', 11995, 'Active', 'SMP'),
(119, 'TELKOMSEL 20000', 'TELKOMSEL', 'S20', 21900, 'Active', 'SMP'),
(120, 'TELKOMSEL 25000', 'TELKOMSEL', 'S25', 27075, 'Active', 'SMP'),
(121, 'TELKOMSEL 50000', 'TELKOMSEL', 'S50', 51375, 'Active', 'SMP'),
(122, 'TELKOMSEL 100000', 'TELKOMSEL', 'S100', 100000, 'Active', 'SMP'),
(123, 'TELKOMSEL 200000', 'TELKOMSEL', 'S200', 199775, 'Active', 'SMP'),
(124, 'TELKOMSEL 150000', 'TELKOMSEL', 'S150', 150635, 'Active', 'SMP'),
(125, 'TELKOMSEL 300000', 'TELKOMSEL', 'S300', 297175, 'Active', 'SMP'),
(126, 'TELKOMSEL 1000', 'TELKOMSEL', 'S1', 2100, 'Active', 'SMP'),
(127, '20MB-40MB 7hr', 'TELKOMSEL DATA', 'STG5', 7760, 'Active', 'SMP'),
(128, '50MB-110MB 7hr', 'TELKOMSEL DATA', 'STG10', 12600, 'Active', 'SMP'),
(129, '200MB-420MB 7hr', 'TELKOMSEL DATA', 'STG20', 21800, 'Active', 'SMP'),
(130, '800MB-1.5GB (+2GB VideoMax) 30hr', 'TELKOMSEL DATA', 'STG50', 51175, 'Active', 'SMP'),
(131, '2.5GB-4.5GB (+2GB VideoMax) 30hr', 'TELKOMSEL DATA', 'STG100', 98695, 'Active', 'SMP'),
(132, '270MB-750MB 30hr', 'TELKOMSEL DATA', 'STG25', 26925, 'Active', 'SMP'),
(133, 'AS 1GB 7Hr', 'TELKOMSEL DATA AS', 'SDA1', 32800, 'Active', 'SMP'),
(134, 'AS 1GB + 2GB VideoMax 30Hr', 'TELKOMSEL DATA AS', 'SDA2', 58400, 'Active', 'SMP'),
(135, 'AS 2GB+2GB 4G+2GB VideoMax 30Hr', 'TELKOMSEL DATA AS', 'SDA3', 83900, 'Active', 'SMP'),
(136, 'AS 4GB+3GB 4G+2GB VideoMax 30Hr', 'TELKOMSEL DATA AS', 'SDA4', 118900, 'Active', 'SMP'),
(137, 'AS 7GB+6GB 4G+2GB VideoMax 30Hr', 'TELKOMSEL DATA AS', 'SDA5', 178900, 'Active', 'SMP'),
(138, 'BULK 3GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB3', 64950, 'Active', 'SMP'),
(139, 'BULK 8GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB8', 86200, 'Active', 'SMP'),
(140, 'BULK 12GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB12', 98700, 'Active', 'SMP'),
(141, 'BULK 25GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB25', 155700, 'Active', 'SMP'),
(142, 'BULK 35GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB35', 190700, 'Active', 'SMP'),
(143, 'BULK 1GB + 2GB VideoMax 30hr', 'TELKOMSEL DATA BULK', 'SDB1', 39250, 'Active', 'SMP'),
(144, '200 SMS ke semua 1 hari', 'TELKOMSEL SMS', 'SS1', 3400, 'Active', 'SMP'),
(145, '1000 SMS ke semua 5 hari', 'TELKOMSEL SMS', 'SS5', 7275, 'Active', 'SMP'),
(146, 'Telepon Sesama Tsel (20 menit, 1Hari)', 'TELKOMSEL TELEPON', 'ST5', 8000, 'Active', 'SMP'),
(147, 'Telepon Sesama Tsel (50 menit, 3Hari)', 'TELKOMSEL TELEPON', 'ST10', 13075, 'Active', 'SMP'),
(148, 'Telepon Sesama Tsel (50 menit, 7Hari)', 'TELKOMSEL TELEPON', 'ST20', 22775, 'Active', 'SMP'),
(149, 'Telepon Sesama Tsel (50 menit + 200SMS,7Hari)', 'TELKOMSEL TELEPON', 'ST25', 28200, 'Active', 'SMP'),
(150, 'Telepon Sesama Tsel (200 menit, 30Hari)', 'TELKOMSEL TELEPON', 'ST50', 52550, 'Active', 'SMP'),
(151, 'Telepon Sesama Tsel (300 menit + 1000SMS, 30Hari)', 'TELKOMSEL TELEPON', 'ST100', 100350, 'Active', 'SMP'),
(152, 'TSEL TRANSFER PULSA 10000', 'TELKOMSEL TRANSFER PULSA', 'STR10', 13448, 'Active', 'SMP'),
(153, 'TSEL TRANSFER PULSA 20000', 'TELKOMSEL TRANSFER PULSA', 'STR20', 23129, 'Active', 'SMP'),
(154, 'TSEL TRANSFER PULSA 25000', 'TELKOMSEL TRANSFER PULSA', 'STR25', 27860, 'Active', 'SMP'),
(155, 'TSEL TRANSFER PULSA 50000', 'TELKOMSEL TRANSFER PULSA', 'STR50', 51110, 'Active', 'SMP'),
(156, 'TSEL TRANSFER PULSA 100000', 'TELKOMSEL TRANSFER PULSA', 'STR100', 99500, 'Active', 'SMP'),
(157, 'TSEL TRANSFER PULSA 5000', 'TELKOMSEL TRANSFER PULSA', 'STR5', 8925, 'Active', 'SMP'),
(158, 'THREE 1000', 'TRI', 'T1', 2000, 'Active', 'SMP'),
(159, 'THREE 2000', 'TRI', 'T2', 3487, 'Active', 'SMP'),
(160, 'THREE 3000', 'TRI', 'T3', 4490, 'Active', 'SMP'),
(161, 'THREE 4000', 'TRI', 'T4', 5700, 'Active', 'SMP'),
(162, 'THREE 5000', 'TRI', 'T5', 6875, 'Active', 'SMP'),
(163, 'THREE 6000', 'TRI', 'T6', 7870, 'Active', 'SMP'),
(164, 'THREE 7000', 'TRI', 'T7', 9746, 'Active', 'SMP'),
(165, 'THREE 8000', 'TRI', 'T8', 10728, 'Active', 'SMP'),
(166, 'THREE 9000', 'TRI', 'T9', 11711, 'Active', 'SMP'),
(167, 'THREE 10000', 'TRI', 'T10', 11892, 'Active', 'SMP'),
(168, 'THREE 20000', 'TRI', 'T20', 21935, 'Active', 'SMP'),
(169, 'THREE 30000', 'TRI', 'T30', 31895, 'Active', 'SMP'),
(170, 'THREE 40000', 'TRI', 'T40', 41825, 'Active', 'SMP'),
(171, 'THREE 50000', 'TRI', 'T50', 51425, 'Active', 'SMP'),
(172, 'THREE 75000', 'TRI', 'T75', 76238, 'Active', 'SMP'),
(173, 'THREE 100000', 'TRI', 'T100', 100000, 'Active', 'SMP'),
(174, 'THREE 150000', 'TRI', 'T150', 149750, 'Active', 'SMP'),
(175, 'THREE 25000', 'TRI', 'T25', 26865, 'Active', 'SMP'),
(176, 'KUOTA 5 GB 30hr', 'TRI DATA', 'TD5', 70800, 'Active', 'SMP'),
(177, 'KUOTA 8 GB 30hr', 'TRI DATA', 'TD8', 103975, 'Active', 'SMP'),
(178, 'KUOTA 1 GB 30hr', 'TRI DATA', 'TD1', 20775, 'Active', 'SMP'),
(179, 'KUOTA 2 GB 30hr', 'TRI DATA', 'TD2', 35600, 'Active', 'SMP'),
(180, 'KUOTA 3 GB 30hr', 'TRI DATA', 'TD3', 49800, 'Active', 'SMP'),
(181, 'KUOTA 4 GB 30hr', 'TRI DATA', 'TD4', 57500, 'Active', 'SMP'),
(182, 'KUOTA 6 GB 30hr', 'TRI DATA', 'TD6', 77975, 'Active', 'SMP'),
(183, 'KUOTA 10 GB 30hr', 'TRI DATA', 'TD10', 125475, 'Active', 'SMP'),
(184, 'BM 500MB + 1GB Lokal + 500MB Malam 30Hr', 'TRI DATA BM', 'TBM1', 18800, 'Active', 'SMP'),
(185, 'BM 1GB + 1,5GB Lokal + 500MB Malam 30Hr', 'TRI DATA BM', 'TBM3', 28800, 'Active', 'SMP'),
(186, 'CINTA 6GB 90Hr + 2GB Lokal + 3GB 4G + 19GB Weekend', 'TRI DATA CINTA', 'TDC6', 77800, 'Active', 'SMP'),
(187, 'CINTA 10GB 90Hr + 3GB Lokal + 5GB 4G + 30GB Weeken', 'TRI DATA CINTA', 'TDC10', 105100, 'Active', 'SMP'),
(188, 'GETMORE 2GB 60Hr + 4GB Lokal 30Hr', 'TRI DATA GETMORE', 'TGM2', 32950, 'Active', 'SMP'),
(189, 'GETMORE 3GB 60Hr + 6GB Lokal 30Hr', 'TRI DATA GETMORE', 'TGM3', 40200, 'Active', 'SMP'),
(190, 'GETMORE 5GB 60Hr + 10GB Lokal 30Hr', 'TRI DATA GETMORE', 'TGM5', 56100, 'Active', 'SMP'),
(191, 'REGULER 20MB', 'TRI DATA REGULER', 'TDR20', 4525, 'Active', 'SMP'),
(192, 'REGULER 80MB', 'TRI DATA REGULER', 'TDR80', 7400, 'Active', 'SMP'),
(193, 'REGULER 300MB', 'TRI DATA REGULER', 'TDR30', 12300, 'Active', 'SMP'),
(194, 'REGULER 1.25GB', 'TRI DATA REGULER', 'TDR12', 35200, 'Active', 'SMP'),
(195, 'REGULER 650MB', 'TRI DATA REGULER', 'TDR65', 21625, 'Active', 'SMP'),
(196, 'REGULER 4.25GB', 'TRI DATA REGULER', 'TDR42', 81025, 'Active', 'SMP'),
(197, '2GB 30 HARI + EKSTRA KUOTA', 'TRI KUOTA BULANAN', 'TB2', 37600, 'Active', 'SMP'),
(198, '5GB 30 HARI + EKSTRA 10GB', 'TRI KUOTA BULANAN', 'TB5', 73250, 'Active', 'SMP'),
(199, '6GB 30 HARI + EKSTRA KUOTA', 'TRI KUOTA BULANAN', 'TB6', 80400, 'Active', 'SMP'),
(200, '10GB 30 HARI + EKSTRA KUOTA', 'TRI KUOTA BULANAN', 'TB10', 125500, 'Active', 'SMP'),
(201, 'Telepon 20menit 7Hr All Operator', 'TRI TELEPON', 'TT5', 7025, 'Active', 'SMP'),
(202, 'Telepon 60menit 30Hr All Operator', 'TRI TELEPON', 'TT15', 16525, 'Active', 'SMP'),
(203, 'Telepon 150menit 30Hr All Operator', 'TRI TELEPON', 'TT30', 30575, 'Active', 'SMP'),
(204, 'TRI TRANSFER PULSA 5k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR5', 7425, 'Active', 'SMP'),
(205, 'TRI TRANSFER PULSA 10k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR10', 12075, 'Active', 'SMP'),
(206, 'TRI TRANSFER PULSA 20k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR20', 21375, 'Active', 'SMP'),
(207, 'TRI TRANSFER PULSA 30k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR30', 31050, 'Active', 'SMP'),
(208, 'TRI TRANSFER PULSA 50k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR50', 51700, 'Active', 'SMP'),
(209, 'TRI TRANSFER PULSA 100k + Masa Aktif', 'TRI TRANSFER PULSA', 'TTR100', 97750, 'Active', 'SMP'),
(210, 'XL REGULER 5000', 'XL', 'X5', 7000, 'Active', 'SMP'),
(211, 'XL REGULER 10000', 'XL', 'X10', 12870, 'Active', 'SMP'),
(212, 'XL REGULER 25000', 'XL', 'X25', 27075, 'Active', 'SMP'),
(213, 'XL REGULER 50000', 'XL', 'X50', 51625, 'Active', 'SMP'),
(214, 'XL REGULER 100000', 'XL', 'X100', 100750, 'Active', 'SMP'),
(215, 'XL REGULER 15000', 'XL', 'X15', 17345, 'Active', 'SMP'),
(216, 'XL REGULER 30000', 'XL', 'X30', 32250, 'Active', 'SMP'),
(217, 'COMBO XTRA 5GB+5GB ytb+20Mnt 30Hr', 'XL INTERNET COMBO XTRA', 'XCX5', 54243, 'Active', 'SMP'),
(218, 'COMBO XTRA 10GB+10GB ytb+40mnt 30Hr', 'XL INTERNET COMBO XTRA', 'XCX10', 79930, 'Active', 'SMP'),
(219, 'COMBO XTRA 15GB+15GB ytb+60mnt 30hr', 'XL INTERNET COMBO XTRA', 'XCX15', 114179, 'Active', 'SMP'),
(220, 'COMBO XTRA 20GB+20GB ytb+60mnt 30hr', 'XL INTERNET COMBO XTRA', 'XCX20', 156991, 'Active', 'SMP'),
(221, 'COMBO XTRA 35GB+35GB ytb+60mnt, 30hr', 'XL INTERNET COMBO XTRA', 'XCX35', 208365, 'Active', 'SMP'),
(222, 'HotRod 24Jam, 30hr, 800MB', 'XL INTERNET HOTROD', 'XH30', 30764, 'Active', 'SMP'),
(223, 'HotRod 24Jam, 30hr, 3GB', 'XL INTERNET HOTROD', 'XH54', 55099, 'Active', 'SMP'),
(224, 'HotRod 24Jam, 30hr, 6GB', 'XL INTERNET HOTROD', 'XH90', 89348, 'Active', 'SMP'),
(225, 'HotRod 24Jam, 30hr, 8GB', 'XL INTERNET HOTROD', 'XH117', 115035, 'Active', 'SMP'),
(226, 'HotRod 24Jam, 30hr, 12GB', 'XL INTERNET HOTROD', 'XH162', 157847, 'Active', 'SMP'),
(227, 'HotRod 24Jam, 30hr, 16GB', 'XL INTERNET HOTROD', 'XH198', 192096, 'Active', 'SMP'),
(228, 'HotRod 24Jam, 30hr, 1.5GB', 'XL INTERNET HOTROD', 'XH45', 46537, 'Active', 'SMP'),
(229, 'Telepon 350mnt Sesama+50mnt ALL 7Hr', 'XL TELEPON', 'XT1', 12925, 'Active', 'SMP'),
(230, 'Telepon 200mnt Sesama 14Hr', 'XL TELEPON', 'XT2', 17000, 'Active', 'SMP'),
(231, 'Telepon 500mnt Sesama 30Hr', 'XL TELEPON', 'XT3', 34125, 'Active', 'SMP'),
(232, 'Telepon 200mnt Sesama+400sms Sesama 30Hr', 'XL TELEPON', 'XT4', 34125, 'Active', 'SMP'),
(233, 'Telepon 300mnt ALL 30Hr', 'XL TELEPON', 'XT5', 67675, 'Active', 'SMP'),
(234, 'Voucher PLN 20000', 'PLN', 'PLN20', 22525, 'Active', 'SMP'),
(235, 'Voucher PLN 50000', 'PLN', 'PLN50', 52525, 'Active', 'SMP'),
(236, 'Voucher PLN 100000', 'PLN', 'PLN100', 102525, 'Active', 'SMP'),
(237, 'Voucher PLN 200000', 'PLN', 'PLN200', 202525, 'Active', 'SMP'),
(238, 'Voucher PLN 500000', 'PLN', 'PLN500', 502525, 'Active', 'SMP'),
(239, 'Voucher PLN 1000000', 'PLN', 'PLN1000', 1002525, 'Active', 'SMP'),
(240, 'Game facebook - Boyaa Poker Voucher 50.000', 'GAME', 'BP50', 47750, 'Active', 'SMP'),
(241, 'Game facebook - Boyaa Poker Voucher 100.000', 'GAME', 'BP100', 92750, 'Active', 'SMP'),
(242, 'BSF Voucher 5.000', 'GAME', 'BSF5', 7250, 'Active', 'SMP'),
(243, 'BSF Voucher 10.000', 'GAME', 'BSF10', 11750, 'Active', 'SMP'),
(244, 'BSF Voucher 25.000', 'GAME', 'BSF25', 25250, 'Active', 'SMP'),
(245, 'BSF Voucher 50.000', 'GAME', 'BSF50', 47750, 'Active', 'SMP'),
(246, 'BSF Voucher 100.000', 'GAME', 'BSF100', 92750, 'Active', 'SMP'),
(247, 'BSF Voucher 500.000', 'GAME', 'BSF500', 452750, 'Active', 'SMP'),
(248, 'Cabal Online 3000 Gold', 'GAME', 'CBL3', 30350, 'Active', 'SMP'),
(249, 'Cabal Online 5000 Gold', 'GAME', 'CBL5', 48750, 'Active', 'SMP'),
(250, 'Cabal Online 10000 Gold', 'GAME', 'CBL10', 94750, 'Active', 'SMP'),
(251, 'e-PINS 5000 Cherry Credits', 'GAME', 'CRY5', 47750, 'Active', 'SMP'),
(252, 'e-PINS 10000 Cherry Credits', 'GAME', 'CRY10', 92750, 'Active', 'SMP'),
(253, 'e-PINS 14000 Cherry Credits', 'GAME', 'CRY14', 120850, 'Active', 'SMP'),
(254, 'e-PINS 20000 Cherry Credits', 'GAME', 'CRY20', 171250, 'Active', 'SMP'),
(255, 'Game Faveo Voucher 20000', 'GAME', 'FAV20', 20750, 'Active', 'SMP'),
(256, 'Game Faveo Voucher 50000', 'GAME', 'FAV50', 47750, 'Active', 'SMP'),
(257, 'Game Faveo Voucher 100000', 'GAME', 'FAV100', 92750, 'Active', 'SMP'),
(258, 'Facebook Game Card - 30000', 'GAME', 'FBG30', 32000, 'Active', 'SMP'),
(259, 'Facebook Game Card - 50000', 'GAME', 'FBG50', 50900, 'Active', 'SMP'),
(260, 'Facebook Game Card - 100000', 'GAME', 'FBG100', 99050, 'Active', 'SMP'),
(261, 'Voucher Fastblack 40 OP', 'GAME', 'FSB40', 11750, 'Active', 'SMP'),
(262, 'Voucher Fastblack 100 OP', 'GAME', 'FSB100', 25250, 'Active', 'SMP'),
(263, 'Voucher Fastblack 200 OP', 'GAME', 'FSB200', 47750, 'Active', 'SMP'),
(264, 'Voucher Fastblack 400 OP', 'GAME', 'FSB400', 92750, 'Active', 'SMP'),
(265, 'ASIASOFT - 1.000-cash', 'GAME', 'GA10', 11750, 'Active', 'SMP'),
(266, 'ASIASOFT - 2.000-cash', 'GAME', 'GA20', 20750, 'Active', 'SMP'),
(267, 'ASIASOFT - 5.000-cash', 'GAME', 'GA50', 47750, 'Active', 'SMP'),
(268, 'ASIASOFT - 10.000-cash', 'GAME', 'GA100', 92750, 'Active', 'SMP'),
(269, 'game Magic Campus - 55 Dasa Coin', 'GAME', 'GD10', 11950, 'Active', 'SMP'),
(270, 'game Magic Campus - 110 Dasa Coin', 'GAME', 'GD20', 21150, 'Active', 'SMP'),
(271, 'game Magic Campus - 275 Dasa Coin', 'GAME', 'GD50', 48750, 'Active', 'SMP'),
(272, 'game Magic Campus - 550 Dasa Coin', 'GAME', 'GD100', 94750, 'Active', 'SMP'),
(273, '60 Mall Coin', 'GAME', 'GES10', 12250, 'Active', 'SMP'),
(274, '121 Mall Coin', 'GAME', 'GES20', 21750, 'Active', 'SMP'),
(275, '309 Mall Coin', 'GAME', 'GES50', 50250, 'Active', 'SMP'),
(276, '624 Mall Coin', 'GAME', 'GES100', 97750, 'Active', 'SMP'),
(277, 'Voucher GOGAME 20.000', 'GAME', 'GGM20', 23950, 'Active', 'SMP'),
(278, 'Voucher GOGAME 50.000', 'GAME', 'GGM50', 55550, 'Active', 'SMP'),
(279, 'Voucher GOGAME 100.000', 'GAME', 'GGM100', 108250, 'Active', 'SMP'),
(280, 'Voucher GOGAME 200.000', 'GAME', 'GGM200', 212950, 'Active', 'SMP'),
(281, '10.000 iCredits IAH Games', 'GAME', 'GIH10', 11750, 'Active', 'SMP'),
(282, '20.000 iCredits IAH Games', 'GAME', 'GIH20', 20750, 'Active', 'SMP'),
(283, '50.000 iCredits IAH Games', 'GAME', 'GIH50', 47750, 'Active', 'SMP'),
(284, '100.000 iCredits IAH Games', 'GAME', 'GIH100', 92750, 'Active', 'SMP'),
(285, 'Showtime karaoke 40 inCash', 'GAME', 'GIN10', 11750, 'Active', 'SMP'),
(286, 'Showtime karaoke 80 inCash', 'GAME', 'GIN20', 20750, 'Active', 'SMP'),
(287, 'Showtime karaoke 200 inCash', 'GAME', 'GIN50', 47750, 'Active', 'SMP'),
(288, 'Showtime karaoke 400 inCash', 'GAME', 'GIN100', 92750, 'Active', 'SMP'),
(289, 'MatchMove 50 Mcash', 'GAME', 'GMM5', 7250, 'Active', 'SMP'),
(290, 'MatchMove 100 Mcash', 'GAME', 'GMM10', 11750, 'Active', 'SMP'),
(291, 'MatchMove 250 Mcash', 'GAME', 'GMM25', 25250, 'Active', 'SMP'),
(292, 'MatchMove 490 Mcash', 'GAME', 'GMM50', 47750, 'Active', 'SMP'),
(293, 'MatchMove 980 Mcash', 'GAME', 'GMM100', 92750, 'Active', 'SMP'),
(294, 'MatchMove 1160 Mcash', 'GAME', 'GMM200', 182750, 'Active', 'SMP'),
(295, 'Voucher Gemscool 1.000 G-cash', 'GAME', 'GMS1', 12050, 'Active', 'SMP'),
(296, 'Voucher Gemscool 2.000 G-cash', 'GAME', 'GMS2', 21600, 'Active', 'SMP'),
(297, 'Voucher Gemscool 3.000 G-cash', 'GAME', 'GMS3', 31150, 'Active', 'SMP'),
(298, 'Voucher Gemscool 5.000 G-cash', 'GAME', 'GMS5', 50250, 'Active', 'SMP'),
(299, 'Voucher Gemscool 10.000 G-cash', 'GAME', 'GMS10', 98250, 'Active', 'SMP'),
(300, 'Voucher Gemscool 20.000 G-cash', 'GAME', 'GMS20', 195250, 'Active', 'SMP'),
(301, 'Voucher Gemscool 30.000 G-cash', 'GAME', 'GMS30', 291250, 'Active', 'SMP'),
(302, '1.000 O-cash OrangeGame', 'GAME', 'GOG10', 11950, 'Active', 'SMP'),
(303, '3.000 O-cash OrangeGame', 'GAME', 'GOG30', 30350, 'Active', 'SMP'),
(304, '5.000 O-cash OrangeGame', 'GAME', 'GOG50', 48750, 'Active', 'SMP'),
(305, '10.000 O-cash OrangeGame', 'GAME', 'GOG100', 94750, 'Active', 'SMP'),
(306, '26.000 Playpoint-Playon', 'GAME', 'GPY10', 11750, 'Active', 'SMP'),
(307, '78.000 Playpoint-Playon', 'GAME', 'GPY30', 29750, 'Active', 'SMP'),
(308, '130.000 Playpoint-Playon', 'GAME', 'GPY50', 47750, 'Active', 'SMP'),
(309, '260.000 Playpoint-Playon', 'GAME', 'GPY100', 92750, 'Active', 'SMP'),
(310, 'Voucher Qash 2.300', 'GAME', 'GQ10', 12150, 'Active', 'SMP'),
(311, 'Voucher Qash 6.900', 'GAME', 'GQ30', 30950, 'Active', 'SMP'),
(312, 'Voucher Qash 11.500', 'GAME', 'GQ50', 49750, 'Active', 'SMP'),
(313, 'Voucher Qash 23.000', 'GAME', 'GQ100', 96750, 'Active', 'SMP'),
(314, 'Voucher Qash 69.000', 'GAME', 'GQ300', 272750, 'Active', 'SMP'),
(315, 'Voucher Qash 115.000', 'GAME', 'GQ500', 452750, 'Active', 'SMP'),
(316, 'Voucher Qash 230.000', 'GAME', 'GQ1000', 902750, 'Active', 'SMP'),
(317, 'GARENA v100 = 333 Shell', 'GAME', 'GR100', 93725, 'Active', 'SMP'),
(318, 'GARENA v20 = 66 Shell', 'GAME', 'GR20', 20950, 'Active', 'SMP'),
(319, 'GARENA v50 = 166 Shell', 'GAME', 'GR50', 48250, 'Active', 'SMP'),
(320, 'GARENA v10 = 33 Shell', 'GAME', 'GR10', 11850, 'Active', 'SMP'),
(321, 'RappelzOnline - 1.000 Rappelz Point', 'GAME', 'GRB10', 11950, 'Active', 'SMP'),
(322, 'RappelzOnline - 2.000 Rappelz Point', 'GAME', 'GRB20', 21150, 'Active', 'SMP'),
(323, 'RappelzOnline - 5.000 Rappelz Point', 'GAME', 'GRB50', 48750, 'Active', 'SMP'),
(324, 'RappelzOnline - 10.000 Rappelz Point', 'GAME', 'GRB100', 94750, 'Active', 'SMP'),
(325, '1.000 Tera - TS2', 'GAME', 'GTA10', 11750, 'Active', 'SMP'),
(326, '2.000 Tera - TS2', 'GAME', 'GTA20', 20750, 'Active', 'SMP'),
(327, '3.000 Tera - TS2', 'GAME', 'GTA30', 29750, 'Active', 'SMP'),
(328, '5.000 Tera - TS2', 'GAME', 'GTA50', 47750, 'Active', 'SMP'),
(329, '10.000 Tera - TS2', 'GAME', 'GTA100', 92750, 'Active', 'SMP'),
(330, '20.000 Tera - TS2', 'GAME', 'GTA200', 182750, 'Active', 'SMP'),
(331, '30.000 Tera - TS2', 'GAME', 'GTA300', 272750, 'Active', 'SMP'),
(332, 'Gamewave Voucher 150 V-Cash', 'GAME', 'GW15', 47750, 'Active', 'SMP'),
(333, 'Gamewave Voucher 300 V-Cash', 'GAME', 'GW30', 92750, 'Active', 'SMP'),
(334, 'Gamewave Voucher 600 V-Cash', 'GAME', 'GW60', 182750, 'Active', 'SMP'),
(335, 'Gamewave Voucher 1500 V-Cash', 'GAME', 'GW150', 452750, 'Active', 'SMP'),
(336, 'Gamewave Voucher 3000 V-Cash', 'GAME', 'GW300', 902750, 'Active', 'SMP'),
(337, 'Gameweb Voucher 20.000', 'GAME', 'GWV20', 21150, 'Active', 'SMP'),
(338, 'Gameweb Voucher 50.000', 'GAME', 'GWV50', 48750, 'Active', 'SMP'),
(339, 'Gameweb Voucher 100.000', 'GAME', 'GWV100', 94750, 'Active', 'SMP'),
(340, 'Playstation Store Prepaid Card v100', 'GAME', 'ID100', 145250, 'Active', 'SMP'),
(341, 'Playstation Store Prepaid Card v200', 'GAME', 'ID200', 287750, 'Active', 'SMP'),
(342, 'Playstation Store Prepaid Card v400', 'GAME', 'ID400', 572750, 'Active', 'SMP'),
(343, 'Game facebook - Joombi Voucher 100.000', 'GAME', 'JM100', 92750, 'Active', 'SMP'),
(344, 'Koram Game Voucher 10000', 'GAME', 'KRM10', 13450, 'Active', 'SMP'),
(345, 'Koram Game Voucher 50000', 'GAME', 'KRM50', 55550, 'Active', 'SMP'),
(346, 'Koram Game Voucher 100000', 'GAME', 'KRM100', 108250, 'Active', 'SMP'),
(347, 'Koram Game Voucher 200000', 'GAME', 'KRM200', 213050, 'Active', 'SMP'),
(348, 'Koram Game Voucher 500000', 'GAME', 'KRM500', 526750, 'Active', 'SMP'),
(349, 'Koram Game Voucher 1000000', 'GAME', 'KRM1000', 1049750, 'Active', 'SMP'),
(350, 'kiwi card Online Voucher 10.000', 'GAME', 'KW10', 12050, 'Active', 'SMP'),
(351, 'kiwi card Online Voucher 20.000', 'GAME', 'KW20', 21350, 'Active', 'SMP'),
(352, 'kiwi card Online Voucher 30.000', 'GAME', 'KW30', 30650, 'Active', 'SMP'),
(353, 'kiwi card Online Voucher 50.000', 'GAME', 'KW50', 49250, 'Active', 'SMP'),
(354, 'kiwi card Online Voucher 100.000', 'GAME', 'KW100', 95750, 'Active', 'SMP'),
(355, 'kiwi card Online Voucher 200.000', 'GAME', 'KW200', 188750, 'Active', 'SMP'),
(356, 'kiwi card Online Voucher 300.000', 'GAME', 'KW300', 281750, 'Active', 'SMP'),
(357, '2500 KOIN LYTO', 'GAME', 'LYT10', 12450, 'Active', 'SMP'),
(358, '5500 KOIN LYTO', 'GAME', 'LYT20', 22150, 'Active', 'SMP'),
(359, '10000 KOIN LYTO', 'GAME', 'LYT35', 36700, 'Active', 'SMP'),
(360, '20000 KOIN LYTO', 'GAME', 'LYT65', 65800, 'Active', 'SMP'),
(361, '57000 KOIN LYTO', 'GAME', 'LYT175', 172500, 'Active', 'SMP'),
(362, 'KOIN LYTO Voucher 500', 'GAME', 'LYT500', 487750, 'Active', 'SMP'),
(363, 'Voucher Mainkan.com 5.000 I-poin', 'GAME', 'MAIN5', 8075, 'Active', 'SMP'),
(364, 'Voucher Mainkan.com 10.000 I-poin', 'GAME', 'MAIN10', 13450, 'Active', 'SMP'),
(365, 'Voucher Mainkan.com 25.000 I-poin', 'GAME', 'MAIN25', 29225, 'Active', 'SMP'),
(366, 'Voucher Mainkan.com 50.000 I-poin', 'GAME', 'MAIN50', 55550, 'Active', 'SMP'),
(367, 'Voucher Mainkan.com 100.000 I-poin', 'GAME', 'MAIN100', 108250, 'Active', 'SMP'),
(368, 'Mobius - Voucher 10', 'GAME', 'MB10', 11750, 'Active', 'SMP'),
(369, 'Mobius - Voucher 30', 'GAME', 'MB30', 29750, 'Active', 'SMP'),
(370, 'Mobius - Voucher 50', 'GAME', 'MB50', 47750, 'Active', 'SMP'),
(371, 'Mobius - Voucher 100', 'GAME', 'MB100', 92750, 'Active', 'SMP'),
(372, 'Mobius - Voucher 200', 'GAME', 'MB200', 182750, 'Active', 'SMP'),
(373, 'MOGCAZ - 50000', 'GAME', 'MGC50', 52750, 'Active', 'SMP'),
(374, 'MOGCAZ - 100000', 'GAME', 'MGC100', 102750, 'Active', 'SMP'),
(375, 'MOGCAZ - 200000', 'GAME', 'MGC200', 202750, 'Active', 'SMP'),
(376, 'Voucher Megaxus 10.000', 'GAME', 'MGX10', 12760, 'Active', 'SMP'),
(377, 'Voucher Megaxus 20.000', 'GAME', 'MGX20', 22770, 'Active', 'SMP'),
(378, 'Voucher Megaxus 50.000', 'GAME', 'MGX50', 52800, 'Active', 'SMP'),
(379, 'Voucher Megaxus 100.000', 'GAME', 'MGX100', 102850, 'Active', 'SMP'),
(380, 'Voucher Megaxus 200.000', 'GAME', 'MGX200', 202950, 'Active', 'SMP'),
(381, 'Voucher Megaxus 500.000', 'GAME', 'MGX500', 503250, 'Active', 'SMP'),
(382, 'MOGPLAY 20.000', 'GAME', 'MOG20', 20750, 'Active', 'SMP'),
(383, 'MOGPLAY 50.000', 'GAME', 'MOG50', 48275, 'Active', 'SMP'),
(384, 'MOGPLAY 100.000', 'GAME', 'MOG100', 93775, 'Active', 'SMP'),
(385, 'MOGPLAY 200.000', 'GAME', 'MOG200', 184775, 'Active', 'SMP'),
(386, 'MOGPLAY 500.000', 'GAME', 'MOG500', 454775, 'Active', 'SMP'),
(387, '100 MOL Point', 'GAME', 'MOL10', 13200, 'Active', 'SMP'),
(388, '200 MOL Point', 'GAME', 'MOL20', 23650, 'Active', 'SMP'),
(389, '500 MOL Point', 'GAME', 'MOL50', 55000, 'Active', 'SMP'),
(390, '1000 MOL Point', 'GAME', 'MOL100', 107250, 'Active', 'SMP'),
(391, '2000 MOL Point', 'GAME', 'MOL200', 211750, 'Active', 'SMP'),
(392, 'Metin 2 Voucher 60.000', 'GAME', 'MTN60', 56750, 'Active', 'SMP'),
(393, 'Metin 2 Voucher 120.000', 'GAME', 'MTN120', 110750, 'Active', 'SMP'),
(394, 'Metin 2 Voucher 285.000', 'GAME', 'MTN285', 259250, 'Active', 'SMP'),
(395, 'Metin 2 Voucher 545.000', 'GAME', 'MTN545', 493250, 'Active', 'SMP'),
(396, 'MyCard 50 Points', 'GAME', 'MYC50', 27203, 'Active', 'SMP'),
(397, 'MyCard 150 Points', 'GAME', 'MYC150', 75680, 'Active', 'SMP'),
(398, 'MyCard 350 Points', 'GAME', 'MYC350', 165770, 'Active', 'SMP'),
(399, 'MyCard 450 Points', 'GAME', 'MYC450', 212960, 'Active', 'SMP'),
(400, 'MyCard 1000 Points', 'GAME', 'MYC1000', 466070, 'Active', 'SMP'),
(401, 'Playcircle Voucher 10.000', 'GAME', 'PLC10', 11750, 'Active', 'SMP'),
(402, 'Playcircle Voucher 30.000', 'GAME', 'PLC30', 29750, 'Active', 'SMP'),
(403, 'Playcircle Voucher 50.000', 'GAME', 'PLC50', 47750, 'Active', 'SMP'),
(404, 'Playcircle Voucher 100.000', 'GAME', 'PLC100', 92750, 'Active', 'SMP'),
(405, 'Playfish Coupon 20.000', 'GAME', 'PLF20', 20750, 'Active', 'SMP'),
(406, 'Playfish Coupon 50.000', 'GAME', 'PLF50', 47750, 'Active', 'SMP'),
(407, 'Playfish Coupon 100.000', 'GAME', 'PLF100', 92750, 'Active', 'SMP'),
(408, 'Voucher Playpoint 26000', 'GAME', 'PLP26', 11750, 'Active', 'SMP'),
(409, 'Voucher Playpoint 78000', 'GAME', 'PLP78', 29750, 'Active', 'SMP'),
(410, 'Voucher Playpoint 130000', 'GAME', 'PLP130', 47750, 'Active', 'SMP'),
(411, 'Voucher Playpoint 260000', 'GAME', 'PLP260', 92750, 'Active', 'SMP'),
(412, 'Game facebook - Pool Live Tour Voucher 20.000', 'GAME', 'PLT20', 20750, 'Active', 'SMP'),
(413, 'Game Facebook Pico World Voucher 20.000', 'GAME', 'PW20', 20750, 'Active', 'SMP'),
(414, 'Game Facebook - Joombi Voucher 20.000', 'GAME', 'JM20', 20750, 'Active', 'SMP'),
(415, 'Game Facebook Boyaa Poker Voucher 20.000', 'GAME', 'BP20', 20750, 'Active', 'SMP'),
(416, 'Game facebook - Pool Live Tour Voucher 50.000', 'GAME', 'PLT50', 47750, 'Active', 'SMP'),
(417, 'Game facebook - Pico World Voucher 50.000', 'GAME', 'PW50', 47750, 'Active', 'SMP'),
(418, 'Game facebook - Joombi Voucher 50.000', 'GAME', 'JM50', 47750, 'Active', 'SMP'),
(419, 'Game facebook - Pool Live Tour Voucher 100.000', 'GAME', 'PLT100', 92750, 'Active', 'SMP'),
(420, 'Game facebook - Pico World Voucher 100.000', 'GAME', 'PW100', 92750, 'Active', 'SMP'),
(421, 'Playnexia 25.000', 'GAME', 'PYN25', 25250, 'Active', 'SMP'),
(422, 'Playnexia 50.000', 'GAME', 'PYN50', 47750, 'Active', 'SMP'),
(423, 'Playnexia 100.000', 'GAME', 'PYN100', 92750, 'Active', 'SMP'),
(424, 'Playnexia 200.000', 'GAME', 'PYN200', 182750, 'Active', 'SMP'),
(425, 'Game Softnyx Voucher 20000', 'GAME', 'SOF20', 20750, 'Active', 'SMP'),
(426, 'Game Softnyx Voucher 50000', 'GAME', 'SOF50', 47750, 'Active', 'SMP'),
(427, 'Game Softnyx Voucher 100000', 'GAME', 'SOF100', 92750, 'Active', 'SMP'),
(428, 'Spin voucher 2500', 'GAME', 'SPN2', 5500, 'Active', 'SMP'),
(429, 'Spin voucher 10000', 'GAME', 'SPN10', 13650, 'Active', 'SMP'),
(430, 'Spin voucher 20000', 'GAME', 'SPN20', 24600, 'Active', 'SMP'),
(431, 'Spin voucher 30000', 'GAME', 'SPN30', 35500, 'Active', 'SMP'),
(432, 'Spin voucher 50000', 'GAME', 'SPN50', 57200, 'Active', 'SMP'),
(433, 'Spin voucher 100000', 'GAME', 'SPN100', 111550, 'Active', 'SMP'),
(434, 'Serenity Voucher 2500 Koin', 'GAME', 'SRT2', 11850, 'Active', 'SMP'),
(435, 'Serenity Voucher 8000 Koin', 'GAME', 'SRT8', 30050, 'Active', 'SMP'),
(436, 'Serenity Voucher 15000 Koin', 'GAME', 'SRT15', 48250, 'Active', 'SMP'),
(437, 'Serenity Voucher 30000 Koin', 'GAME', 'SRT30', 93750, 'Active', 'SMP'),
(438, 'STEAM - 12000', 'GAME', 'STE12', 17425, 'Active', 'SMP'),
(439, 'STEAM - 45000', 'GAME', 'STE45', 56250, 'Active', 'SMP'),
(440, 'STEAM - 60000', 'GAME', 'STE60', 74990, 'Active', 'SMP'),
(441, 'STEAM - 120000', 'GAME', 'STE120', 146250, 'Active', 'SMP'),
(442, 'STEAM - 250000', 'GAME', 'STE250', 296300, 'Active', 'SMP'),
(443, 'STEAM - 600000', 'GAME', 'STE600', 720750, 'Active', 'SMP'),
(444, 'STEAM - 400000', 'GAME', 'STE400', 479750, 'Active', 'SMP'),
(445, 'Travian Voucher 27.000', 'GAME', 'TRV27', 37750, 'Active', 'SMP'),
(446, 'Travian Voucher 63.500', 'GAME', 'TRV63', 87250, 'Active', 'SMP'),
(447, 'Travian Voucher 137.500', 'GAME', 'TRV137', 184750, 'Active', 'SMP'),
(448, 'Travian Voucher 265.000', 'GAME', 'TRV265', 353750, 'Active', 'SMP'),
(449, 'Ultimate Game Card 250 Points', 'GAME', 'UGC25', 27750, 'Active', 'SMP'),
(450, 'Ultimate Game Card 500 Points', 'GAME', 'UGC50', 63950, 'Active', 'SMP'),
(451, 'Ultimate Game Card 1.000 Points', 'GAME', 'UGC100', 125250, 'Active', 'SMP'),
(452, 'Ultimate Game Card 2.000 Points', 'GAME', 'UGC200', 241750, 'Active', 'SMP'),
(453, 'UNIPIN VOUCHER 10000', 'GAME', 'UNI10', 12075, 'Active', 'SMP'),
(454, 'UNIPIN VOUCHER 20000', 'GAME', 'UNI20', 21775, 'Active', 'SMP'),
(455, 'UNIPIN VOUCHER 50000', 'GAME', 'UNI50', 50675, 'Active', 'SMP'),
(456, 'UNIPIN VOUCHER 100000', 'GAME', 'UNI100', 98775, 'Active', 'SMP'),
(457, 'UNIPIN VOUCHER 300000', 'GAME', 'UNI300', 290275, 'Active', 'SMP'),
(458, 'UNIPIN VOUCHER 500000', 'GAME', 'UNI500', 483275, 'Active', 'SMP'),
(459, 'VTC Online 5 Vcoin', 'GAME', 'VTC5', 7250, 'Active', 'SMP'),
(460, 'VTC Online 20 Vcoin', 'GAME', 'VTC20', 11750, 'Active', 'SMP'),
(461, 'VTC Online 40 Vcoin', 'GAME', 'VTC40', 20750, 'Active', 'SMP'),
(462, 'VTC Online 60 Vcoin', 'GAME', 'VTC60', 29750, 'Active', 'SMP'),
(463, 'VTC Online 100 Vcoin', 'GAME', 'VTC100', 47750, 'Active', 'SMP'),
(464, 'VTC Online 200 Vcoin', 'GAME', 'VTC200', 92750, 'Active', 'SMP'),
(465, 'Viwawa Voucher 15.000', 'GAME', 'VW15', 16250, 'Active', 'SMP'),
(466, 'Viwawa Voucher 30.000', 'GAME', 'VW30', 29750, 'Active', 'SMP'),
(467, 'Viwawa Voucher 60.000', 'GAME', 'VW60', 56750, 'Active', 'SMP'),
(468, 'Winner Card 4.000 GP', 'GAME', 'WIN4', 8150, 'Active', 'SMP'),
(469, 'Winner Card 8.000 GP', 'GAME', 'WIN8', 13650, 'Active', 'SMP'),
(470, 'Winner Card 16.000 GP', 'GAME', 'WIN16', 24250, 'Active', 'SMP'),
(471, 'Winner Card 24.000 GP', 'GAME', 'WIN24', 35000, 'Active', 'SMP'),
(472, 'Winner Card 40.000 GP', 'GAME', 'WIN40', 56375, 'Active', 'SMP'),
(473, 'Winner Card 80.000 GP', 'GAME', 'WIN80', 109900, 'Active', 'SMP'),
(474, 'Winner Card 160.000 GP', 'GAME', 'WIN160', 216050, 'Active', 'SMP'),
(475, 'Voucher Wavegame 40 Coin', 'GAME', 'WVP10', 11750, 'Active', 'SMP'),
(476, 'Voucher Wavegame 82 Coin', 'GAME', 'WVP20', 20750, 'Active', 'SMP'),
(477, 'Voucher Wavegame 210 Coin', 'GAME', 'WVP50', 47750, 'Active', 'SMP'),
(478, 'Voucher Wavegame 435 Coin', 'GAME', 'WVP100', 92750, 'Active', 'SMP'),
(479, 'Voucher Wavegame 1088 Coin', 'GAME', 'WVP250', 227750, 'Active', 'SMP'),
(480, 'ZYNGA 20.000', 'GAME', 'ZNG20', 28750, 'Active', 'SMP'),
(481, 'ZYNGA 100.000', 'GAME', 'ZNG100', 132750, 'Active', 'SMP');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_pulsa_cat`
--

CREATE TABLE `services_pulsa_cat` (
  `id` int(11) NOT NULL,
  `name` int(100) NOT NULL,
  `code` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `services_token`
--

CREATE TABLE `services_token` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `status` enum('Active','Not Active') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `services_token`
--

INSERT INTO `services_token` (`id`, `name`, `operator`, `code`, `price`, `status`) VALUES
(1, 'Voucher PLN 20000', 'PLN', '1', 21500, 'Active'),
(2, 'Voucher PLN 50000', 'PLN', '2', 51000, 'Active'),
(3, 'Voucher PLN 100000', 'PLN', '3', 103000, 'Active'),
(4, 'Voucher PLN 200000', 'PLN', '4', 202000, 'Active'),
(5, 'Voucher PLN 500000', 'PLN', '5', 502000, 'Active'),
(6, 'Voucher PLN 1000000', 'PLN', '6', 1002000, 'Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_cat`
--

CREATE TABLE `service_cat` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `service_cat`
--

INSERT INTO `service_cat` (`id`, `name`, `code`) VALUES
(1, 'Instagram Followers', 'IGF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service_dog`
--

CREATE TABLE `service_dog` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `type` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `service_dog`
--

INSERT INTO `service_dog` (`id`, `name`, `code`, `type`) VALUES
(1, 'PULSA', 'PULSA', 'PULSA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `contact` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `level` enum('Admin','Reseller') COLLATE utf8_swedish_ci NOT NULL,
  `pict` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `subject` varchar(200) COLLATE utf8_swedish_ci NOT NULL,
  `message` text COLLATE utf8_swedish_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` enum('Pending','Responded','Closed','Waiting') COLLATE utf8_swedish_ci NOT NULL,
  `seen_user` int(1) NOT NULL DEFAULT '1',
  `seen_admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tickets_message`
--

CREATE TABLE `tickets_message` (
  `id` int(10) NOT NULL,
  `ticket_id` int(10) NOT NULL,
  `sender` enum('Member','Admin') COLLATE utf8_swedish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `message` text COLLATE utf8_swedish_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `topup`
--

CREATE TABLE `topup` (
  `id` int(11) NOT NULL,
  `method` enum('Telkomsel','BCA') NOT NULL,
  `username` varchar(200) NOT NULL,
  `pengirim` varchar(200) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `status` enum('Waiting','Completed','Canceled') NOT NULL,
  `time` varchar(200) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer_balance`
--

CREATE TABLE `transfer_balance` (
  `id` int(10) NOT NULL,
  `sender` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `receiver` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `quantity` double NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `transfer_balance`
--

INSERT INTO `transfer_balance` (`id`, `sender`, `receiver`, `quantity`, `date`) VALUES
(1, 'ruby', 'Crew1', 40000, '2018-10-06'),
(2, 'ruby', 'Crew1', 30000, '2018-10-07'),
(3, 'ruby', 'Diditagen', 8000, '2018-10-24'),
(4, 'ruby', 'Diditagen', 15000, '2018-10-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `balance` double NOT NULL,
  `level` enum('Member','Agen','Reseller','Admin','Developers') COLLATE utf8_swedish_ci NOT NULL,
  `registered` date NOT NULL,
  `status` enum('Active','Suspended') COLLATE utf8_swedish_ci NOT NULL,
  `api_key` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `uplink` varchar(100) COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `balance`, `level`, `registered`, `status`, `api_key`, `uplink`) VALUES
(3, 'ruby', 'ceo', 89635226, 'Developers', '0000-00-00', 'Active', '', ''),
(2234, 'Daeng_nass', 'andinas', 0, 'Member', '2018-10-05', 'Active', 'khjktNWmp742qAK3EqoY', 'free_register'),
(2235, 'andinas', 'merdeka17', 305.5, 'Member', '2018-10-05', 'Active', '16EgkwuTDNKm2LKUqcCt', 'free_register'),
(2236, 'Viloid', 'haha1234', 0, 'Member', '2018-10-05', 'Active', '0EtP7BYwlPe4Jpe5I7gs', 'free_register'),
(2237, 'demoo', 'demoo', 0, 'Member', '2018-10-05', 'Active', '2HZ3kLhjAsZqjVx8Ngr7', 'free_register'),
(2238, 'demooo', 'demo123', 0, 'Member', '2018-10-05', 'Active', 'J8V0EyCuvYfqBHo2OfT4', 'free_register'),
(2239, 'ferdi26', 'ferdinand', 0, 'Member', '2018-10-05', 'Active', 'jJ1lowEIJuDiP1Z8KvdP', 'free_register'),
(2240, 'ferdinand adh', 'ferdi123', 0, 'Member', '2018-10-05', 'Active', '9Mw1ac5d7gXILOY1XbLH', 'free_register'),
(2242, 'Azkarzqh1', '10120000', 0, 'Member', '2018-10-05', 'Active', 'aXSZhSBbhVxqrkSW1AAs', 'free_register'),
(2243, 'Daffa', 'Daplun28', 0, 'Member', '2018-10-05', 'Active', 'iqeEC609V4EUS3xtJChH', 'free_register'),
(2244, 'Daffa slop', 'slopdaffa', 0, 'Member', '2018-10-05', 'Active', 'Vkyy3eq60gETe9dguX97', 'free_register'),
(2245, 'zainim', 'zaininn', 0, 'Member', '2018-10-06', 'Active', 'OHsxg3sUkGGEFF9tpNcR', 'ruby'),
(2246, 'hilal123', 'hilal123', 0, 'Member', '2018-10-06', 'Active', 'dx3Bd0nClGTeyodSy2OM', 'free_register'),
(2247, 'demo', 'demo', 0, 'Member', '2018-10-06', 'Active', 'tZT4WjgsRMcwdHU0Qv1S', 'ruby'),
(2248, 'Rizki812', '12345678', 0, 'Member', '2018-10-06', 'Active', '6Q3wLexVqebvceMs485B', 'free_register'),
(2249, 'Jaki12', '12345678', 0, 'Member', '2018-10-06', 'Active', 'DPfgazXZ4LssOEWiBhHi', 'free_register'),
(2251, 'Kontolpro12', 'kontolpro12', 0, 'Member', '2018-10-06', 'Active', 'yZEfCpqF2jia3JTJ8cwO', 'free_register'),
(2252, 'rafly', 'adminganteng', 0, 'Admin', '2018-10-06', 'Active', '41Y71PKfMFpekgt1gPdT', 'ruby'),
(2253, 'Kokoko90', 'kokoko', 0, 'Member', '2018-10-06', 'Active', '0tMFgrINyot8hiIXMKkj', 'free_register'),
(2254, 'Yuno98', 'yunoo', 0, 'Member', '2018-10-06', 'Active', 'DXsMVjWuMCXC6k80QTKH', 'free_register'),
(2255, 'Nill890', 'kokoko', 0, 'Member', '2018-10-06', 'Active', 'xJr0gjq8julJ2uPiIi2V', 'free_register'),
(2259, 'fikrul', 'fikrull', 0, 'Member', '2018-10-06', 'Active', 'lizCDLBSCsL2gSO1P2zI', 'ruby'),
(2260, 'Crew1', 'fery123', 43625, 'Agen', '2018-10-06', 'Active', '31plyElARLGTyNPschY0', 'free_register'),
(2262, 'Hengky123', 'hengky', 0, 'Member', '2018-10-06', 'Active', 'zb140t7HTlDVZrZV66zu', 'free_register'),
(2264, 'Fil12', 'glasier1999', 0, 'Member', '2018-10-06', 'Active', 'V1XJfcNOi4b8CAMH48e3', 'free_register'),
(2265, 'Alfinrisfiansyah10', 'barbar10', 0, 'Member', '2018-10-06', 'Active', 'Z4yaWLi8xsXrYMVGq9XL', 'ruby'),
(2266, 'opik123', 'oppai', 0, 'Member', '2018-10-07', 'Active', 'b1pF1yoJvJjoISJrUo3P', 'ruby'),
(2268, 'Diditagen', 'Diditpanel', 13645, 'Agen', '2018-10-24', 'Active', 'TBd92iIZ5QOZoseOXLYy', 'ruby'),
(2269, 'yugha2', 'yuga9999', 3650, 'Member', '2018-10-24', 'Active', '6xnSg6XuTd4jbSUHmVKl', 'ruby');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun_game`
--
ALTER TABLE `akun_game`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deposits_history`
--
ALTER TABLE `deposits_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deposits_method`
--
ALTER TABLE `deposits_method`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_topup`
--
ALTER TABLE `history_topup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_diamond`
--
ALTER TABLE `orders_diamond`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_line`
--
ALTER TABLE `orders_line`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders_pulsa`
--
ALTER TABLE `orders_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `provider_pulsa`
--
ALTER TABLE `provider_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `refferal`
--
ALTER TABLE `refferal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_diamond`
--
ALTER TABLE `services_diamond`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_line`
--
ALTER TABLE `services_line`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_pulsa`
--
ALTER TABLE `services_pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_pulsa_cat`
--
ALTER TABLE `services_pulsa_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services_token`
--
ALTER TABLE `services_token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service_cat`
--
ALTER TABLE `service_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service_dog`
--
ALTER TABLE `service_dog`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tickets_message`
--
ALTER TABLE `tickets_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`);

--
-- Indeks untuk tabel `topup`
--
ALTER TABLE `topup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transfer_balance`
--
ALTER TABLE `transfer_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `deposits_history`
--
ALTER TABLE `deposits_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=656;

--
-- AUTO_INCREMENT untuk tabel `deposits_method`
--
ALTER TABLE `deposits_method`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=543;

--
-- AUTO_INCREMENT untuk tabel `history_topup`
--
ALTER TABLE `history_topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT untuk tabel `orders_line`
--
ALTER TABLE `orders_line`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders_pulsa`
--
ALTER TABLE `orders_pulsa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `provider_pulsa`
--
ALTER TABLE `provider_pulsa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `refferal`
--
ALTER TABLE `refferal`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- AUTO_INCREMENT untuk tabel `services_line`
--
ALTER TABLE `services_line`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT untuk tabel `services_pulsa`
--
ALTER TABLE `services_pulsa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=482;

--
-- AUTO_INCREMENT untuk tabel `service_cat`
--
ALTER TABLE `service_cat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `service_dog`
--
ALTER TABLE `service_dog`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tickets_message`
--
ALTER TABLE `tickets_message`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `topup`
--
ALTER TABLE `topup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transfer_balance`
--
ALTER TABLE `transfer_balance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2270;
COMMIT;
