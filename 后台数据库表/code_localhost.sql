-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2020-06-28 01:12:28
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `code.localhost`
--

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_access`
--

CREATE TABLE `z_admin_auth_access` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `username` varchar(20) NOT NULL COMMENT '管理员名',
  `group` int(10) UNSIGNED NOT NULL COMMENT '权限组所属'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限分配';

--
-- 转存表中的数据 `z_admin_auth_access`
--

INSERT INTO `z_admin_auth_access` (`id`, `username`, `group`) VALUES
(1, 'admin', 1);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_auth_group`
--

CREATE TABLE `z_admin_auth_group` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '组名',
  `rules` text NOT NULL COMMENT '规则ID',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员权限组' ROW_FORMAT=COMPACT;

--
-- 转存表中的数据 `z_admin_auth_group`
--

INSERT INTO `z_admin_auth_group` (`id`, `name`, `rules`, `create_time`, `update_time`) VALUES
(1, '超级权限组', '*', 1579786002, 1579786088),
(2, '二级权限组', '1,2,3,4', 1579786067, 1579951863);

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_generator`
--

CREATE TABLE `z_admin_generator` (
  `id` int(10) NOT NULL COMMENT '自增id',
  `table_name` varchar(20) NOT NULL COMMENT '生成表名',
  `table_comment` varchar(20) NOT NULL COMMENT '表注释',
  `catalogue_bind` varchar(50) NOT NULL DEFAULT '' COMMENT '二级目录所属',
  `executor` varchar(20) NOT NULL COMMENT '执行人',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='代码生成记录';

-- --------------------------------------------------------

--
-- 表的结构 `z_admin_user`
--

CREATE TABLE `z_admin_user` (
  `id` int(10) UNSIGNED NOT NULL COMMENT '自增id',
  `username` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `password_salt` char(10) NOT NULL DEFAULT '' COMMENT '密码盐',
  `last_login_ip` varchar(30) NOT NULL DEFAULT '' COMMENT '上次登陆IP',
  `last_login_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员用户表';

--
-- 转存表中的数据 `z_admin_user`
--

INSERT INTO `z_admin_user` (`id`, `username`, `password`, `password_salt`, `last_login_ip`, `last_login_time`, `create_time`, `update_time`) VALUES
(1, 'admin', '7a06543f83b717722d79d60aa3800aad', 'ETSLP', '127.0.0.1', 1593277926, 1579237406, 1593277926);

-- --------------------------------------------------------

--
-- 表的结构 `z_catalogue`
--

CREATE TABLE `z_catalogue` (
  `id` int(10) NOT NULL COMMENT '自增id',
  `catalogue_name` varchar(20) NOT NULL COMMENT '目录名',
  `icon` varchar(10) NOT NULL COMMENT '图标',
  `executor` varchar(20) NOT NULL DEFAULT 'admin' COMMENT '执行人',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='生成表目录';

--
-- 转储表的索引
--

--
-- 表的索引 `z_admin_auth_access`
--
ALTER TABLE `z_admin_auth_access`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `z_admin_auth_group`
--
ALTER TABLE `z_admin_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `z_admin_generator`
--
ALTER TABLE `z_admin_generator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `table_name` (`table_name`);

--
-- 表的索引 `z_admin_user`
--
ALTER TABLE `z_admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_2` (`username`),
  ADD KEY `username` (`username`),
  ADD KEY `create_time` (`create_time`);

--
-- 表的索引 `z_catalogue`
--
ALTER TABLE `z_catalogue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogue_name` (`catalogue_name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `z_admin_auth_access`
--
ALTER TABLE `z_admin_auth_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `z_admin_auth_group`
--
ALTER TABLE `z_admin_auth_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `z_admin_generator`
--
ALTER TABLE `z_admin_generator`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id';

--
-- 使用表AUTO_INCREMENT `z_admin_user`
--
ALTER TABLE `z_admin_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '自增id', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `z_catalogue`
--
ALTER TABLE `z_catalogue`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增id';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
