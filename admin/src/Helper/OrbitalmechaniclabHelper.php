<?php 
/*
  * @package component kwpsolarsystem for Joomla! 5.x 6.x
 * @version $Id: kwpsolarsystem 1.0.0 2026-05-05 01:10:10Z $
 * @author KWProductions Co.
 * @copyright (C) 2022- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of kwpsolarsystem.
    kwpsolarsystem is free software: you can redistribute it and/or adify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    kwpsolarsystem is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for are details.
    You should have received a copy of the GNU General Public License
    along with kwpsolarsystem.  If not, see <http://www.gnu.org/licenses/>.
 
*/

?>
<?php
/**
 * @package     com_kwpsolarsystem
 * @version     1.0.0
 * @copyright   Copyright (C) 2025. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      KWProductions Co. <webarchitect@kwproductions121.ir> - https://componentgenerator.com
 */

namespace KWP121\Component\Orbitalmechaniclab\Administrator\Helper;


// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Database\Mysqli\MysqliQuery;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\HTML\Helpers\Sidebar;



/**
 * Kwpsolarsystem helper class
 */
class OrbitalmechaniclabHelper
{
	/**
	 * Add the submenus
	 *
	 * @param string $name
	 */
	public static function addSubmenu($name = '')
	{
		Sidebar::addEntry(
			Text::_('COM_ORBITALMECHANICLAB_TITLE_ORBITALMECHANICLABS'),
			'index.php?option=com_orbitalmechaniclab&view=orbitalmechaniclabs',
			$name === 'orbitalmechaniclabs'
		);
	}

	/**
	 * Gets a list of the actions that can be performed
	 *
	 * @return array
	 * @since    1.6
	 */
	public static function getActions() : array
	{
		$user	= Factory::getUser();
		$result	= [];

		$assetName = 'com_orbitalmechaniclab';

		$actions = [
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.state', 'core.edit.own', 'core.delete'
		];

		foreach ($actions as $action)
		{
			$result[$action] = $user->authorise($action, $assetName);
		}

		return $result;
	}

	/**
	 * Build the search query from the columns
	 *
	 * @param	string		        $searchPhrase	    Search for this phrase
	 * @param	array		        $searchColumns	    The columns in the DB to look up
	 * @param   MysqliQuery         $query              The query
	 *
	 * @return	MysqliQuery		    $query			    The query (search filters applied)
	 */
	public static function buildSearchQuery(string $searchPhrase, array $searchColumns, MysqliQuery $query) : MysqliQuery
	{
		$db = Factory::getDbo();

		$where = [];

		foreach ($searchColumns as $i => $searchColumn)
		{
			$where[] = $db->qn($searchColumn) . ' LIKE ' . $db->q('%' . $db->escape($searchPhrase, true) . '%');
		}

		if (!empty($where))
		{
			$query->where('(' . implode(' OR ', $where) . ')');
		}

		return $query;
	}

}
