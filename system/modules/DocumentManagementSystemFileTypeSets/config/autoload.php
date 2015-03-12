<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package DocumentManagementSystemFileTypeSets
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'ContaoDMS',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'ContaoDMS\DmsFileTypeSetsModificator' => 'system/modules/DocumentManagementSystemFileTypeSets/classes/DmsFileTypeSetsModificator.php',
));
