-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: localhost:3306
-- Χρόνος δημιουργίας: 09 Ιαν 2021 στις 23:12:02
-- Έκδοση διακομιστή: 10.1.47-MariaDB-cll-lve
-- Έκδοση PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `unistdt_db`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_blacklist`
--

CREATE TABLE `uni_blacklist` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_courses`
--

CREATE TABLE `uni_courses` (
  `id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ects` int(11) NOT NULL,
  `dm` tinyint(3) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `uni_courses`
--

INSERT INTO `uni_courses` (`id`, `semester`, `code`, `name`, `ects`, `dm`, `type`) VALUES
(1, 1, 'LB1', 'Εισαγωγή στην Πληροφορική', 6, 6, 'ΥΠΟΧΡΕΩΤΙΚΟ'),
(2, 1, 'LB2', 'Μαθηματικά Ι', 6, 6, 'ΥΠΟΧΡΕΩΤΙΚΟ'),
(3, 2, 'LB3', 'Μαθηματικά ΙΙ', 6, 6, 'ΥΠΟΧΡΕΩΤΙΚΟ'),
(4, 6, 'LB4', 'Ασφάλεια Διαδικτυακών Εφαρμογών', 6, 6, 'ΥΠΟΧΡΕΩΤΙΚΟ'),
(5, 1, 'LB5', 'Αγγλικά Ι', 6, 4, 'ΥΠΟΧΡΕΩΤΙΚΟ'),
(6, 3, 'LB6', 'Τεστ', 6, 6, 'ΕΠΙΛΟΓΗΣ'),
(7, 11, 'Π-7030', 'Διαχείριση έργων', 5, 3, 'Υποχρεωτικό'),
(8, 11, 'Π-7010', 'Εφαρμογές στον παγκόσμιο ιστό', 6, 2, 'Υποχρεωτικό'),
(9, 11, 'Π-1040', 'Κοινωνία και πληροφορία', 5, 3, 'Υποχρεωτικό'),
(10, 11, 'Π-7060', 'Αρχεία επιχειρήσεων', 4, 2, 'Υποχρεωτικό κατ’ επιλογήν'),
(11, 11, 'Π-8020', 'Διαχείριση πολιτιστικών αγαθών', 6, 3, 'Υποχρεωτικό'),
(12, 11, 'Π-5070', 'Ιστορία γραφής και τεχνολογίας των πληροφοριών', 4, 2, 'Υποχρεωτικό κατ’ επιλογήν'),
(13, 11, 'Π-7020', 'Διαχείριση ενεργών αρχείων', 7, 2, 'Υποχρεωτικό');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_failed_logins`
--

CREATE TABLE `uni_failed_logins` (
  `id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `attempt_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_grades`
--

CREATE TABLE `uni_grades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `grade` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `uni_grades`
--

INSERT INTO `uni_grades` (`id`, `user_id`, `course_id`, `grade`) VALUES
(1, 1, 1, 8),
(2, 1, 2, 6),
(3, 1, 3, 7),
(4, 1, 4, 5),
(5, 1, 5, 9),
(7, 2, 7, 9),
(8, 2, 8, 10),
(9, 2, 9, 5),
(10, 2, 10, 8),
(11, 2, 11, 10),
(12, 2, 12, 8),
(13, 2, 13, 10);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_statements`
--

CREATE TABLE `uni_statements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `uni_statements`
--

INSERT INTO `uni_statements` (`id`, `user_id`, `semester`, `year`) VALUES
(1, 1, 'ΕΑΡ', '2019-2020'),
(2, 1, 'ΧΕΙΜ', '2020-2021'),
(3, 2, 'ΧΕΙΜ ', '2017-2018'),
(4, 2, 'ΕΑΡ', '2016-2017'),
(5, 2, 'ΕΑΡ', '2017-2018');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_statements_meta`
--

CREATE TABLE `uni_statements_meta` (
  `id` int(11) NOT NULL,
  `statement_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `uni_statements_meta`
--

INSERT INTO `uni_statements_meta` (`id`, `statement_id`, `course_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 2, 5),
(5, 2, 6),
(6, 3, 7),
(7, 3, 8),
(8, 3, 9),
(9, 4, 10),
(10, 4, 11),
(11, 5, 12),
(12, 3, 13);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `uni_users`
--

CREATE TABLE `uni_users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_ip` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aem` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_semester` tinyint(3) UNSIGNED NOT NULL,
  `phone` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` mediumint(8) UNSIGNED NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `uni_users`
--

INSERT INTO `uni_users` (`id`, `username`, `password`, `last_ip`, `name`, `surname`, `aem`, `department`, `current_semester`, `phone`, `email`, `street`, `postal_code`, `town`, `country`) VALUES
(1, 'user1', '$2y$10$g73YtlBY01VH9/OHw6mH9OXOEKiyxc7b4FGa9ygZZWOHAlZUHR2Pi', NULL, 'Αναστάσιος', 'Αναστασίου', 'lb140001', 'ΑΡΧΕΙΟΝΟΜΙΑΣ, ΒΙΒΛΙΟΘΗΚΟΝΟΜΙΑΣ ΚΑΙ ΣΥΣΤΗΜΑΤΩΝ ΠΛΗΡΟΦΟΡΗΣΗΣ', 6, '00301234567890', 'test@example.com', 'Εθνικής Αμύνης 23', 123456, 'Αθήνα', 'Ελλάδα'),
(2, 'ntina', '$2y$10$3u5tMcxEqQ/C8tYzMhKgN.B834VY63mLoiikvu/S.Fj3Tc1uHOrwG', NULL, 'Κωνσταντίνα', 'Μπεκιάρη', 'lb13118', 'ΑΡΧΕΙΟΝΟΜΙΑΣ, ΒΙΒΛΙΟΘΗΚΟΝΟΜΙΑΣ ΚΑΙ ΣΥΣΤΗΜΑΤΩΝ ΠΛΗΡΟΦΟΡΗΣΗΣ', 15, '6977262017', 'lb13118@uniwa.gr', 'Αμυνάνδρου 11', 11741, 'Κουκάκι Αθήνα', 'Ελλάδα');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `uni_blacklist`
--
ALTER TABLE `uni_blacklist`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `uni_courses`
--
ALTER TABLE `uni_courses`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `uni_failed_logins`
--
ALTER TABLE `uni_failed_logins`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `uni_grades`
--
ALTER TABLE `uni_grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Ευρετήρια για πίνακα `uni_statements`
--
ALTER TABLE `uni_statements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Ευρετήρια για πίνακα `uni_statements_meta`
--
ALTER TABLE `uni_statements_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `statement_id` (`statement_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Ευρετήρια για πίνακα `uni_users`
--
ALTER TABLE `uni_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `uni_blacklist`
--
ALTER TABLE `uni_blacklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT για πίνακα `uni_courses`
--
ALTER TABLE `uni_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT για πίνακα `uni_failed_logins`
--
ALTER TABLE `uni_failed_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT για πίνακα `uni_grades`
--
ALTER TABLE `uni_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT για πίνακα `uni_statements`
--
ALTER TABLE `uni_statements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT για πίνακα `uni_statements_meta`
--
ALTER TABLE `uni_statements_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT για πίνακα `uni_users`
--
ALTER TABLE `uni_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
