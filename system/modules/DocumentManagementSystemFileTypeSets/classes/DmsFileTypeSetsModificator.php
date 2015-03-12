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
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;

/**
 * Class DmsFileTypeSetsModificator
 * Modifies the files types.
 */
class DmsFileTypeSetsModificator extends \Controller
{
	/**
	 * Current object instance (do not remove)
	 * @var DmsFileTypeSetsModificator
	 */
	protected static $objInstance;
	
	/**
	 * The List of published fil
	 * @var array
	 */
	private $arrPublishedFileTypeSets = array();

	/**
	 * Initialize the object.
	 */
	protected function __construct()
	{
		parent::__construct();

		$this->import('Database');

		$objFileTypeSets = $this->Database->prepare("SELECT id, file_types FROM tl_dms_file_type_sets WHERE published = 1")
										  ->execute();

		while ($objFileTypeSets->next())
		{
			$this->arrPublishedFileTypeSets[$objFileTypeSets->id] = $objFileTypeSets->file_types;
		}
	}

	/**
	 * Return the current object instance (Singleton)
	 * @return DmsFileTypeSetsModificator
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new self();
		}

		return self::$objInstance;
	}

	/**
	 * Modify loaded categories.
	 */
	public function addFileTypeSetsToCategory(\Category $category, \Database_Result $dbResultCategory)
	{
		$arrFileTypesOfSets = array();
		$arrFileTypeSetIds = deserialize($dbResultCategory->file_type_sets);
		if (!empty($arrFileTypeSetIds))
		{
			foreach($arrFileTypeSetIds as $arrFileTypeSetId)
			{
				$arrFileTypesOfSets = array_merge($arrFileTypesOfSets, explode(",", $this->arrPublishedFileTypeSets[$arrFileTypeSetId]));
			}
		
		}
		
		$arrFileTypes = \DmsUtils::getUniqueFileTypes($category->fileTypes, $arrFileTypesOfSets);
		
		$category->fileTypes = implode(",", $arrFileTypes);
		return $category;
	}
}

?>