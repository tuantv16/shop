-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 26, 2024 lúc 10:49 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `disp_order` int(11) DEFAULT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `disp_order`, `disp`, `created_at`, `updated_at`) VALUES
(1, 'torano', 1, 1, '2023-11-26 19:36:46', '2023-11-26 19:36:46'),
(2, 'owen', 2, 1, '2023-11-26 19:36:50', '2023-11-26 19:36:50');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `prefix` varchar(30) NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `prefix`, `parent_id`, `level`, `disp`, `created_at`, `updated_at`) VALUES
(1, 'Đồ thể thao', 'TT', 0, 1, 1, '2023-11-26 19:38:05', '2023-11-26 19:38:05'),
(2, 'Thời trang nam', 'TTN', 0, 1, 1, '2023-11-26 19:38:09', '2023-11-26 19:38:09'),
(3, 'Thời trang nữ', 'TTNU', 0, 1, 1, '2023-11-26 19:38:11', '2023-11-26 19:38:11'),
(4, 'Giày thể thao', 'GTT', 2, 2, 1, '2023-12-03 23:23:02', '2023-12-03 23:23:02'),
(5, 'Quần nam', 'QN', 2, 2, 1, '2023-12-03 23:23:16', '2023-12-03 23:23:16'),
(6, 'Váy', 'VAY', 3, 2, 1, '2023-12-03 23:23:29', '2023-12-03 23:23:29'),
(7, 'Giày nữ', 'GN', 3, 2, 1, '2023-12-03 23:23:39', '2023-12-03 23:23:39'),
(8, 'Đồ bơi', 'DB', 1, 2, 1, '2023-12-03 23:23:58', '2023-12-03 23:23:58'),
(9, 'Đồ leo núi', 'DLN', 1, 2, 1, '2023-12-03 23:24:05', '2023-12-03 23:24:05'),
(10, 'Âm nhạc', 'AM', 0, 1, 1, '2023-12-21 23:58:38', '2023-12-21 23:58:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `account` varchar(255) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `wards` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `memo` text DEFAULT NULL,
  `disp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--

INSERT INTO `customers` (`id`, `account`, `customer_name`, `type`, `password`, `phone`, `email`, `birthday`, `gender`, `country`, `city`, `district`, `wards`, `address1`, `address2`, `address3`, `memo`, `disp`, `created_at`, `updated_at`) VALUES
(1, 'vantuant2', 'Trần Văn Tuấn-02', NULL, '$2y$12$e.8Hz488hPcVWOMhbzqyruLnBZs06reU9QcdvMlLemLLNEgtMSRB.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04 23:51:46', '2023-12-04 23:51:46'),
(2, 'guest1', 'trần văn tuấn', 99, '123456', '0874546454', 'tuan22@gmail.com', NULL, NULL, NULL, '01', '273', NULL, NULL, NULL, NULL, 'dgdf', NULL, '2023-12-21 23:50:55', '2023-12-21 23:50:55'),
(3, 'guest2', 'Trần Văn Tuấn', 99, '123456', '22222221111', 'sss@gmail.com', NULL, NULL, NULL, '31', '312', NULL, NULL, NULL, NULL, 'cc', NULL, '2023-12-22 01:24:47', '2023-12-22 01:24:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2023_11_19_063605_create_categories_table', 1),
(35, '2023_11_19_063606_create_brands_table', 1),
(36, '2023_11_19_063821_create_products_table', 1),
(37, '2023_11_19_065598_create_sizes_table', 1),
(38, '2023_11_19_065599_create_colors_table', 1),
(39, '2023_11_19_065601_create_product_details_table', 1),
(40, '2023_11_29_142546_create_surveys_table', 2),
(41, '2023_11_29_142806_create_feedbacks_table', 2),
(42, '2023_12_04_150159_create_customers_table', 3),
(43, '2023_12_09_151915_create_carts_table', 4),
(44, '2023_12_15_184252_create_orders_table', 5),
(45, '2023_12_16_162722_create_order_details_table', 5),
(46, '2023_12_22_101232_create_posts_table', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total` bigint(20) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_id`, `total`, `address`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'DHSHOP0001', 3, 1329000, 'dfsdfsdf, Xã An Hoà, Huyện An Dương, Thành phố Hải Phòng', 'sss@gmail.com', '22222221111', '2023-12-22 01:24:47', '2023-12-22 01:24:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(30) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `total_amount` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `order_code`, `product_id`, `product_code`, `customer_id`, `size_id`, `color_id`, `quantity`, `price`, `total_amount`, `created_at`, `updated_at`) VALUES
(4, 2, 'DHSHOP0001', 20, 'KL09', 3, 1, 6, 5, 99000, 495000, '2023-12-22 01:24:47', '2023-12-22 01:24:47'),
(5, 2, 'DHSHOP0001', 20, 'KL09', 3, 3, 8, 5, 99000, 495000, '2023-12-22 01:24:47', '2023-12-22 01:24:47'),
(6, 2, 'DHSHOP0001', 20, 'KL09', 3, 3, 6, 1, 99000, 99000, '2023-12-22 01:24:47', '2023-12-22 01:24:47'),
(7, 2, 'DHSHOP0001', 16, 'KL05', 3, 3, 2, 2, 120000, 240000, '2023-12-22 01:24:47', '2023-12-22 01:24:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(30) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `product_code`, `product_name`, `description`, `price`, `image`, `disp`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'MA001', 'quan dai', NULL, 190000.00, '', 1, '2023-11-26 19:39:58', '2023-11-26 19:39:58'),
(2, 2, 1, 'MA002', 'no ưbuộc', NULL, 150000.00, '', 1, '2023-11-26 20:38:27', '2023-11-26 20:38:27'),
(3, 1, 1, 'MA003', 'kichi ta', 'dád', 150000.00, NULL, 1, '2023-11-26 20:38:39', '2023-11-26 20:38:39'),
(4, 2, 1, 'MA004', 'long sương', 'dsss', 250000.00, NULL, 1, '2023-11-26 20:38:49', '2023-11-26 20:38:49'),
(5, 3, 2, 'CA001', 'hoa thiên lý', 'dfsdfsd', 2500000.00, NULL, 1, '2023-11-26 20:39:00', '2023-11-26 20:39:00'),
(6, 2, 2, 'CA002', 'lê nhài hoa', '250000', 1500000.00, NULL, 1, '2023-11-26 20:39:12', '2023-11-26 20:39:12'),
(7, 2, 1, 'CA003', 'dã tràng', 'dsfsdfsdf', 16000.00, NULL, 1, '2023-11-26 20:39:23', '2023-11-26 20:39:23'),
(8, 1, 2, 'CA004', 'đại bàng xanh', '44', 150000.00, '', 1, '2023-11-26 20:39:43', '2023-11-26 20:39:43'),
(9, 1, 1, 'CA005', 'maker hi', 'ff', 140000.00, '', 1, '2023-11-26 20:41:58', '2023-11-26 20:41:58'),
(10, 2, 1, 'CA006', 'thiên tài', 'd', 150000.00, '', 1, '2023-11-26 20:42:15', '2023-11-26 20:42:15'),
(11, 3, 2, 'CA007', 'xã hội n', 'dfs', 130000.00, '', 1, '2023-11-26 20:42:26', '2023-11-26 20:42:26'),
(12, 2, 1, 'KL01', 'đêm tiên', '22123', 2600000.00, '', 1, '2023-11-26 20:42:56', '2023-11-26 20:42:56'),
(13, 1, 1, 'KL02', 'heo hút', 'ssss', 160000.00, NULL, 1, '2023-11-26 20:43:12', '2023-11-26 20:43:12'),
(14, 8, 2, 'KL03', 'Giày đẹp 0001', 'dd', 150000.00, '1701676844_mwc.jpg', 1, '2023-12-03 23:28:26', '2023-12-03 23:28:26'),
(15, 8, 1, 'KL04', 'đồ bơi m0001', 'đ', 150000.00, '1701676054_images.jpg', 1, '2023-12-03 23:31:47', '2023-12-03 23:31:47'),
(16, 9, 1, 'KL05', 'leo núi 882', 'sss', 120000.00, '1701674422_074ef2b50b02be6d60a73eb7c97a8cf0.jpg', 1, '2023-12-03 23:34:33', '2023-12-03 23:34:33'),
(17, 5, 2, 'KL06', 'quần nam x0002', 'đ', 140000.00, 'aa.jpg', 1, '2023-12-04 00:00:45', '2023-12-04 00:00:45'),
(18, 6, 2, 'KL07', 'sản phẩm a8jj2', 'cccc', 170000.00, '1701674422_074ef2b50b02be6d60a73eb7c97a8cf0.jpg', 1, '2023-12-04 00:20:22', '2023-12-04 00:20:22'),
(19, 9, 2, 'KL08', 'test22', 'dd', 150000.00, '1701676054_images.jpg', 1, '2023-12-04 00:47:38', '2023-12-04 00:47:38'),
(20, 7, 2, 'KL09', 'giày nữ A002', '<h4>Bước 4: Sử dụng phần mềm chỉnh sửa ảnh</h4><p>Trước khi chụp ảnh, các bạn cũng nên chuẩn bị trước phần mềm chỉnh ảnh. Bởi thực tế, ngoài biết cách chụp ảnh đẹp thì phần chỉnh sửa ảnh cũng rất quan trọng giúp bức ảnh trở nên đẹp và hài hoà màu sắc hơn.</p><p>Nếu chỉnh sửa ảnh trên máy tính, các bạn có thể tham khảo một số phần mềm như: Photoshop, AI, Lightroom,…</p><p>Trường hợp chỉnh sửa trên điện thoại có thể dùng một số phần mềm như: Lightroom, Snapseed, VSCO, Canva, Picsart, Snapseed,…</p><p>Nên nhớ rằng, cách chụp giày đẹp giúp tạo ra nhiều bức hình chất lượng, nhưng nếu biết sử dụng phần mềm chỉnh sửa ảnh, đôi giày mà bạn chụp sẽ trở nên hoàn hảo và thu hút hơn.</p><h3>2. Cách chụp ảnh giày đẹp33</h3><p>Sau khi chuẩn bị xong các yếu tố cần thiết cho việc chụp hình, bạn có thể tiến hành chụp ngay sản phẩm giày của mình rồi nhé! Tuy nhiên để cách chụp hình giày đẹp đạt hiệu quả tốt nhất, bạn cần lựa chọn một số góc chụp phổ biến dưới đây.</p><h4>Góc chụp từ trên xuống hoặc từ dưới lên</h4><p>Để thấy rõ được tổng thể, góc chụp từ trên xuống dưới hoặc từ dưới lên là cách phổ biến nhất giúp làm được điều này. Ngoài ra, cách chụp hình giày đẹp với góc chụp này còn giúp người xem dễ dàng hình dung về sản phẩm hơn.</p><h4>Góc chụp cận cảnh</h4><p>Góc chụp cận cảnh thường được dùng trong các bức hình muốn “nhấn mạnh” chất liệu, chi tiết cũng như kiểu dáng của sản phẩm. Đây cũng là góc chụp phù hợp với những sản phẩm như điện thoại, đồng hồ, quần, áo, đồ điện tử,…</p>', 99000.00, '1702289067_mwc.jpg', 1, '2023-12-04 01:00:44', '2023-12-21 23:34:21'),
(21, 8, 2, 'ax', 'áo dài đẹp 01', 'ss4', 150000.00, '1702289098_tải xuống.jpg', 1, '2023-12-11 01:28:00', '2023-12-11 03:05:11'),
(22, 9, 1, 'bv', 'test22', 'gg', 350000.00, NULL, 1, '2023-12-22 00:09:06', '2023-12-22 00:09:06'),
(23, 2, 2, 'TTN23', 'tuan lot', '<p>sss</p>', 270000.00, NULL, 1, '2023-12-22 00:24:11', '2023-12-22 00:25:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_details`
--

CREATE TABLE `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `order_id`, `order_code`, `size_id`, `color_id`, `quantity`, `disp`, `created_at`, `updated_at`) VALUES
(11, 5, 0, '', 1, 1, 1, 1, '2023-11-29 00:53:10', '2023-11-29 00:53:10'),
(12, 5, 0, '', 2, 1, 2, 1, '2023-11-29 00:53:10', '2023-11-29 00:53:10'),
(13, 5, 0, '', 3, 1, 3, 0, '2023-11-29 00:53:10', '2023-11-29 00:53:10'),
(15, 20, 0, '', 1, 6, 20, 1, '2023-12-05 23:50:04', '2023-12-05 23:50:04'),
(16, 20, 0, '', 3, 8, 1000, 1, '2023-12-05 23:50:04', '2023-12-05 23:50:04'),
(21, 19, 0, '', 2, 7, 20, 1, '2023-12-06 00:01:13', '2023-12-06 00:01:13'),
(22, 19, 0, '', 4, 5, 20, 1, '2023-12-06 00:01:13', '2023-12-06 00:01:13'),
(23, 19, 0, '', 2, 2, 23, 1, '2023-12-06 00:01:13', '2023-12-06 00:01:13'),
(24, 16, 0, '', 1, 2, 23, 1, '2023-12-06 00:07:22', '2023-12-06 00:07:22'),
(25, 16, 0, '', 3, 2, 15, 1, '2023-12-06 00:07:22', '2023-12-06 00:07:22'),
(26, 16, 0, '', 4, 3, 23, 1, '2023-12-06 00:07:22', '2023-12-06 00:07:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic` varchar(255) NOT NULL,
  `disp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `surveys`
--

INSERT INTO `surveys` (`id`, `topic`, `disp`, `created_at`, `updated_at`) VALUES
(1, 'Làm thế nào để có thu nhập thụ động', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_survey_id_foreign` (`survey_id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_details_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD CONSTRAINT `feedbacks_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
