<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2016 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2016-2016
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystemFileTypeSets
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace ContaoDMS;

/**
 * Class DmsFileTypeSetsHelper
 * Modifies the files types.
 */
class DmsFileTypeSetsHelper extends \Controller
{
	const MAX_LENGHT = 50;
	const AND_SO_ON = " ...";
	
	/**
	 * Return the current object instance (Singleton)
	 * @return DmsFileTypeSetsModificator
	 */
	public static function getCuttedAllowedFileTypes($strAllowedFileTypes)
	{
		if ($strAllowedFileTypes == null)
		{
			return "";
		}
		else if (strlen($strAllowedFileTypes) <= self::MAX_LENGHT)
		{
			return $strAllowedFileTypes;
		}

		return substr($strAllowedFileTypes, 0, self::MAX_LENGHT - strlen(self::AND_SO_ON)) . self::AND_SO_ON;
	}
}

?>