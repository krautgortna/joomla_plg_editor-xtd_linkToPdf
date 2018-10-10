<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\Registry\Registry;

$params     = new Registry;
$dispatcher = JEventDispatcher::getInstance();
$doc = $this->_tmp_doc;
$dispatcher->trigger('onContentBeforeDisplay', array('com_media.file', &$doc, &$params)); 
?>

<li class="imgOutline thumbnail height-80 width-80 center">
	<a class="img-preview" href="javascript:ImageManager.populateFields('<?php echo $this->escape($doc->path_relative); ?>')" title="<?php echo $this->escape($doc->name); ?>" >
	  <div class="imgThumb" style="height: 100%;">
	    <div class="imgThumbInside">
			  <?php echo JHtml::_('image', $doc->icon_32, $this->escape($doc->name), null, true, true) ? JHtml::_('image', $doc->icon_32, $this->escape($doc->title), null, true) : JHtml::_('image', 'media/con_info.png', $this->escape($doc->name), null, true); ?>
			</div>
	  </div>

	  <div class="imgDetails small" title="<?php echo $this->escape($doc->name); ?>" >
		  <?php echo JHtml::_('string.truncate', $this->escape($doc->name), 10, false); ?>
	  </div>
	</a>
</li>

<?php $dispatcher->trigger('onContentAfterDisplay', array('com_media.file', &$doc, &$params)); ?>
