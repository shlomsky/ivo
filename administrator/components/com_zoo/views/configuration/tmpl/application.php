<?php
/**
* @package   ZOO Component
* @file      application.php
* @version   2.3.0 December 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

defined('_JEXEC') or die('Restricted access');

// add js
JHTML::script('configuration.js', 'administrator/components/com_zoo/assets/js/');
JHTML::script('alias.js', 'administrator/components/com_zoo/assets/js/');

JHTML::_('behavior.tooltip');

// filter output
JFilterOutput::objectHTMLSafe($this->application, ENT_QUOTES, array('params')); 

?>

<form id="configuration-application" class="menu-has-level3" action="index.php" method="post" name="adminForm" accept-charset="utf-8">

<?php echo $this->partial('menu'); ?>

<div class="box-bottom">
	<div class="col col-left width-60">
	
		<fieldset class="creation-form">
		<legend><?php echo JText::_('Details'); ?></legend>
		<div class="element element-name">
			<strong><?php echo JText::_('Name'); ?></strong>
			<div id="name-edit">
				<div class="row">
					<input class="inputbox" type="text" name="name" id="name" size="60" value="<?php echo $this->application->name; ?>"/>
					<span class="message-name"><?php echo JText::_('Please enter valid name.'); ?></span>
				</div>
				<div class="slug">
					<span><?php echo JText::_('Slug'); ?>:</span>
					<a class="trigger" href="#" title="<?php echo JText::_('Edit Application Slug');?>"><?php echo (empty($this->application->alias) ? 42 : $this->application->alias); ?></a>
					<div class="panel">
						<input type="text" name="alias" value="<?php echo $this->application->alias; ?>"/>
						<input type="button" class="accept" value="<?php echo JText::_('Accept'); ?>"/>
						<a href="#" class="cancel"><?php echo JText::_('Cancel'); ?></a>
					</div>
				</div>
			</div>
		</div>
		<div class="element element-template">
			<strong><?php echo JText::_('Template'); ?></strong>
			<?php echo $this->lists['select_template']; ?>
		</div>
		</fieldset>

	</div>

	<div class="col col-right width-40">

		<div id="parameter-accordion">
			<?php echo $this->partial('applicationparams')?>	
		</div>

	</div>
</div>

<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
<input type="hidden" name="controller" value="<?php echo $this->controller; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="format" value="" />
<?php echo JHTML::_('form.token'); ?>

</form>

<script type="text/javascript">
	jQuery(function($){
		$('#configuration-application').ApplicationEdit({ application_id: '<?php echo $this->application->id;?>', application_group: '<?php echo $this->application->getGroup();?>' });
		$('#name-edit').AliasEdit({ edit: <?php echo (int) $this->application->id; ?> });
		$('#name-edit').find('input[name="name"]').focus();
	});
</script>

<?php echo ZOO_COPYRIGHT; ?>