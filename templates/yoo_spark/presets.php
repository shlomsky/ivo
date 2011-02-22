<?php
/**
* @package   yoo_spark Template
* @file      presets.php
* @version   5.5.0 January 2011
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
 * Presets
 */

$default_preset = array();

$warp->config->addPreset('preset01', 'Plain Blue', array_merge($default_preset,array(
	'style' => 'default',
	'background' => 'default',
	'bganimation' => false,
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset02', 'Wings Pink', array_merge($default_preset,array(
	'style' => 'pink',
	'background' => 'wings',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset03', 'Wings Turquoise', array_merge($default_preset,array(
	'style' => 'turquoise',
	'background' => 'wings',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset04', 'Disco Red', array_merge($default_preset,array(
	'style' => 'red',
	'background' => 'disco',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset05', 'Disco Brown', array_merge($default_preset,array(
	'style' => 'brown',
	'background' => 'disco',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset06', 'Jellyfish Blue', array_merge($default_preset,array(
	'style' => 'default',
	'background' => 'jellyfish',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset07', 'Jellyfish Red', array_merge($default_preset,array(
	'style' => 'red',
	'background' => 'jellyfish',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset08', 'Nebula Green', array_merge($default_preset,array(
	'style' => 'green',
	'background' => 'nebula',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset09', 'Nebula Blue', array_merge($default_preset,array(
	'style' => 'default',
	'background' => 'nebula',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->addPreset('preset10', 'Spotlights Lilac', array_merge($default_preset,array(
	'style' => 'lilac',
	'background' => 'spotlights',
	'font' => 'default',
	'load_googlefonts' => true
)));

$warp->config->applyPreset();