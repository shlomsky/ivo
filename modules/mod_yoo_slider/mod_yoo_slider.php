<?php
/**
* YOOslider Joomla! Module
*
* @author    yootheme.com
* @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
* @license	 GNU/GPL
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

global $mainframe;

// count instances
if (!isset($GLOBALS['yoo_sliders'])) {
	$GLOBALS['yoo_sliders'] = 1;
} else {
	$GLOBALS['yoo_sliders']++;
}

// include the syndicate functions only once
require_once (dirname(__FILE__).DS.'helper.php');

// disable edit ability icon
$access = new stdClass();
$access->canEdit	= 0;
$access->canEditOwn = 0;
$access->canPublish = 0;

$list = modYOOsliderHelper::getList($params, $access);

// check if any results returned
$items = count($list);
if (!$items) {
	return;
}

// init vars
$style              = $params->get('style', 'default-h');
$module_height      = $params->get('module_height', 150);
$item_size          = $params->get('item_size', 170);
$item_expanded      = $params->get('item_expanded', 310);
$module_base        = JURI::base() . 'modules/mod_yoo_slider/';

// css parameters
$slider_id          = 'yoo-slider-' . $GLOBALS['yoo_sliders'];

switch ($style) {
	// vertical
	case "default-v":
	case "photo-v":
		$layout                   = 'vertical';
		$item_height              = $item_size;
		$item_height_expanded     = $item_expanded;
		$module_height		      = ($style ==  "photo-v") ? ($item_height * $items) - 3 : ($item_height * $items) + 5;
		$module_height		      = ($style ==  "photo-v") ? $module_height + (10 * ($items - 1)) : $module_height; /* only for photo-v styling */
		$css_item_height          = 'height: ' . $item_height . 'px;';
		$css_item_height_expanded = 'height: ' . $item_height_expanded . 'px;';
		$css_module_height        = 'height: ' . $module_height . 'px;';
		break;

	// horizontal
	case "default-h":
	case "photo-h":
	default:
		$layout                   = 'horizontal';
		$item_width               = $item_size;
		$item_height              = $module_height;
		$slide_height             = $item_height - 5;
		$module_width		      = ($style ==  "photo-h") ? ($item_width * $items) + (10 * ($items - 1)) - 3 : 0; /* only for photo-h styling */
		$all_items_width	      = $module_width + 10; /* only for photo-h styling */
		$css_item_width           = 'width: ' . $item_width . 'px;';
		$css_item_height          = 'height: ' . $item_height . 'px;';
		$css_slide_height         = 'height: ' . $slide_height . 'px;';
		$css_module_height        = 'height: ' . $module_height . 'px;';
		$css_module_width         = 'width: ' . $module_width . 'px;'; /* only for photo-h styling */
		$css_all_items_width      = 'width: ' . $all_items_width . 'px;'; /* only for photo-h styling */
}

// js parameters
$javascript = "new YOOslider('" . $slider_id . "', '#" . $slider_id . " .slide', { layout: '" . $layout . "', sizeNormal: " . $item_size . ", sizeFull: " . $item_expanded . " });";

switch ($style) {
	case "photo-h":
   		require(JModuleHelper::getLayoutPath('mod_yoo_slider', 'photo-h'));
   		break;
	case "photo-v":
   		require(JModuleHelper::getLayoutPath('mod_yoo_slider', 'photo-v'));
   		break;
	case "default-v":
		require(JModuleHelper::getLayoutPath('mod_yoo_slider', 'default-v'));
		break;
	default:
    	require(JModuleHelper::getLayoutPath('mod_yoo_slider', 'default-h'));
}

$document =& JFactory::getDocument();
$document->addStyleSheet($module_base . 'mod_yoo_slider.css.php');
$document->addScript($module_base . 'mod_yoo_slider.js');
echo "<script type=\"text/javascript\">\n// <!--\nwindow.addEvent('domready', function(){ $javascript });\n// -->\n</script>\n";