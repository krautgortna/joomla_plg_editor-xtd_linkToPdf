<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @author      krautgortna
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$input = JFactory::getApplication()->input;
?>
<li class="imgOutline thumbnail height-80 width-80 center">
	<a href="index.php?option=com_media&amp;view=imagesList&amp;tmpl=component&amp;folder=<?php echo rawurlencode($this->_tmp_folder->path_relative); ?>&amp;asset=<?php echo $input->getCmd('asset');?>&amp;author=<?php echo $input->getCmd('author');?>&amp;override=<?php echo $input->getCmd('override');?>" target="imageframe">
		<div class="imgFolder">
			<span class="icon-folder-2"></span>
		</div>
		<div class="small">
			<?php echo JHtml::_('string.truncate', $this->escape($this->_tmp_folder->name), 10, false); ?>
		</div>
	</a>
</li>
