<?php
/**
 * @category    Ewall
 * @package     Ewall_Core
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_Core_Profiler {
	public static function start() {
		$args = func_get_args();
		$name = '';
		foreach ($args as $arg) {
			if ($name) $name .= '::';
			$name .= $arg;
			Varien_Profiler::start($name);
		}
	}
	public static function stop() {
		$args = func_get_args();
		$name = '';
		foreach ($args as $arg) {
			if ($name) $name .= '::';
			$name .= $arg;
			Varien_Profiler::stop($name);
		}
	}
}