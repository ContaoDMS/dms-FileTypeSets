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
 * Table tl_dms_file_type_sets
 */
$GLOBALS['TL_DCA']['tl_dms_file_type_sets'] = array
(
	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),
	
	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 2,
			'fields'                  => array('name'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;sort,search,limit'
		),
		'label' => array
		(
			'fields'                  => array('icon', 'name', 'file_types'),
			'showColumns'             => true,
			'label_callback'          => array('tl_dms_file_type_sets', 'addIcon')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_dms_file_type_sets', 'toggleIcon')
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),
	
	// Palettes
	'palettes' => array
	(
		'default'                     => '{title_legend},name,description;{file_types_legend},file_types;{publish_legend},published'
	),
	
	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['name'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'unique'=>true, 'doNotCopy'=>true),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:60px;'),
			'sql'                     => "text NULL"
		),
		'file_types' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['file_types'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50', 'doNotSaveEmpty'=>true),
			'save_callback'           => array(array('tl_dms_file_type_sets', 'saveFileTypes')),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'published' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_dms_file_type_sets']['published'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)
	)
);

/**
 * Class tl_dms_file_type_sets
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Cliff Parnitzky 2014-2015
 * @author     Cliff Parnitzky
 * @package    Controller
 */
class tl_dms_file_type_sets extends Backend
{
	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}
	
	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @param DataContainer
	 * @param array
	 * @return string
	 */
	public function addIcon($row, $label, DataContainer $dc, $args)
	{
		$image = 'file_type_sets';
		
		if (!$row['published'])
		{
			$image .= '_';
		}
		
		$args[0] = sprintf('<div class="list_icon_new" style="background-image:url(\'system/modules/DocumentManagementSystemFileTypeSets/assets/%s.png\'); height: 16px;" data-icon="system/modules/DocumentManagementSystemFileTypeSets/assets/%s.png" data-icon-disabled="system/modules/DocumentManagementSystemFileTypeSets/assets/%s.png">&nbsp;</div>', $image, rtrim($image, '_'), rtrim($image, '_') . '_');
		
		$args[2] = \ContaoDMS\DmsFileTypeSetsHelper::getCuttedAllowedFileTypes($row['file_types']);
		
		return $args;
	}
	
	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen($this->Input->get('tid')))
		{
			$this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
			$this->redirect($this->getReferer());
		}

		// Check permissions AFTER checking the tid, so hacking attempts are logged
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_file_type_sets::published', 'alexf'))
		{
			return '';
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label, 'data-state="' . ($row['published'] ? 1 : 0) . '"').'</a> ';
	}

	/**
	 * Publish/unpublish a file type set
	 * @param integer
	 * @param boolean
	 */
	public function toggleVisibility($intId, $blnVisible)
	{
		// Check permissions
		if (!$this->User->isAdmin && !$this->User->hasAccess('tl_dms_file_type_sets::published', 'alexf'))
		{
			$this->log('Not enough permissions to publish/unpublish dms file type set ID "'.$intId.'"', 'tl_dms_file_type_sets toggleVisibility', TL_ERROR);
			$this->redirect('contao/main.php?act=error');
		}

		$this->createInitialVersion('tl_dms_file_type_sets', $intId);
	
		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_dms_file_type_sets']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_dms_file_type_sets']['fields']['published']['save_callback'] as $callback)
			{
				$this->import($callback[0]);
				$blnVisible = $this->{$callback[0]}->{$callback[1]}($blnVisible, $this);
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_dms_file_type_sets SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$this->createNewVersion('tl_dms_file_type_sets', $intId);
	}
	
	/**
	 * Cleanup the files types before saving
	 */
	public function saveFileTypes($varValue, DataContainer $dc)
	{
		if (strlen($varValue) > 0)
		{
			$arrFileTypes = DmsUtils::getUniqueFileTypes($varValue);
			$varValue = implode(",", $arrFileTypes);
		}
		
		return $varValue;
	}
}
?>