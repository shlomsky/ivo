<?php
/**
* @package   ZOO Component
* @file      xml.php
* @version   2.3.0 December 2010
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) 2007 - 2011 YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
*/

/*
	Class: YParameterFormXml
		Xml Parameter Form Class.
*/
abstract class YParameterFormXml extends YParameterForm {

	/*
		Variable: xml
			The xml params object array, with each group as array key.
    */
	protected $_xml;

	/*
		Function: __construct
			Constructor

		Parameters:
			xml - Path to parameter xml file or string
	*/	
	public function __construct($xml = null) {
		parent::__construct();

		// init vars
		$this->loadXML($xml);
	}

	/*
		Function: getParams
			Render all parameters of a group

		Parameters:
			name - The control name
			group - Parameter group

		Returns:
			Array - Array of all parameters
	*/		
	public function getParams($name = 'params', $group = '_default') {
		if (!isset($this->_xml[$group])) {
			return false;
		}
		
		$results = array();
		
		foreach ($this->_xml[$group]->children() as $param)  {
			$results[] = $this->getParam($param, $name);
		}
		
		return $results;
	}

	/*
		Function: getParam
			Render a parameter type

		Parameters:
			node - A param tag node
			control_name - The control name
			group - Parameter group

		Returns:
			Array - Any array of the label, the form element and the tooltip
	*/		
	public function getParam($node, $control_name = 'params', $group = '_default') {

		// get the type of the parameter
		$type = $node->attributes('type');

		// load element
		$element = $this->loadElement($type);

		// error happened
		if ($element === false) {
			$result = array();
			$result[0] = $node->attributes('name');
			$result[1] = JText::_('Element not defined for type').' = '.$type;
			$result[5] = $result[0];
			return $result;
		}

		// get value
		$value = (string) $this->getValue($node->attributes('name'), $node->attributes('default'));

		return $element->render($node, $value, $control_name);
	}

	/*
		Function: getParamsCount
			Return number of params to render

		Parameters:
			group - Parameter group 

		Returns:
			Int - Parameter count
	*/	
	public function getParamsCount($group = '_default') {
		if (!isset($this->_xml[$group]) || !count($this->_xml[$group]->children())) {
			return false;
		}
		
		return count($this->_xml[$group]->children());
	}

	/*
		Function: getGroups
			Get the number of params in each group

		Returns:
			Array - Array of all group names as key and parameter count as value
	*/	
	public function getGroups() {
		if (!is_array($this->_xml)) {
			return false;
		}
		
		$results = array();
		
		foreach ($this->_xml as $name => $group)  {
			$results[$name] = $this->getParamsCount($name);
		}
		
		return $results;
	}

	/*
		Function: setXML
			Sets the XML object from custom xml files

		Parameters:
			xmlpath - Path to xml file

		Returns:
			Boolean - True, on success
	*/	
	public function setXML($xml) {
		if (is_object($xml)) {
			
			if ($group = $xml->attributes('group')) {
				$this->_xml[$group] = $xml;
			} else {
				$this->_xml['_default'] = $xml;
			}
			
			if ($path = $xml->attributes('addpath')) {
				$this->addElementPath(JPATH_ROOT.$path);
			}
		}
	}

	/*
		Function: loadXML
			Loads an xml file or formatted string and parses it

		Parameters:
			data - xml file or string

		Returns:
			Boolean - True, on success
	*/	
	public function loadXML($data) {

		$xml = JFactory::getXMLParser('Simple');
				
		// load xml file or string ?
		if (@$xml->loadFile($data) || $xml->loadString($data)) {
			if (isset($xml->document->params)) {
				foreach ($xml->document->params as $param) {
					$this->setXML($param);
				}

				return true;
			}
		}

		return false;
	}

}