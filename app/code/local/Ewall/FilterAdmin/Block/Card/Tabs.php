<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdmin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_FilterAdmin_Block_Card_Tabs extends Ewall_Admin_Block_Crud_Card_Tabs {
	public function getActiveTabName() {
		if (($tabName = Mage::app()->getRequest()->getParam('tab')) 
			&& ($tabBlock = $this->getChild($tabName))
			&& !$tabBlock->isHidden()) 
		{
			return $tabName;
		}
		else {
			return 'general';
		}
	}
	public function getActiveTabBlock() {
		return $this->getChild($this->getActiveTabName());
	}
	protected function _beforeToHtml() {
		foreach ($this->getSortedChildren() as $tabName) {
			$tabBlock = $this->getChild($tabName);
			if ($tabName == $this->getActiveTabName()) {
				$this->addTab($tabName, $tabBlock);
			}
			else {
				$this->addTab($tabName, array(
					'id' => $tabBlock->getNameInLayout(),
					'label' => $tabBlock->getTabLabel(),
					'title' => $tabBlock->getTabTitle(),
					'class' => 'ajax',
					'url' => $tabBlock->getAjaxUrl(),
					'is_hidden' => $tabBlock->isHidden(),
				));
			}
		}
		$this->setActiveTab($this->getActiveTabName());
		return parent::_beforeToHtml();
	}
}