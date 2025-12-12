-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql109.infinityfree.com
-- Waktu pembuatan: 12 Des 2025 pada 04.03
-- Versi server: 11.4.7-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40379204_db_gdss_rtlh`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `nama_pemilik` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id`, `nama_pemilik`, `alamat`) VALUES
(1, 'P1', 'RT 17, Kampung Inggris Pare'),
(2, 'P2', 'RT 17, Kampung Inggris Pare'),
(3, 'P3', 'RT 17, Kampung Inggris Pare'),
(4, 'P4', 'RT 17, Kampung Inggris Pare'),
(5, 'P5', 'RT 17, Kampung Inggris Pare'),
(6, 'P6', 'RT 17, Kampung Inggris Pare'),
(7, 'P7', 'RT 17, Kampung Inggris Pare'),
(8, 'P8', 'RT 17, Kampung Inggris Pare'),
(9, 'P9', 'RT 17, Kampung Inggris Pare'),
(10, 'P10', 'RT 17, Kampung Inggris Pare'),
(11, 'P11', 'RT 17, Kampung Inggris Pare'),
(12, 'P12', 'RT 17, Kampung Inggris Pare'),
(13, 'P13', 'RT 17, Kampung Inggris Pare'),
(14, 'P14', 'RT 17, Kampung Inggris Pare'),
(15, 'P15', 'RT 17, Kampung Inggris Pare');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot_dm`
--

CREATE TABLE `bobot_dm` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai_bobot` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bobot_dm`
--

INSERT INTO `bobot_dm` (`id`, `id_user`, `id_kriteria`, `nilai_bobot`) VALUES
(111, 2, 1, 2),
(112, 2, 2, 5),
(113, 2, 3, 5),
(114, 2, 4, 5),
(115, 2, 5, 3),
(116, 2, 6, 5),
(117, 2, 7, 2),
(118, 2, 8, 2),
(119, 2, 9, 5),
(120, 2, 10, 5),
(121, 2, 11, 5),
(122, 2, 12, 5),
(123, 1, 1, 5),
(124, 1, 2, 5),
(125, 1, 3, 5),
(126, 1, 4, 5),
(127, 1, 5, 2),
(128, 1, 6, 2),
(129, 1, 7, 3),
(130, 1, 8, 2),
(131, 1, 9, 5),
(132, 1, 10, 5),
(133, 1, 11, 5),
(134, 1, 12, 2),
(135, 3, 1, 4),
(136, 3, 10, 4),
(137, 3, 11, 4),
(138, 3, 12, 4),
(139, 3, 2, 4),
(140, 3, 3, 4),
(141, 3, 4, 4),
(142, 3, 5, 4),
(143, 3, 6, 4),
(144, 3, 7, 4),
(145, 3, 8, 4),
(146, 3, 9, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_borda`
--

CREATE TABLE `hasil_borda` (
  `id` int(11) NOT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `total_poin` int(11) DEFAULT NULL,
  `ranking_final` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_borda`
--

INSERT INTO `hasil_borda` (`id`, `id_alternatif`, `total_poin`, `ranking_final`) VALUES
(1, 15, 45, 1),
(2, 2, 37, 3),
(3, 3, 36, 5),
(4, 14, 40, 2),
(5, 6, 37, 4),
(6, 7, 25, 7),
(7, 9, 28, 6),
(8, 1, 21, 9),
(9, 4, 16, 11),
(10, 11, 23, 8),
(11, 5, 14, 12),
(12, 8, 20, 10),
(13, 13, 8, 13),
(14, 10, 5, 14),
(15, 12, 5, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_topsis`
--

CREATE TABLE `hasil_topsis` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `nilai_preferensi` float DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_topsis`
--

INSERT INTO `hasil_topsis` (`id`, `id_user`, `id_alternatif`, `nilai_preferensi`, `ranking`) VALUES
(126, 2, 15, 0.734263, 1),
(127, 2, 2, 0.732586, 2),
(128, 2, 3, 0.721263, 3),
(129, 2, 14, 0.701907, 4),
(130, 2, 6, 0.674369, 5),
(131, 2, 7, 0.659033, 6),
(132, 2, 9, 0.646405, 7),
(133, 2, 1, 0.64252, 8),
(134, 2, 4, 0.588019, 9),
(135, 2, 11, 0.582948, 10),
(136, 2, 5, 0.554167, 11),
(137, 2, 8, 0.551464, 12),
(138, 2, 13, 0.517205, 13),
(139, 2, 10, 0.470592, 14),
(140, 2, 12, 0.462266, 15),
(141, 1, 15, 0.748061, 1),
(142, 1, 14, 0.718397, 2),
(143, 1, 6, 0.679571, 3),
(144, 1, 2, 0.654334, 4),
(145, 1, 3, 0.651505, 5),
(146, 1, 8, 0.60985, 6),
(147, 1, 9, 0.588619, 7),
(148, 1, 11, 0.573701, 8),
(149, 1, 7, 0.55299, 9),
(150, 1, 1, 0.552302, 10),
(151, 1, 4, 0.519834, 11),
(152, 1, 5, 0.454679, 12),
(153, 1, 13, 0.42148, 13),
(154, 1, 10, 0.419668, 14),
(155, 1, 12, 0.405158, 15),
(156, 3, 15, 0.777345, 1),
(157, 3, 14, 0.667854, 2),
(158, 3, 6, 0.666143, 3),
(159, 3, 3, 0.659736, 4),
(160, 3, 2, 0.643591, 5),
(161, 3, 9, 0.591606, 6),
(162, 3, 11, 0.579787, 7),
(163, 3, 7, 0.565963, 8),
(164, 3, 1, 0.547111, 9),
(165, 3, 8, 0.524706, 10),
(166, 3, 5, 0.504837, 11),
(167, 3, 4, 0.495023, 12),
(168, 3, 12, 0.484276, 13),
(169, 3, 13, 0.480607, 14),
(170, 3, 10, 0.477533, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(255) DEFAULT NULL,
  `tipe` enum('benefit','cost') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode_kriteria`, `nama_kriteria`, `tipe`) VALUES
(1, 'C1', 'Jumlah Penghuni Rumah', 'benefit'),
(2, 'C2', 'Luas Rumah', 'cost'),
(3, 'C3', 'Jenis Kloset', 'benefit'),
(4, 'C4', 'Kondisi Kamar Mandi', 'benefit'),
(5, 'C5', 'Pencahayaan & Penghawaan', 'benefit'),
(6, 'C6', 'Sumber Air', 'benefit'),
(7, 'C7', 'Bahan Bakar Memasak', 'benefit'),
(8, 'C8', 'Sumber Listrik', 'benefit'),
(9, 'C9', 'Penghasilan Keluarga', 'cost'),
(10, 'C10', 'Bahan Dinding Rumah', 'benefit'),
(11, 'C11', 'Bahan Atap Rumah', 'benefit'),
(12, 'C12', 'Bahan Lantai Rumah', 'benefit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_user`, `id_alternatif`, `id_kriteria`, `nilai`) VALUES
(1361, 2, 1, 1, 1),
(1362, 2, 1, 2, 1),
(1363, 2, 1, 3, 2),
(1364, 2, 1, 4, 2),
(1365, 2, 1, 5, 2),
(1366, 2, 1, 6, 3),
(1367, 2, 1, 7, 2),
(1368, 2, 1, 8, 2),
(1369, 2, 1, 9, 2),
(1370, 2, 1, 10, 2),
(1371, 2, 1, 11, 3),
(1372, 2, 1, 12, 2),
(1373, 2, 2, 1, 2),
(1374, 2, 2, 2, 1),
(1375, 2, 2, 3, 3),
(1376, 2, 2, 4, 3),
(1377, 2, 2, 5, 2),
(1378, 2, 2, 6, 3),
(1379, 2, 2, 7, 2),
(1380, 2, 2, 8, 2),
(1381, 2, 2, 9, 2),
(1382, 2, 2, 10, 2),
(1383, 2, 2, 11, 3),
(1384, 2, 2, 12, 3),
(1385, 2, 3, 1, 2),
(1386, 2, 3, 2, 1),
(1387, 2, 3, 3, 2),
(1388, 2, 3, 4, 2),
(1389, 2, 3, 5, 2),
(1390, 2, 3, 6, 3),
(1391, 2, 3, 7, 2),
(1392, 2, 3, 8, 3),
(1393, 2, 3, 9, 1),
(1394, 2, 3, 10, 2),
(1395, 2, 3, 11, 3),
(1396, 2, 3, 12, 3),
(1397, 2, 4, 1, 1),
(1398, 2, 4, 2, 2),
(1399, 2, 4, 3, 2),
(1400, 2, 4, 4, 2),
(1401, 2, 4, 5, 1),
(1402, 2, 4, 6, 2),
(1403, 2, 4, 7, 1),
(1404, 2, 4, 8, 3),
(1405, 2, 4, 9, 1),
(1406, 2, 4, 10, 2),
(1407, 2, 4, 11, 3),
(1408, 2, 4, 12, 2),
(1409, 2, 5, 1, 1),
(1410, 2, 5, 2, 3),
(1411, 2, 5, 3, 3),
(1412, 2, 5, 4, 3),
(1413, 2, 5, 5, 3),
(1414, 2, 5, 6, 3),
(1415, 2, 5, 7, 2),
(1416, 2, 5, 8, 2),
(1417, 2, 5, 9, 3),
(1418, 2, 5, 10, 2),
(1419, 2, 5, 11, 4),
(1420, 2, 5, 12, 3),
(1421, 2, 6, 1, 3),
(1422, 2, 6, 2, 1),
(1423, 2, 6, 3, 2),
(1424, 2, 6, 4, 2),
(1425, 2, 6, 5, 2),
(1426, 2, 6, 6, 3),
(1427, 2, 6, 7, 2),
(1428, 2, 6, 8, 3),
(1429, 2, 6, 9, 2),
(1430, 2, 6, 10, 2),
(1431, 2, 6, 11, 3),
(1432, 2, 6, 12, 2),
(1433, 2, 7, 1, 1),
(1434, 2, 7, 2, 2),
(1435, 2, 7, 3, 3),
(1436, 2, 7, 4, 3),
(1437, 2, 7, 5, 3),
(1438, 2, 7, 6, 3),
(1439, 2, 7, 7, 2),
(1440, 2, 7, 8, 2),
(1441, 2, 7, 9, 2),
(1442, 2, 7, 10, 2),
(1443, 2, 7, 11, 4),
(1444, 2, 7, 12, 2),
(1445, 2, 8, 1, 4),
(1446, 2, 8, 2, 1),
(1447, 2, 8, 3, 1),
(1448, 2, 8, 4, 2),
(1449, 2, 8, 5, 1),
(1450, 2, 8, 6, 2),
(1451, 2, 8, 7, 1),
(1452, 2, 8, 8, 1),
(1453, 2, 8, 9, 1),
(1454, 2, 8, 10, 1),
(1455, 2, 8, 11, 3),
(1456, 2, 8, 12, 1),
(1457, 2, 9, 1, 2),
(1458, 2, 9, 2, 1),
(1459, 2, 9, 3, 3),
(1460, 2, 9, 4, 3),
(1461, 2, 9, 5, 2),
(1462, 2, 9, 6, 3),
(1463, 2, 9, 7, 2),
(1464, 2, 9, 8, 2),
(1465, 2, 9, 9, 3),
(1466, 2, 9, 10, 2),
(1467, 2, 9, 11, 2),
(1468, 2, 9, 12, 3),
(1469, 2, 10, 1, 2),
(1470, 2, 10, 2, 3),
(1471, 2, 10, 3, 3),
(1472, 2, 10, 4, 3),
(1473, 2, 10, 5, 3),
(1474, 2, 10, 6, 3),
(1475, 2, 10, 7, 2),
(1476, 2, 10, 8, 2),
(1477, 2, 10, 9, 5),
(1478, 2, 10, 10, 2),
(1479, 2, 10, 11, 4),
(1480, 2, 10, 12, 3),
(1481, 2, 11, 1, 3),
(1482, 2, 11, 2, 2),
(1483, 2, 11, 3, 3),
(1484, 2, 11, 4, 3),
(1485, 2, 11, 5, 2),
(1486, 2, 11, 6, 3),
(1487, 2, 11, 7, 2),
(1488, 2, 11, 8, 2),
(1489, 2, 11, 9, 4),
(1490, 2, 11, 10, 3),
(1491, 2, 11, 11, 2),
(1492, 2, 11, 12, 3),
(1493, 2, 12, 1, 1),
(1494, 2, 12, 2, 4),
(1495, 2, 12, 3, 3),
(1496, 2, 12, 4, 3),
(1497, 2, 12, 5, 3),
(1498, 2, 12, 6, 3),
(1499, 2, 12, 7, 3),
(1500, 2, 12, 8, 3),
(1501, 2, 12, 9, 5),
(1502, 2, 12, 10, 3),
(1503, 2, 12, 11, 4),
(1504, 2, 12, 12, 3),
(1505, 2, 13, 1, 1),
(1506, 2, 13, 2, 3),
(1507, 2, 13, 3, 3),
(1508, 2, 13, 4, 3),
(1509, 2, 13, 5, 3),
(1510, 2, 13, 6, 3),
(1511, 2, 13, 7, 2),
(1512, 2, 13, 8, 2),
(1513, 2, 13, 9, 3),
(1514, 2, 13, 10, 2),
(1515, 2, 13, 11, 2),
(1516, 2, 13, 12, 3),
(1517, 2, 14, 1, 3),
(1518, 2, 14, 2, 1),
(1519, 2, 14, 3, 2),
(1520, 2, 14, 4, 2),
(1521, 2, 14, 5, 2),
(1522, 2, 14, 6, 2),
(1523, 2, 14, 7, 2),
(1524, 2, 14, 8, 2),
(1525, 2, 14, 9, 1),
(1526, 2, 14, 10, 2),
(1527, 2, 14, 11, 4),
(1528, 2, 14, 12, 2),
(1529, 2, 15, 1, 4),
(1530, 2, 15, 2, 1),
(1531, 2, 15, 3, 3),
(1532, 2, 15, 4, 3),
(1533, 2, 15, 5, 3),
(1534, 2, 15, 6, 3),
(1535, 2, 15, 7, 3),
(1536, 2, 15, 8, 3),
(1537, 2, 15, 9, 3),
(1538, 2, 15, 10, 2),
(1539, 2, 15, 11, 4),
(1540, 2, 15, 12, 3),
(1541, 1, 1, 1, 1),
(1542, 1, 1, 2, 1),
(1543, 1, 1, 3, 2),
(1544, 1, 1, 4, 2),
(1545, 1, 1, 5, 2),
(1546, 1, 1, 6, 3),
(1547, 1, 1, 7, 2),
(1548, 1, 1, 8, 2),
(1549, 1, 1, 9, 2),
(1550, 1, 1, 10, 2),
(1551, 1, 1, 11, 3),
(1552, 1, 1, 12, 2),
(1553, 1, 2, 1, 2),
(1554, 1, 2, 2, 1),
(1555, 1, 2, 3, 3),
(1556, 1, 2, 4, 3),
(1557, 1, 2, 5, 2),
(1558, 1, 2, 6, 3),
(1559, 1, 2, 7, 2),
(1560, 1, 2, 8, 2),
(1561, 1, 2, 9, 2),
(1562, 1, 2, 10, 2),
(1563, 1, 2, 11, 3),
(1564, 1, 2, 12, 3),
(1565, 1, 3, 1, 2),
(1566, 1, 3, 2, 1),
(1567, 1, 3, 3, 2),
(1568, 1, 3, 4, 2),
(1569, 1, 3, 5, 2),
(1570, 1, 3, 6, 3),
(1571, 1, 3, 7, 2),
(1572, 1, 3, 8, 3),
(1573, 1, 3, 9, 1),
(1574, 1, 3, 10, 2),
(1575, 1, 3, 11, 3),
(1576, 1, 3, 12, 3),
(1577, 1, 4, 1, 1),
(1578, 1, 4, 2, 2),
(1579, 1, 4, 3, 2),
(1580, 1, 4, 4, 2),
(1581, 1, 4, 5, 1),
(1582, 1, 4, 6, 2),
(1583, 1, 4, 7, 1),
(1584, 1, 4, 8, 3),
(1585, 1, 4, 9, 1),
(1586, 1, 4, 10, 2),
(1587, 1, 4, 11, 3),
(1588, 1, 4, 12, 2),
(1589, 1, 5, 1, 1),
(1590, 1, 5, 2, 3),
(1591, 1, 5, 3, 3),
(1592, 1, 5, 4, 3),
(1593, 1, 5, 5, 3),
(1594, 1, 5, 6, 3),
(1595, 1, 5, 7, 2),
(1596, 1, 5, 8, 2),
(1597, 1, 5, 9, 3),
(1598, 1, 5, 10, 2),
(1599, 1, 5, 11, 4),
(1600, 1, 5, 12, 3),
(1601, 1, 6, 1, 3),
(1602, 1, 6, 2, 1),
(1603, 1, 6, 3, 2),
(1604, 1, 6, 4, 2),
(1605, 1, 6, 5, 2),
(1606, 1, 6, 6, 3),
(1607, 1, 6, 7, 2),
(1608, 1, 6, 8, 3),
(1609, 1, 6, 9, 2),
(1610, 1, 6, 10, 2),
(1611, 1, 6, 11, 3),
(1612, 1, 6, 12, 2),
(1613, 1, 7, 1, 1),
(1614, 1, 7, 2, 2),
(1615, 1, 7, 3, 3),
(1616, 1, 7, 4, 3),
(1617, 1, 7, 5, 3),
(1618, 1, 7, 6, 3),
(1619, 1, 7, 7, 2),
(1620, 1, 7, 8, 2),
(1621, 1, 7, 9, 2),
(1622, 1, 7, 10, 2),
(1623, 1, 7, 11, 4),
(1624, 1, 7, 12, 2),
(1625, 1, 8, 1, 4),
(1626, 1, 8, 2, 1),
(1627, 1, 8, 3, 1),
(1628, 1, 8, 4, 2),
(1629, 1, 8, 5, 1),
(1630, 1, 8, 6, 2),
(1631, 1, 8, 7, 1),
(1632, 1, 8, 8, 1),
(1633, 1, 8, 9, 1),
(1634, 1, 8, 10, 1),
(1635, 1, 8, 11, 3),
(1636, 1, 8, 12, 1),
(1637, 1, 9, 1, 2),
(1638, 1, 9, 2, 1),
(1639, 1, 9, 3, 3),
(1640, 1, 9, 4, 3),
(1641, 1, 9, 5, 2),
(1642, 1, 9, 6, 3),
(1643, 1, 9, 7, 2),
(1644, 1, 9, 8, 2),
(1645, 1, 9, 9, 3),
(1646, 1, 9, 10, 2),
(1647, 1, 9, 11, 2),
(1648, 1, 9, 12, 3),
(1649, 1, 10, 1, 2),
(1650, 1, 10, 2, 3),
(1651, 1, 10, 3, 3),
(1652, 1, 10, 4, 3),
(1653, 1, 10, 5, 3),
(1654, 1, 10, 6, 3),
(1655, 1, 10, 7, 2),
(1656, 1, 10, 8, 2),
(1657, 1, 10, 9, 5),
(1658, 1, 10, 10, 2),
(1659, 1, 10, 11, 4),
(1660, 1, 10, 12, 3),
(1661, 1, 11, 1, 3),
(1662, 1, 11, 2, 2),
(1663, 1, 11, 3, 3),
(1664, 1, 11, 4, 3),
(1665, 1, 11, 5, 2),
(1666, 1, 11, 6, 3),
(1667, 1, 11, 7, 2),
(1668, 1, 11, 8, 2),
(1669, 1, 11, 9, 4),
(1670, 1, 11, 10, 3),
(1671, 1, 11, 11, 2),
(1672, 1, 11, 12, 3),
(1673, 1, 12, 1, 1),
(1674, 1, 12, 2, 4),
(1675, 1, 12, 3, 3),
(1676, 1, 12, 4, 3),
(1677, 1, 12, 5, 3),
(1678, 1, 12, 6, 3),
(1679, 1, 12, 7, 3),
(1680, 1, 12, 8, 3),
(1681, 1, 12, 9, 5),
(1682, 1, 12, 10, 3),
(1683, 1, 12, 11, 4),
(1684, 1, 12, 12, 3),
(1685, 1, 13, 1, 1),
(1686, 1, 13, 2, 3),
(1687, 1, 13, 3, 3),
(1688, 1, 13, 4, 3),
(1689, 1, 13, 5, 3),
(1690, 1, 13, 6, 3),
(1691, 1, 13, 7, 2),
(1692, 1, 13, 8, 2),
(1693, 1, 13, 9, 3),
(1694, 1, 13, 10, 2),
(1695, 1, 13, 11, 2),
(1696, 1, 13, 12, 3),
(1697, 1, 14, 1, 3),
(1698, 1, 14, 2, 1),
(1699, 1, 14, 3, 2),
(1700, 1, 14, 4, 2),
(1701, 1, 14, 5, 2),
(1702, 1, 14, 6, 2),
(1703, 1, 14, 7, 2),
(1704, 1, 14, 8, 2),
(1705, 1, 14, 9, 1),
(1706, 1, 14, 10, 2),
(1707, 1, 14, 11, 4),
(1708, 1, 14, 12, 2),
(1709, 1, 15, 1, 4),
(1710, 1, 15, 2, 1),
(1711, 1, 15, 3, 3),
(1712, 1, 15, 4, 3),
(1713, 1, 15, 5, 3),
(1714, 1, 15, 6, 3),
(1715, 1, 15, 7, 3),
(1716, 1, 15, 8, 3),
(1717, 1, 15, 9, 3),
(1718, 1, 15, 10, 2),
(1719, 1, 15, 11, 4),
(1720, 1, 15, 12, 3),
(1721, 3, 1, 1, 1),
(1722, 3, 1, 10, 2),
(1723, 3, 1, 11, 3),
(1724, 3, 1, 12, 2),
(1725, 3, 1, 2, 1),
(1726, 3, 1, 3, 2),
(1727, 3, 1, 4, 2),
(1728, 3, 1, 5, 2),
(1729, 3, 1, 6, 3),
(1730, 3, 1, 7, 2),
(1731, 3, 1, 8, 2),
(1732, 3, 1, 9, 2),
(1733, 3, 2, 1, 2),
(1734, 3, 2, 10, 2),
(1735, 3, 2, 11, 3),
(1736, 3, 2, 12, 3),
(1737, 3, 2, 2, 1),
(1738, 3, 2, 3, 3),
(1739, 3, 2, 4, 3),
(1740, 3, 2, 5, 2),
(1741, 3, 2, 6, 3),
(1742, 3, 2, 7, 2),
(1743, 3, 2, 8, 2),
(1744, 3, 2, 9, 2),
(1745, 3, 3, 1, 2),
(1746, 3, 3, 10, 2),
(1747, 3, 3, 11, 3),
(1748, 3, 3, 12, 3),
(1749, 3, 3, 2, 1),
(1750, 3, 3, 3, 2),
(1751, 3, 3, 4, 2),
(1752, 3, 3, 5, 2),
(1753, 3, 3, 6, 3),
(1754, 3, 3, 7, 2),
(1755, 3, 3, 8, 3),
(1756, 3, 3, 9, 1),
(1757, 3, 4, 1, 1),
(1758, 3, 4, 10, 2),
(1759, 3, 4, 11, 3),
(1760, 3, 4, 12, 2),
(1761, 3, 4, 2, 2),
(1762, 3, 4, 3, 2),
(1763, 3, 4, 4, 2),
(1764, 3, 4, 5, 1),
(1765, 3, 4, 6, 2),
(1766, 3, 4, 7, 1),
(1767, 3, 4, 8, 3),
(1768, 3, 4, 9, 1),
(1769, 3, 5, 1, 1),
(1770, 3, 5, 10, 2),
(1771, 3, 5, 11, 4),
(1772, 3, 5, 12, 3),
(1773, 3, 5, 2, 3),
(1774, 3, 5, 3, 3),
(1775, 3, 5, 4, 3),
(1776, 3, 5, 5, 3),
(1777, 3, 5, 6, 3),
(1778, 3, 5, 7, 2),
(1779, 3, 5, 8, 2),
(1780, 3, 5, 9, 3),
(1781, 3, 6, 1, 3),
(1782, 3, 6, 10, 2),
(1783, 3, 6, 11, 3),
(1784, 3, 6, 12, 2),
(1785, 3, 6, 2, 1),
(1786, 3, 6, 3, 2),
(1787, 3, 6, 4, 2),
(1788, 3, 6, 5, 2),
(1789, 3, 6, 6, 3),
(1790, 3, 6, 7, 2),
(1791, 3, 6, 8, 3),
(1792, 3, 6, 9, 2),
(1793, 3, 7, 1, 1),
(1794, 3, 7, 10, 2),
(1795, 3, 7, 11, 4),
(1796, 3, 7, 12, 2),
(1797, 3, 7, 2, 2),
(1798, 3, 7, 3, 3),
(1799, 3, 7, 4, 3),
(1800, 3, 7, 5, 3),
(1801, 3, 7, 6, 3),
(1802, 3, 7, 7, 2),
(1803, 3, 7, 8, 2),
(1804, 3, 7, 9, 2),
(1805, 3, 8, 1, 4),
(1806, 3, 8, 10, 1),
(1807, 3, 8, 11, 3),
(1808, 3, 8, 12, 1),
(1809, 3, 8, 2, 1),
(1810, 3, 8, 3, 1),
(1811, 3, 8, 4, 2),
(1812, 3, 8, 5, 1),
(1813, 3, 8, 6, 2),
(1814, 3, 8, 7, 1),
(1815, 3, 8, 8, 1),
(1816, 3, 8, 9, 1),
(1817, 3, 9, 1, 2),
(1818, 3, 9, 10, 2),
(1819, 3, 9, 11, 2),
(1820, 3, 9, 12, 3),
(1821, 3, 9, 2, 1),
(1822, 3, 9, 3, 3),
(1823, 3, 9, 4, 3),
(1824, 3, 9, 5, 2),
(1825, 3, 9, 6, 3),
(1826, 3, 9, 7, 2),
(1827, 3, 9, 8, 2),
(1828, 3, 9, 9, 3),
(1829, 3, 10, 1, 2),
(1830, 3, 10, 10, 2),
(1831, 3, 10, 11, 4),
(1832, 3, 10, 12, 3),
(1833, 3, 10, 2, 3),
(1834, 3, 10, 3, 3),
(1835, 3, 10, 4, 3),
(1836, 3, 10, 5, 3),
(1837, 3, 10, 6, 3),
(1838, 3, 10, 7, 2),
(1839, 3, 10, 8, 2),
(1840, 3, 10, 9, 5),
(1841, 3, 11, 1, 3),
(1842, 3, 11, 10, 3),
(1843, 3, 11, 11, 2),
(1844, 3, 11, 12, 3),
(1845, 3, 11, 2, 2),
(1846, 3, 11, 3, 3),
(1847, 3, 11, 4, 3),
(1848, 3, 11, 5, 2),
(1849, 3, 11, 6, 3),
(1850, 3, 11, 7, 2),
(1851, 3, 11, 8, 2),
(1852, 3, 11, 9, 4),
(1853, 3, 12, 1, 1),
(1854, 3, 12, 10, 3),
(1855, 3, 12, 11, 4),
(1856, 3, 12, 12, 3),
(1857, 3, 12, 2, 4),
(1858, 3, 12, 3, 3),
(1859, 3, 12, 4, 3),
(1860, 3, 12, 5, 3),
(1861, 3, 12, 6, 3),
(1862, 3, 12, 7, 3),
(1863, 3, 12, 8, 3),
(1864, 3, 12, 9, 5),
(1865, 3, 13, 1, 1),
(1866, 3, 13, 10, 2),
(1867, 3, 13, 11, 2),
(1868, 3, 13, 12, 3),
(1869, 3, 13, 2, 3),
(1870, 3, 13, 3, 3),
(1871, 3, 13, 4, 3),
(1872, 3, 13, 5, 3),
(1873, 3, 13, 6, 3),
(1874, 3, 13, 7, 2),
(1875, 3, 13, 8, 2),
(1876, 3, 13, 9, 3),
(1877, 3, 14, 1, 3),
(1878, 3, 14, 10, 2),
(1879, 3, 14, 11, 4),
(1880, 3, 14, 12, 2),
(1881, 3, 14, 2, 1),
(1882, 3, 14, 3, 2),
(1883, 3, 14, 4, 2),
(1884, 3, 14, 5, 2),
(1885, 3, 14, 6, 2),
(1886, 3, 14, 7, 2),
(1887, 3, 14, 8, 2),
(1888, 3, 14, 9, 1),
(1889, 3, 15, 1, 4),
(1890, 3, 15, 10, 2),
(1891, 3, 15, 11, 4),
(1892, 3, 15, 12, 3),
(1893, 3, 15, 2, 1),
(1894, 3, 15, 3, 3),
(1895, 3, 15, 4, 3),
(1896, 3, 15, 5, 3),
(1897, 3, 15, 6, 3),
(1898, 3, 15, 7, 3),
(1899, 3, 15, 8, 3),
(1900, 3, 15, 9, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(200) DEFAULT NULL,
  `role` enum('staf_teknis','staf_sosial','kadinas','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `role`) VALUES
(1, 'teknis', '$2y$10$O4vOpj9ehGN/NLG8NFKUbelJpbcQ72g4z33kynO3s7ahSw6FXHI4m', 'Staf Teknis Lapangan', 'staf_teknis'),
(2, 'sosial', '$2y$10$/S31drvn3fjMp1Ju4E4lcublGtNXtFOJlVUnkI1LV.ENx9Z0LLi.m', 'Staf Sosial Kemasyarakatan', 'staf_sosial'),
(3, 'kadinas', '$2y$10$dLc.8rfbuc0eg59e7i49M.rtuFb6GNalDVljv2/3XNrxlc5/bFAZ2', 'Kepala Dinas', 'kadinas'),
(4, 'admin', '$2y$10$O4vOpj9ehGN/NLG8NFKUbelJpbcQ72g4z33kynO3s7ahSw6FXHI4m', 'Administrator Sistem', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bobot_dm`
--
ALTER TABLE `bobot_dm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `hasil_borda`
--
ALTER TABLE `hasil_borda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alternatif` (`id_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_kriteria` (`kode_kriteria`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `bobot_dm`
--
ALTER TABLE `bobot_dm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT untuk tabel `hasil_borda`
--
ALTER TABLE `hasil_borda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1901;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bobot_dm`
--
ALTER TABLE `bobot_dm`
  ADD CONSTRAINT `bobot_dm_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bobot_dm_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_borda`
--
ALTER TABLE `hasil_borda`
  ADD CONSTRAINT `hasil_borda_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_topsis`
--
ALTER TABLE `hasil_topsis`
  ADD CONSTRAINT `hasil_topsis_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_topsis_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
