<?php
/**
* @package   ZOO Component
* @file      requirements.php
* @version   2.3.0 December 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class YRequirements {
	
	var $_results = array();
	
	var $_required_extensions = array(
			array('name' => 'JSON', 'extension' => 'json', 'info' => 'Check http://de.php.net/manual/en/book.json.php'),
			array('name' => 'Multibyte String', 'extension' => 'mbstring', 'info' => 'http://www.php.net/manual/en/book.mbstring.php')
	);

	var $_recommended_extensions = array(
		array('name' => 'cURL', 'extension' => 'curl', 'info' => 'cURL is required for Facebook Connect and Twitter Authenticate to work.'),
        array('name' => 'Multibyte String', 'extension' => 'mbstring', 'info' => 'mbstring is designed to handle Unicode-based encodings such as UTF-8. Check http://www.php.net/manual/en/book.mbstring.php')
	);
	
	var $_required_functions = array(
		array('function' => 'imagegd', 'info' => 'Check http://www.php.net/manual/en/image.installation.php'),
		array('function' => 'simplexml_load_string', 'info' => 'Check http://de.php.net/manual/en/function.simplexml-load-file.php'),
		array('function' => 'simplexml_load_file', 'info' => 'Check http://de.php.net/manual/en/function.simplexml-load-string.php'),
		array('function' => 'dom_import_simplexml', 'info' => 'Check http://de.php.net/manual/en/function.dom-import-simplexml.php')
	);
	
	var $_recommended_functions = array(

    );
	
	var $_required_classes = array(
		array('class' => 'SimpleXMLElement', 'info' => 'Check http://de.php.net/manual/en/book.simplexml.php'),
		array('class' => 'DOMNode', 'info' => 'http://de.php.net/manual/en/book.dom.php'),		
		array('class' => 'ArrayObject', 'info' => 'Check http://de.php.net/manual/en/class.arrayobject.php')
	);
	
	var $_recommended_classes = array(
        
    );
	
	function checkPHP() {
		return !version_compare(PHP_VERSION, '5.2.4', '<');
	}
	
	function checkSafeMode() {
		return !ini_get('safe_mode');
	}
	
	function checkMemoryLimit() {
		$memory_limit = ini_get('memory_limit');

		return $memory_limit == '-1' ? true : $this->_return_bytes($memory_limit) >= 33554432;
	}
	
	function _return_bytes ($size_str) {
	    switch (substr ($size_str, -1)) {
	        case 'M': case 'm': return (int)$size_str * 1048576;
	        case 'K': case 'k': return (int)$size_str * 1024;
	        case 'G': case 'g': return (int)$size_str * 1073741824;
	        default: return $size_str;
	    }
	}
	
	function checkRequirements() {
		$this->_results = array();
		
		$result = $this->_checkRequired();
		$this->_checkRecommended();
		
		return $result;
	}
	
	function _checkRequired() {

		// check php
		$status = $this->checkPHP();
		$info 	= 'Zoo requires PHP 5.2.4+. Please upgrade your PHP version (http://www.php.net).';
		$this->_addResult('PHP 5.2.4+', $status, $info);

		foreach ($this->_required_extensions as $extension) {
			$status = extension_loaded($extension['extension']);
			$this->_addResult('Extension: ' . $extension['name'], $status, $extension['info']);
		}		
		
		foreach ($this->_required_functions as $function) {
			$status = function_exists($function['function']);
			$this->_addResult('Function: ' . $function['function'], $status, $function['info']);
		}
		
		foreach ($this->_required_classes as $class) {
			$status = class_exists($class['class']);
			$this->_addResult('Class: ' . $class['class'], $status, $class['info']);
		}
		
		foreach ($this->_results as $return) {
			if (!$return['status']) {
				return false;
			}
		}
		
		return true;
	}
	
	function _checkRecommended() {

		foreach ($this->_recommended_extensions as $extension) {
			$status = extension_loaded($extension['extension']);
			$this->_addResult('Extension: ' . $extension['name'], $status, $extension['info']);
		}		
		
		foreach ($this->_recommended_functions as $function) {
			$status = function_exists($function['function']);
			$this->_addResult('Function: ' . $function['function'], $status, $function['info']);
		}
		
		foreach ($this->_recommended_classes as $class) {
			$status = class_exists($class['class']);
			$this->_addResult('Class: ' . $class['class'], $status, $class['info']);
		}
		
		// check safe mode
		$status = $this->checkSafeMode();
		$info 	= 'It is recommended to turn off PHP safe mode.';
		$this->_addResult('PHP Safe Mode', $status, $info);
		
		$status = $this->checkMemoryLimit();
		$info 	= 'It is recommended to set the php setting memory_limit to 32M or higher.';
		$this->_addResult('PHP Memory Limit', $status, $info);
		
		foreach ($this->_results as $return) {
			if (!$return['status']) {
				return false;
			}
		}
		
		return true;
	}
	
	function _addResult($name, $status, $info = '') {
		$this->_results[] = compact('name', 'status', 'info');
	}
	
	function displayResults() {
		?>
		
		<h3><?php echo JText::_('Zoo Requirements'); ?></h3>
		<div><?php echo JText::_('If any of the items below are highlighted in red, you should try to correct them. Failure to do so could lead to your ZOO installation not functioning correctly.'); ?></div>
		<table class="adminlist">
			<thead>
				<tr>
					<th class="title"><?php echo JText::_('Requirement'); ?></th>
					<th width="20%"><?php echo JText::_('Status'); ?></th>
					<th width="60%"><?php echo JText::_('Info'); ?></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="3">&nbsp;</td>
				</tr>
			</tfoot>
			<tbody>
				<?php 
					foreach ($this->_results as $i => $req) : ?>
					<tr class="row<?php echo $i++ % 2; ?>">
						<td class="key"><?php echo $req['name']; ?></td>
						<td>
							<?php $style = $req['status'] ? 'font-weight: bold; color: green;' : 'font-weight: bold; color: red;'; ?>
							<span style="<?php echo $style; ?>"><?php echo $req['status'] ? JText::_('OK') : JText::_('Not OK'); ?></span>
						</td>
						<td>
							<span><?php echo $req['status'] ? '' : JText::_($req['info']); ?></span>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<?php
	}
	
}