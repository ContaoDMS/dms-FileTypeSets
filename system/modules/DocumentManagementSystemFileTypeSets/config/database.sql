-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

--
-- Table `tl_dms_file_type_sets`
--

CREATE TABLE `tl_dms_file_type_sets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `name` varchar(255) NOT NULL default '',
  `description` text NULL,
  `file_types` varchar(255) NOT NULL default '',
  `published` char(1) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_dms_categories`
--

CREATE TABLE `tl_dms_categories` (
  `file_type_sets` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

