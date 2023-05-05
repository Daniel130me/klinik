-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 01:15 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nmrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `bio_file`
--

CREATE TABLE `bio_file` (
  `id` int(11) NOT NULL,
  `dateuploaded` date NOT NULL,
  `filebio` varchar(300) NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bio_file`
--

INSERT INTO `bio_file` (`id`, `dateuploaded`, `filebio`, `facility_id`) VALUES
(12, '2023-03-23', '001_UserInfo.dat', 15);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `faddress` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `postcode` int(10) NOT NULL,
  `logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`id`, `fname`, `email`, `faddress`, `phone`, `postcode`, `logo`) VALUES
(9, 'New Horizon Hospital', 'newhorizon@gmail.com', '12, new hotel bodija market lagos', '+234904664773', 123456, '988940blob.png'),
(11, 'New Eden Hospital', 'neweden@gmail.com', '10, ilupeju majdun lagos', '+23490756784', 123456, '170808prod-5.jpg'),
(12, 'Jossy Health Clinic', 'jossy@gmail.com', 'Jossy clinic and laboratory, Ezekiah way, ilupeju ', '+2348076543498', 120321, '87143AdminLTELogo.png'),
(13, 'Adeyemo Community Cl', 'olo@gmail.com', '10, ilupeju majdun lagos', '+23490756776', 123456, '522540add patient record.png'),
(15, 'Futa Health center', 'futa@gmail.com', '24, London Barber street, Majidun-Awori way Ikorod', '+2348076347895', 104214, '923593AdminLTELogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(3) NOT NULL,
  `title` varchar(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `paddress` varchar(50) NOT NULL,
  `lga` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `postcode` int(9) NOT NULL,
  `state_origin` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `bloodgroup` varchar(2) NOT NULL,
  `genotype` varchar(2) NOT NULL,
  `etitle` varchar(9) NOT NULL,
  `efname` varchar(20) NOT NULL,
  `elname` varchar(20) NOT NULL,
  `emname` varchar(20) NOT NULL,
  `eaddress` varchar(50) NOT NULL,
  `elga` varchar(15) NOT NULL,
  `eemail` varchar(50) NOT NULL,
  `ephone` varchar(20) NOT NULL,
  `epostcode` int(9) NOT NULL,
  `estate_of_origin` varchar(20) NOT NULL,
  `edob` date NOT NULL,
  `ebloodgroup` varchar(2) NOT NULL,
  `egenotype` varchar(2) NOT NULL,
  `erelation` varchar(15) NOT NULL,
  `facility` int(11) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime DEFAULT NULL,
  `photo` varchar(50) NOT NULL,
  `updatedby` int(11) NOT NULL,
  `createdby` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `pweight` varchar(10) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state_res` varchar(40) NOT NULL,
  `lga_origin` varchar(40) NOT NULL,
  `ecity` varchar(40) NOT NULL,
  `estate` varchar(40) NOT NULL,
  `elga_origin` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `title`, `fname`, `mname`, `lname`, `paddress`, `lga`, `email`, `phone`, `postcode`, `state_origin`, `dob`, `bloodgroup`, `genotype`, `etitle`, `efname`, `elname`, `emname`, `eaddress`, `elga`, `eemail`, `ephone`, `epostcode`, `estate_of_origin`, `edob`, `ebloodgroup`, `egenotype`, `erelation`, `facility`, `datecreated`, `dateupdated`, `photo`, `updatedby`, `createdby`, `gender`, `height`, `pweight`, `city`, `state_res`, `lga_origin`, `ecity`, `estate`, `elga_origin`) VALUES
(458, 'Mrs.', 'Oluwagbenga', 'Adewumi', 'Kosoko', '24, London Barber street, Majidun-Awori way Ikorod', 'Mainland', 'gbenga@gmail.com', '+2348076347895', 104214, 'Lagos', '1998-01-01', 'A+', 'AA', 'Mr.', 'Oluwagbenga', 'Kosoko', 'Adewumi', '24, London Barber street, Majidun-Awori way Ikorod', 'Mainland', 'gbenga@gmail.com', '+2348076347895', 104214, 'Lagos', '1880-01-01', 'A+', 'AA', 'Brother', 15, '2023-03-23 14:37:31', NULL, '818837441user8-128x128.jpg', 0, 22, 'Male', '120', '90', 'Mainland', 'Lagos', 'Mainland', 'Mainland', 'Lagos', 'Mainland');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(2) NOT NULL,
  `post` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `post`) VALUES
(1, 'Licensed Practical Nurse'),
(2, 'Physician'),
(3, 'Lab Specialist'),
(4, 'Radiological Technologist'),
(5, 'Dentist'),
(6, 'Surgeon'),
(7, 'Optician'),
(8, 'Cardiologist'),
(9, 'MRI Technologist'),
(10, 'Optometrist'),
(11, 'Psychiatrist'),
(12, 'Gynecologist'),
(13, 'Registrar');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `diagnosis` varchar(500) NOT NULL,
  `treatment` varchar(500) NOT NULL,
  `prescription` varchar(400) NOT NULL,
  `facility` int(11) NOT NULL,
  `datecreated` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `dateupdated` datetime DEFAULT NULL,
  `updatedby` int(11) NOT NULL,
  `test` varchar(500) NOT NULL,
  `test_file` varchar(500) DEFAULT NULL,
  `userpost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`id`, `patient_id`, `diagnosis`, `treatment`, `prescription`, `facility`, `datecreated`, `createdby`, `dateupdated`, `updatedby`, `test`, `test_file`, `userpost`) VALUES
(1, 1, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 02:03:07', 0, '2022-12-29 19:25:24', 1, 'test it', '', 2),
(2, 1, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 02:16:17', 0, '2022-12-29 19:25:24', 1, 'test it', '', 2),
(3, 1, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 10:56:08', 1, '2022-12-29 19:25:24', 1, 'test it', '9474995skin-three.png', 2),
(4, 2, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 11:21:34', 1, '2022-12-29 19:25:24', 1, 'test it', '6989220skin-three.png', 2),
(5, 2, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 11:37:45', 1, '2022-12-29 19:25:24', 1, 'test it', '8528013skin-two.png', 2),
(6, 2, 'diagn', 'treatment', 'preaicur', 2, '2022-12-29 12:27:04', 1, '2022-12-29 19:25:24', 1, 'test it', '', 2),
(7, 2, 'diagn1', 'treatment', 'preaicur', 2, '2022-12-29 12:27:11', 1, '2022-12-29 19:47:49', 1, 'test it', '7240984skin-one.png', 2),
(8, 2, 'wnpocpwc', 'pnqcpwnpoqwcn', 'nowcpnp', 2, '2022-12-29 22:16:00', 1, NULL, 0, 'pnocwp', NULL, 2),
(9, 4, 'ponwc', 'now[no', 'nwo[o', 2, '2022-12-29 22:24:45', 1, NULL, 0, 'wp[', '2620343slide-three.png', 2),
(10, 5, 'digaiois for him', 'treatment for him', 'pres for him', 9, '2023-01-07 22:34:41', 12, NULL, 0, 'no test', NULL, 2),
(11, 5, 'diagnose for malaria', 'treated for malaria', 'malaria drugs', 9, '2023-01-07 23:28:15', 12, NULL, 0, 'mild test', '8987023PHY 501 DOLAPO.pdf', 2),
(12, 5, '', '', '', 9, '2023-01-07 23:33:21', 12, NULL, 0, '', '4661033TEDxYabaStreet  (2).png', 2),
(13, 6, 'Malaria', 'He was placed on drip. given several amoxylene injection and several paracetamol', 'Good food, Paracetamol, Lumenfanthrine, analcost, amoxylene', 10, '2023-01-18 14:27:37', 18, NULL, 0, 'He was exmanined for Sneezing, mild headache, cold, fever.', NULL, 2),
(14, 6, 'He was diagnosed with Malaria', 'He was treated for malaria and headache', 'Paracetamol, chloroquine', 10, '2023-03-16 15:54:31', 18, NULL, 0, 'Attached with this is a pdf document', '3603767Niyitegeka.pdf', 2),
(15, 6, 'I am here', 'checking', '922283Allocation of Physician Time in Ambulatory Practice A Time and motion study in 4 specialties.pdf', 10, '2023-03-18 00:40:15', 18, NULL, 0, 'again', '922283Allocation of Physician Time in Ambulatory Practice A Time and motion study in 4 specialties.pdf', 2),
(16, 1218792378, 'He is fine now', 'No treatment needed', 'No prescription given', 12, '2023-03-21 16:10:18', 21, NULL, 0, 'No test result for now', '3812415Haskew J  Gunnar R  Turner K  Kimanga D  Sirengo M.pdf', 7),
(17, 858, 'Malaria', 'Dose', 'npcnp', 11, '2023-03-23 13:38:20', 19, NULL, 0, 'well tested', '6037565daniel proptotype project.png', 6),
(19, 458, 'diag', 'Trea', 'pres', 15, '2023-03-23 15:45:32', 22, NULL, 0, 'test', '771430Quotation_for_Protea_edited.pdf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(7) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `mname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `pcode` int(6) NOT NULL,
  `dob` date NOT NULL,
  `post` int(2) NOT NULL,
  `facility` int(2) NOT NULL,
  `password` varchar(20) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `createdby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`id`, `title`, `fname`, `mname`, `lname`, `address`, `email`, `phone`, `pcode`, `dob`, `post`, `facility`, `password`, `photo`, `gender`, `datecreated`, `dateupdated`, `updatedby`, `createdby`) VALUES
(22, 'Mr.', 'Oloyede', 'Aanu', 'Ajayi', '10, ilupeju majdun lagos', 'olo@gmail.com', '+23490756784', 123456, '1990-03-23', 2, 15, '123', '757466user1-128x128.jpg', '', '2023-03-23 14:33:03', '0000-00-00 00:00:00', 0, 0),
(23, 'Mr.', 'Oluwagbenga', 'Adewumi', 'Kosoko', '24, London Barber street, Majidun-Awori way Ikorod', 'gbenga@gmail.com', '+2348076347895', 104214, '2010-01-01', 8, 15, '123', '841191user5-128x128.jpg', '', '2023-03-23 14:38:13', '0000-00-00 00:00:00', 0, 22);

-- --------------------------------------------------------

--
-- Table structure for table `update_record`
--

CREATE TABLE `update_record` (
  `id` int(11) NOT NULL,
  `initiatedby` int(11) NOT NULL,
  `dateupdated` datetime NOT NULL,
  `updated_data` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0=pending, 1=updated',
  `date_initiated` datetime NOT NULL,
  `confirmedby` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bio_file`
--
ALTER TABLE `bio_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_record`
--
ALTER TABLE `update_record`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bio_file`
--
ALTER TABLE `bio_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `update_record`
--
ALTER TABLE `update_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
