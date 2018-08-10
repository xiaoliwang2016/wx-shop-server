-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-08-10 22:42:57
-- 服务器版本： 5.7.19
-- PHP Version: 7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wx_shop`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `passwd` char(32) COLLATE utf8_bin NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `upload_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `name`, `passwd`, `delete_time`, `upload_time`) VALUES
(1, 'admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `banner`
--

DROP TABLE IF EXISTS `banner`;
CREATE TABLE IF NOT EXISTS `banner` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `banner_type` tinyint(3) UNSIGNED NOT NULL COMMENT '用作区分多个banner的标识',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT '1' COMMENT '0--无跳转  1--商品  2--类别',
  `type_id` tinyint(3) UNSIGNED NOT NULL COMMENT '跳转商品或者分类ID',
  `img` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'banner图片地址',
  `update_time` int(10) UNSIGNED NOT NULL,
  `delete_time` int(10) UNSIGNED DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `banner`
--

INSERT INTO `banner` (`id`, `banner_type`, `type`, `type_id`, `img`, `update_time`, `delete_time`) VALUES
(1, 1, 1, 5, 'http://wx.shop.com/uploads/images/banner/20180721\\\\4001856b2e49ad653bf9a4a10324284a.png', 1532145431, NULL),
(2, 1, 1, 6, 'http://wx.shop.com/uploads/images/banner/20180721\\\\ff550e087f706c4e7eac4bf6fb31391c.png', 1532145465, NULL),
(3, 1, 1, 7, 'http://wx.shop.com/uploads/images/banner/20180721\\\\a31f5c6b44737a13dd4fccba64e5a4ba.png', 1532145481, NULL),
(4, 2, 1, 4, 'wx.shop.com/uploads/images/banner/20180721\\\\a31f5c6b44737a13dd4fccba64e5a4ba.png', 1532145489, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL COMMENT '分类名称',
  `img` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '图片',
  `description` varchar(128) COLLATE utf8_bin DEFAULT NULL COMMENT '描述',
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `img`, `description`, `update_time`, `delete_time`) VALUES
(1, '果味', 'http://wx.shop.com/uploads/images/category/20180721\\\\9df5332f29d98d3e7c222bb825644116.png', '果味', 1532147481, NULL),
(2, '蔬菜', 'http://wx.shop.com/uploads/images/category/20180721\\\\6b5364326ecbe45280ae4fabdcebbc96.png', '蔬菜', 1532147557, NULL),
(3, '炒货', 'http://wx.shop.com/uploads/images/category/20180721\\\\0a1a0c3c7de851aa1b259231187dfe91.png', '炒货', 1532147592, NULL),
(4, '点心', 'http://wx.shop.com/uploads/images/category/20180721\\\\2293434b20f2465ba852f60c0cfd1f0b.png', '点心', 1532147618, NULL),
(5, '粗茶', 'http://wx.shop.com/uploads/images/category/20180721\\\\66fe0aa9640eeff69a52df4d6e1c74ba.png', '粗茶', 1532147655, NULL),
(6, '淡饭', 'http://wx.shop.com/uploads/images/category/20180721\\\\98ba2f9b38d8840543fe1563d47908d3.png', '淡饭', 1532147685, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

DROP TABLE IF EXISTS `goods`;
CREATE TABLE IF NOT EXISTS `goods` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_bin NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `stock` smallint(5) UNSIGNED NOT NULL DEFAULT '0' COMMENT '库存',
  `category_id` tinyint(3) UNSIGNED NOT NULL COMMENT '分类ID',
  `summary` text COLLATE utf8_bin,
  `img` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '主图',
  `property_name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '商品属性名，多个用&隔开',
  `property_value` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '商品属性值，多个用&隔开',
  `update_time` int(10) UNSIGNED DEFAULT NULL,
  `delete_time` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `stock`, `category_id`, `summary`, `img`, `property_name`, `property_value`, `update_time`, `delete_time`) VALUES
(2, '夏日芒果  3个', '10.00', 195, 1, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '产地&生产日期&单个重量', '海南&2018-06-01&500g', 1532703996, NULL),
(3, '夏日芒果  3个', '10.00', 199, 1, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '产地&生产日期&单个重量', '海南&2018-06-01&500g', 1532199058, NULL),
(4, '夏日芒果  3个', '10.00', 199, 1, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '产地&生产日期&单个重量', '海南&2018-06-01&500g', 1532199059, NULL),
(5, '夏日芒果  3个', '10.00', 199, 1, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '产地&生产日期&单个重量', '海南&2018-06-01&500g', 1532199059, NULL),
(6, '夏日芒果  3个', '10.00', 199, 1, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '产地&生产日期&单个重量', '海南&2018-06-01&500g', 1532199059, NULL),
(7, '芹菜  半斤', '3.00', 45, 2, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\7302a99ab4aeed37d560324e84dc9464.png', '产地&生产日期&重量', '东北&2018-06-01&250g', 1532703996, NULL),
(8, '芹菜  半斤', '3.00', 50, 2, NULL, 'http://wx.shop.com/uploads/images/goods/20180722\\\\7302a99ab4aeed37d560324e84dc9464.png', '产地&生产日期&重量', '东北&2018-06-01&250g', 1532199166, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `order_no` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '订单号',
  `uid` smallint(6) NOT NULL COMMENT '外键，用户id，注意并不是openid',
  `total_count` smallint(6) NOT NULL COMMENT '总数量',
  `total_price` decimal(6,2) NOT NULL COMMENT '总金额',
  `status` tinyint(4) NOT NULL COMMENT '1:未支付， 2：已支付，3：已发货 , 4: 已支付，但库存不足',
  `snap_img` varchar(255) COLLATE utf8_bin NOT NULL COMMENT '订单主页显示图片',
  `snap_name` varchar(80) COLLATE utf8_bin NOT NULL COMMENT '订单名称',
  `snap_address` varchar(500) COLLATE utf8_bin NOT NULL COMMENT '地址快照（json）',
  `snap_goods` text COLLATE utf8_bin NOT NULL COMMENT '订单商品快照（json）',
  `prepay_id` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '订单微信支付的预订单id（用于发送模板消息）',
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_no` (`order_no`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `order_no`, `uid`, `total_count`, `total_price`, `status`, `snap_img`, `snap_name`, `snap_address`, `snap_goods`, `prepay_id`, `update_time`, `delete_time`) VALUES
(1, 'B727018750154671', 1, 6, '39.00', 1, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '夏日芒果  3个', '{\"id\":2,\"uid\":1,\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"15858581158\",\"province\":\"\\u6e56\\u5357\",\"city\":\"\\u6000\\u5316\",\"country\":\"\\u9e64\\u57ce\\u533a\",\"detail\":\"\\u706b\\u8f66\\u5357\\u7ad9\"}', '[{\"id\":2,\"haveStock\":true,\"count\":3,\"name\":\"\\u590f\\u65e5\\u8292\\u679c  3\\u4e2a\",\"img\":\"http:\\/\\/wx.shop.com\\/uploads\\/images\\/goods\\/20180722\\\\\\\\bb4b7ab466390158ee54345955982f5e.png\",\"total\":30},{\"id\":7,\"haveStock\":true,\"count\":3,\"name\":\"\\u82b9\\u83dc  \\u534a\\u65a4\",\"img\":\"http:\\/\\/wx.shop.com\\/uploads\\/images\\/goods\\/20180722\\\\\\\\7302a99ab4aeed37d560324e84dc9464.png\",\"total\":9}]', NULL, 1532701875, NULL),
(3, 'B727039656170497', 1, 1, '10.00', 1, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '夏日芒果  3个', '{\"id\":2,\"uid\":1,\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"15858581158\",\"province\":\"\\u6e56\\u5357\",\"city\":\"\\u6000\\u5316\",\"country\":\"\\u9e64\\u57ce\\u533a\",\"detail\":\"\\u706b\\u8f66\\u5357\\u7ad9\"}', '[{\"id\":2,\"haveStock\":true,\"count\":1,\"name\":\"\\u590f\\u65e5\\u8292\\u679c  3\\u4e2a\",\"img\":\"http:\\/\\/wx.shop.com\\/uploads\\/images\\/goods\\/20180722\\\\\\\\bb4b7ab466390158ee54345955982f5e.png\",\"total\":10}]', NULL, 1532703965, NULL),
(4, 'B727039961257847', 1, 8, '45.00', 1, 'http://wx.shop.com/uploads/images/goods/20180722\\\\bb4b7ab466390158ee54345955982f5e.png', '夏日芒果  3个', '{\"id\":2,\"uid\":1,\"name\":\"\\u5f20\\u4e09\",\"mobile\":\"15858581158\",\"province\":\"\\u6e56\\u5357\",\"city\":\"\\u6000\\u5316\",\"country\":\"\\u9e64\\u57ce\\u533a\",\"detail\":\"\\u706b\\u8f66\\u5357\\u7ad9\"}', '[{\"id\":2,\"haveStock\":true,\"count\":3,\"name\":\"\\u590f\\u65e5\\u8292\\u679c  3\\u4e2a\",\"img\":\"http:\\/\\/wx.shop.com\\/uploads\\/images\\/goods\\/20180722\\\\\\\\bb4b7ab466390158ee54345955982f5e.png\",\"total\":30},{\"id\":7,\"haveStock\":true,\"count\":5,\"name\":\"\\u82b9\\u83dc  \\u534a\\u65a4\",\"img\":\"http:\\/\\/wx.shop.com\\/uploads\\/images\\/goods\\/20180722\\\\\\\\7302a99ab4aeed37d560324e84dc9464.png\",\"total\":15}]', NULL, 1532703996, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `order_goods`
--

DROP TABLE IF EXISTS `order_goods`;
CREATE TABLE IF NOT EXISTS `order_goods` (
  `order_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `count` smallint(6) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `order_goods`
--

INSERT INTO `order_goods` (`order_id`, `goods_id`, `count`, `update_time`, `delete_time`) VALUES
(1, 2, 3, NULL, NULL),
(1, 7, 3, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 2, 3, NULL, NULL),
(4, 7, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` char(5) COLLATE utf8_bin NOT NULL,
  `img` varchar(128) COLLATE utf8_bin NOT NULL,
  `head_img` varchar(128) COLLATE utf8_bin NOT NULL,
  `description` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`id`, `name`, `img`, `head_img`, `description`, `delete_time`) VALUES
(1, '专题栏位一', 'http://wx.shop.com/uploads/images/theme/20180722\\\\bd0c5bbb5e36ea74dfb8f0880fcea422.png', 'http://wx.shop.com/uploads/images/theme/20180722\\\\3f9013221531c6816f3013915fd88758.png', NULL, NULL),
(2, '专题栏位二', 'http://wx.shop.com/uploads/images/theme/20180722\\\\4fa159f40584e93fa50016a3f9de9dec.png', 'http://wx.shop.com/uploads/images/theme/20180722\\\\514e26906f2be26d688d3e659fe5187b.png', NULL, NULL),
(3, '专题栏位三', 'http://wx.shop.com/uploads/images/theme/20180722\\\\ba3be7770f39f8c43207a4f9fda77e98.png', 'http://wx.shop.com/uploads/images/theme/20180722\\\\ba3be7770f39f8c43207a4f9fda77e98.png', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `theme_goods`
--

DROP TABLE IF EXISTS `theme_goods`;
CREATE TABLE IF NOT EXISTS `theme_goods` (
  `theme_id` smallint(5) UNSIGNED NOT NULL,
  `goods_id` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `theme_goods`
--

INSERT INTO `theme_goods` (`theme_id`, `goods_id`) VALUES
(1, 8),
(1, 7),
(1, 6),
(1, 5),
(3, 6),
(3, 5),
(3, 4),
(2, 2),
(2, 1),
(3, 3);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `openid` varchar(50) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(32) COLLATE utf8_bin DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `openid_3` (`openid`),
  KEY `openid` (`openid`),
  KEY `openid_2` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `openid`, `nickname`, `comment`, `delete_time`, `create_time`, `update_time`) VALUES
(1, 'ofcLS5JPS2FsFPhEN85X3_f_YM6Y', NULL, NULL, NULL, 1532384428, 1532384428);

-- --------------------------------------------------------

--
-- 表的结构 `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE IF NOT EXISTS `user_address` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '收货人',
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL,
  `province` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '省',
  `city` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '市',
  `country` varchar(16) COLLATE utf8_bin NOT NULL COMMENT '区',
  `detail` varchar(128) COLLATE utf8_bin NOT NULL COMMENT '具体地址',
  `delete_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `user_address`
--

INSERT INTO `user_address` (`id`, `uid`, `name`, `mobile`, `province`, `city`, `country`, `detail`, `delete_time`, `update_time`) VALUES
(2, 1, '张三', '15858581158', '湖南', '怀化', '鹤城区', '火车南站', NULL, 1532450623),
(3, 1, '李四', '15858581158', '广东', '东莞', '塘厦', '玉壶春', NULL, 1532451876);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
