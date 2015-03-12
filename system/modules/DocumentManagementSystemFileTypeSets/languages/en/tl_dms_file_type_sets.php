<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystemFileTypeSets
 * @license    LGPL
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['name']        = array('Name', 'Specify the name of the file type set.');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['description'] = array('Description', 'Specify a description for this file type set.');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['file_types']  = array('Allowed file types', 'Specify a comma separated list of file types for this file type set. The list will be sorted automatically when saving and all file types are converted to lowercase.');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['published']   = array('Publish file type set', 'Specify whether the file type set should be publicly visible.');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['title_legend']      = 'File type set';
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['file_types_legend'] = 'File types';
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['publish_legend']    = 'Publish settings';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['new']    = array('New file type set', 'Create a new file type set');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['show']   = array('File type set details', 'Show the details of file type set ID %s');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['edit']   = array('Edit file type set', 'Edit file type set ID %s');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['copy']   = array('Duplicate file type set', 'Duplicate file type set ID %s');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['delete'] = array('Delete file type set', 'Delete file type set ID %s');
$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['toggle'] = array('Publish/unpublish file type set', 'Publish/unpublish file type set ID %s');

?>