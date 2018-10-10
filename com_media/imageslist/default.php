<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @author      krautgortna
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$lang = JFactory::getLanguage();

JHtml::_('stylesheet', 'media/popup-imagelist.css', array('version' => 'auto', 'relative' => true));

if ($lang->isRtl())
{
	JHtml::_('stylesheet', 'media/popup-imagelist_rtl.css', array('version' => 'auto', 'relative' => true));
}

JFactory::getDocument()->addScriptDeclaration('var ImageManager = window.parent.ImageManager;');

if ($lang->isRtl())
{
	JFactory::getDocument()->addStyleDeclaration(
		'
			@media (max-width: 767px) {
				li.imgOutline.thumbnail.height-80.width-80.center {
					float: right;
					margin-right: 15px;
				}
			}
		'
	);
}
else
{
	JFactory::getDocument()->addStyleDeclaration(
		'
			@media (max-width: 767px) {
				li.imgOutline.thumbnail.height-80.width-80.center {
					float: left;
					margin-left: 15px;
				}
			}
		'
	);
}
?>
<!-- krauthos -->
<?php 
$input      = JFactory::getApplication()->input;
$override   = $input->getCmd('override');
?>
<?php
	function setDoc($index = 0)
	{
		if (isset($this->documents[$index]))
		{
			$this->_tmp_doc = &$this->documents[$index];
		}
		else
		{
			$this->_tmp_doc = new JObject;
		}
	}
?>

<?php //show documents hack 
  $docs = $this->get('documents');
  $this->documents = $docs;
?>
<?php if ($override == 'pdflink') : ?>
    <?php if (count($docs) > 0 || count($this->folders) > 0) : ?>
	    <ul class="manager thumbnails thumbnails-media">
		    <?php for ($i = 0, $n = count($this->folders); $i < $n; $i++) :
			    $this->setFolder($i);
			    echo $this->loadTemplate('folder');
		    endfor; ?>
		    
		    <?php for ($i = 0, $n = count($docs); $i < $n; $i++) :
		      if (isset($this->documents[$i]))
		      {
			      $this->_tmp_doc = &$this->documents[$i];
		      }
		      else
		      {
			      $this->_tmp_doc = new JObject;
		      }
			    echo $this->loadTemplate('doc');
		    endfor; ?>
	    </ul>

    <?php else : ?>
	    <div id="media-noimages">
		    <div class="alert alert-info">No documents found</div>
	    </div>
    <?php endif; ?>
<?php else: ?>
    <?php if (count($this->images) > 0 || count($this->folders) > 0) : ?>
	    <ul class="manager thumbnails thumbnails-media">
		    <?php for ($i = 0, $n = count($this->folders); $i < $n; $i++) :
			    $this->setFolder($i);
			    echo $this->loadTemplate('folder');
		    endfor; ?>

		    <?php for ($i = 0, $n = count($this->images); $i < $n; $i++) :
			    $this->setImage($i);
			    echo $this->loadTemplate('image');
		    endfor; ?>
	    </ul>


    <?php else : ?>
	    <div id="media-noimages">
		    <div class="alert alert-info"><?php echo JText::_('COM_MEDIA_NO_IMAGES_FOUND'); ?></div>
	    </div>
    <?php endif; ?>
<?php endif; ?>
