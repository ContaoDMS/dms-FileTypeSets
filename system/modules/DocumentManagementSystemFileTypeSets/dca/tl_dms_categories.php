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

// List
$GLOBALS['TL_DCA']['tl_dms_categories']['list']['label']['fields'] = array('name');
$GLOBALS['TL_DCA']['tl_dms_categories']['list']['label']['format'] = '<span style="padding-left:5px;">%s</span>';
$GLOBALS['TL_DCA']['tl_dms_categories']['list']['label']['label_callback'] = array('tl_dms_categories_dms_file_type_sets', 'addIcon');

// Palettes
$GLOBALS['TL_DCA']['tl_dms_categories']['palettes']['default'] = str_replace('file_types_inherit', 'file_types_inherit,file_type_sets', $GLOBALS['TL_DCA']['tl_dms_categories']['palettes']['default']);

// Fields
$GLOBALS['TL_DCA']['tl_dms_categories']['fields']['file_type_sets'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_dms_categories']['file_type_sets'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_dms_categories_dms_file_type_sets', 'getActiveFileTypeSets'),
	'eval'                    => array('tl_class'=>'w50 clr', 'multiple'=>true),
	'sql'                     => "blob NULL"
);

/**
 * Class tl_dms_categories_dms_file_type_sets
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_categories_dms_file_type_sets extends tl_dms_categories
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Returns all active (published) file type sets
	 */
	public function getActiveFileTypeSets(DataContainer $dc)
	{
		$arrFileTypeSets = array();
		
		$objFileTypeSets = $this->Database->prepare("SELECT * FROM tl_dms_file_type_sets WHERE published = 1 ORDER BY name")
								->execute();
		
		while($objFileTypeSets->next())
		{
			$arrFileTypeSets[$objFileTypeSets->id] = $objFileTypeSets->name . "<span style=\"color:#b3b3b3; padding-left:3px;\">[" . $objFileTypeSets->file_types .  "]</span>";
		}
		
		return $arrFileTypeSets;
	}
	
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc=null, $imageAttribute='', $blnReturnImage=false, $blnProtected=false)
	{
		$arrFileTypesOfSets = array();
		
		$arrFileTypeSetIds = deserialize($row['file_type_sets']);
		if (!empty($arrFileTypeSetIds))
		{
			$objFileTypeSets = $this->Database->prepare("SELECT file_types FROM tl_dms_file_type_sets WHERE id IN (" . implode(",", $arrFileTypeSetIds) . ") AND published = 1")
								->execute();
		
			while($objFileTypeSets->next())
			{
				$arrFileTypesOfSets = array_merge($arrFileTypesOfSets, explode(",", $objFileTypeSets->file_types));
			}
		}
		
		$arrFileTypes = DmsUtils::getUniqueFileTypes($row['file_types'], $arrFileTypesOfSets);
		
		if (!empty($arrFileTypes))
		{
			$label .= '<span style="color:#b3b3b3; padding-left:3px;">[' . implode(",", $arrFileTypes) . ']</span>';;
		}
		
		return parent::addIcon($row, $label, $dc, $imageAttribute, $blnReturnImage, $blnProtected);
	}
}

?>