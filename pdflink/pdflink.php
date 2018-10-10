<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Editors-xtd.pdflink
 *
 * @author      krautgortna
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Editor PDFlink buton
 *
 */
class PlgButtonPdflink extends JPlugin
{
	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * Display the button.
	 *
	 * @param   string   $name    The name of the button to display.
	 * @param   string   $asset   The name of the asset being edited.
	 * @param   integer  $author  The id of the author owning the asset being edited.
	 *
	 * @return  JObject  The button options as JObject or false if not allowed
	 *
	 */
	public function onDisplay($name, $asset, $author)
	{
		$app       = JFactory::getApplication();
		$user      = JFactory::getUser();
		$extension = $app->input->get('option');

		// For categories we check the extension (ex: component.section)
		if ($extension === 'com_categories')
		{
			$parts     = explode('.', $app->input->get('extension', 'com_content'));
			$extension = $parts[0];
		}

		$asset = $asset !== '' ? $asset : $extension;

		if ($user->authorise('core.edit', $asset)
			|| $user->authorise('core.create', $asset)
			|| (count($user->getAuthorisedCategories($asset, 'core.create')) > 0)
			|| ($user->authorise('core.edit.own', $asset) && $author === $user->id)
			|| (count($user->getAuthorisedCategories($extension, 'core.edit')) > 0)
			|| (count($user->getAuthorisedCategories($extension, 'core.edit.own')) > 0 && $author === $user->id))
		{

      $link = 'index.php?option=com_media&amp;view=images&amp;tmpl=component&amp;e_name=' . $name . '&amp;asset=' . $asset . '&amp;author=' . $author . '&amp;override=pdflink';

			$button = new JObject;
			$button->modal   = true;
			$button->class   = 'btn';
			$button->link    = $link;
			$button->text    = JText::_('PLG_PDFLINK_BUTTON_PDFLINK');
			$button->name    = 'file-add';
			$button->options = "{handler: 'iframe', size: {x: 800, y: 600}}";

			return $button;
		}

		return false;
	}
}
