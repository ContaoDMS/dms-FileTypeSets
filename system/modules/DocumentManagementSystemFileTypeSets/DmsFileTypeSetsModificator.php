<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2014 Leo Feyer
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
 * @copyright  Cliff Parnitzky 2014
 * @author     Cliff Parnitzky
 * @package    DocumentManagementSystem
 * @license    LGPL
 */

/**
 * Class DmsFileTypeSetsModificator
 * The loader of the dms
 */
class DmsFileTypeSetsModificator extends Controller
{
	/**
	 * Current object instance (do not remove)
	 * @var DmsLoader
	 */
	protected static $objInstance; 
	
	/**
	 * Initialize the object.
	 */
	protected function __construct()
	{
		parent::__construct();
		
		$this->import('Database');
		
		// TODO load all published file type sets here ....
	}
	
	/**
	 * Modify loaded categories.
	 */
	public function addFileTypeSetsToCategory(Category $category, Database_Result $dbResultCategory)
	{
		// do custom modification here
		return $category;
	}
}

?>