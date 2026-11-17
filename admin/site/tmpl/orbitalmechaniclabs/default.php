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

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

//var_dump($this->items);
//exit();

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
			<?php if ($this->escape($this->params->get('page_heading'))) : ?>
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			<?php else : ?>
				<?php echo $this->escape($this->params->get('page_title')); ?>
			<?php endif; ?>
        </h1>
    </div>
<?php endif; ?>
<form action="<?php echo Route::_('index.php?option=com_orbitalmechaniclab&view=orbitalmechaniclabs'); ?>" method="get" name="adminForm" id="adminForm">
    <div id="filter-bar" class="btn-toolbar mb-2">
        <div class="input-group mb-2">
            <input type="text" name="filter_search" id="filter-search" class="form-control" placeholder="<?php echo Text::_('JSEARCH_FILTER'); ?>..." value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo Text::_('JSEARCH_FILTER'); ?>" />
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><?php echo Text::_('JSEARCH_FILTER'); ?></button>
                <button class="btn btn-secondary" id="clear-search" type="button"><?php echo Text::_('JSEARCH_FILTER_CLEAR'); ?></button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="item-created_by">
						List of Laboratories based on the order of Creation

					</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $i => $item) : ?>
                <tr class="<?php echo ($i % 2) ? 'odd' : 'even'; ?>">
                    <td>
						<a href="<?php echo Route::_('index.php?option=com_orbitalmechaniclab&view=orbitalmechaniclab&id='.$item->id); ?>"><?php echo $item->title; ?></a>
					</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination center">
            <?php echo $this->pagination->getListFooter(); ?>
        </div>
        <input type="hidden" name="view" value="orbitalmechaniclabs" />
        <input type="hidden" name="option" value="com_orbitalmechaniclab" />
        <input type="hidden" name="Itemid" value="<?php echo $this->item_id; ?>" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
    </div>
</form>
