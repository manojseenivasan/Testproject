<?php
/**
 * @category    Ewall
 * @package     Ewall_Ajax
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

class Ewall_Ajax_Block_Update extends Mage_Core_Block_Abstract {
	public function getSelectors() {
		$result = array();
		foreach ($this->_blockNames as $action => $actionBlockNames) {
		    $selectors = array();
		    foreach ($actionBlockNames as $blockName) {
                $selectors[] = '.mb-' . str_replace('.', '-', $blockName);
		    }
            $result[$action] = $selectors;
		}
		return $result;
	}
	public function getProgress() {
        $result = array();
        foreach (array_keys($this->_blockNames) as $action) {
            $result[$action] = Mage::getStoreConfigFlag('ewall/ajax/progress_'.$action);
        }
        return $result;
    }
    public function getOverlay() {
        $result = array();
        foreach (array_keys($this->_blockNames) as $action) {
            $result[$action] = Mage::getStoreConfigFlag('ewall/ajax/overlay_' . $action);
        }
        return $result;
    }
    protected function _toHtml()
    {
		Mage::helper('ewall_core/js')->options('#m-ajax', array(
		    'enabled' => Mage::helper('ewall_ajax')->isEnabled(),
			'selectors' => $this->getSelectors(),
			'debug' => Mage::getStoreConfigFlag('ewall/ajax/debug'),
            'method' => $this->getMethod(),
            'progress' => $this->getProgress(),
            'overlay' => $this->getOverlay(),
		));
		Mage::dispatchEvent('m_ajax_options');
        return '';
    }
    protected $_method;
    public function getMethod() {
        if (!$this->_method) {
            $this->_method = Mage::getStoreConfig('ewall/ajax/method');
        }
        return $this->_method;
    }
    public function markUpdatable($blockName, $html) {
        $mark = false;
        foreach ($this->_blockNames as $actionBlockNames) {
            if (isset($actionBlockNames[$blockName])) {
                $mark = true;
                break;
            }
        }
    	if ($mark) {
    	    switch ($this->getMethod()) {
                case Ewall_Ajax_Model_Method::MARK_WITH_CSS_CLASS:
                    try {
                        /* @var $reader Ewall_Core_Model_Html_Reader */
                        $reader = Mage::getModel('ewall_core/html_reader')->setSource($html);
                        /* @var $parser Ewall_Ajax_Model_Marker */
                        $parser = Mage::getModel('ewall_ajax/marker', array(
                            'reader' => $reader,
                            'block_name' => str_replace('.', '-', $blockName),
                        ));
                        $parser->parseContent();
                        return $parser->getFilteredOutput();
                    }
                    catch (Exception $e) {
                        Mage::log($e->getMessage() . "\n\n", Zend_Log::WARN, 'content-parser.log');
                        return $html;
                    }
                case Ewall_Ajax_Model_Method::WRAP_INTO_CONTAINER:
                    return '<div class="m-block mb-'. str_replace('.', '-', $blockName).'">'.$html.'</div>';
                default:
                    throw new Exception('Not implemented');
            }
    	}
    	else {
    		return $html;
    	}
    }
    public function toAjaxHtml($action) {
    	$result = array();
    	$updates = array();
    	$script = '';
    	foreach ($this->_blockNames[$action] as $blockName) {
    		if ($block = $this->getLayout()->getBlock($blockName)) {
	    		$html = Mage::getSingleton('core/url')->sessionUrlVar($block->toHtml());
                $updates['.mb-' . str_replace('.', '-', $blockName)] = utf8_encode($html);
    		}
    	}
    	
    	$result['update'] = $updates;
    	$result['script'] = $script;
    	$result['options'] = $this->getLayout()->getBlock('m_js')->getOptions(); // left for future - now all options are static
    	if ($this->getLayout()->getBlock('head')) {
    	    $headBlock = $this->getLayout()->getBlock('head');
    	    $headBlock->getTitle();
    	    $result['title'] = $headBlock->getData('title');
        }
    	if (Mage::getStoreConfigFlag('ewall/ajax/debug')) {
    		Mage::log("\n".$script."\n\n", Zend_Log::DEBUG, 'content-script.log');
    	}
    	return $result;
    }
    protected $_blockNames = array();
    public function addBlock($blockName, $action) {
        if (!isset($this->_blockNames[$action])) {
            $this->_blockNames[$action] = array();
        }
    	$this->_blockNames[$action][$blockName] = $blockName;
		return $this;
    }
}