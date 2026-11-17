<?php 
/*
  * @package component orbitalmechaniclab for Joomla! 5.x 6.x
 * @version $Id: orbitalmechaniclab 1.0.0 2026-05-05 01:10:10Z $
 * @author KWProductions Co.
 * @copyright (C) 2022- KWProductions Co.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of orbitalmechaniclab.
    orbitalmechaniclab is free software: you can redistribute it and/or adify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    orbitalmechaniclab is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for are details.
    You should have received a copy of the GNU General Public License
    along with orbitalmechaniclab.  If not, see <http://www.gnu.org/licenses/>.
 
*/

?>
<?php
/**
 * @package     com_orbitalmechaniclab
 * @version     1.0.0
 * @copyright   Copyright (C) 2025. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      KWProductions Co. <webarchitect@kwproductions121.ir> - https://componentgenerator.com
 */

namespace KWP121\Component\Orbitalmechaniclab\Administrator\Model;


// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\UCM\UCMType;
use Joomla\Registry\Registry;
use Joomla\CMS\Table\Table;



/**
 * Kwpsolarsystem model
 */
class OrbitalmechaniclabModel extends AdminModel
{
	/**
	 * @var		string	The prefix to use with controller messages
	 * @since	1.6
	 */
	//protected $text_prefix = 'ORBITALMECHANICLAB';
	// I added myself
	    public $typeAlias = 'com_orbitalmechaniclab.orbitalmechaniclab';
		   // protected $formName = 'orbitalmechaniclab';



	/**
	 * Method to get the record form.
	 *
	 * @param    array $data An optional array of data for the form to interogate
	 * @param bool $loadData
	 *
	 * @return bool A JForm object on success, false on failure
     * @throws \Exception
	 * @since    1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
	
		$form = $this->loadForm('com_orbitalmechaniclab.'.$this->formName, 'orbitalmechaniclab', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form
	 *
	 * @return	mixed	The data for the form
     * @throws  \Exception
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		
		// Check the session for previously entered form data
		$data = Factory::getApplication()->getUserState('com_orbitalmechaniclab.edit.orbitalmechaniclab.data', array());
     
		if (empty($data))
		{
			$data = $this->getItem();
			
		}

        return $data;
	}
	


    public function getItem($pk = null){
		
		$item = parent::getItem($pk);
	
		
		if($item->visual!==NULL && property_exists($item, "visual") && is_array($item->visual) == false){
			$registry = new Registry();
			$registry->loadString($item->visual, 'JSON');
			$item->visual= $registry->toArray();						
		}
	
		
		return($item);
	}

	/**
	 * Prepare and sanitise the table prior to saving
	 *
	 * @since	1.6
	 */
	protected function prepareTable($table)
	{

		if (empty($table->id))
		{
			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = Factory::getDbo();
                $query = $db->getQuery(true)
                    ->select('MAX(ordering)')
                    ->from($db->qn('#__orbitalmechaniclab'));
				$db->setQuery($query);
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}
		}
	}

	
}
