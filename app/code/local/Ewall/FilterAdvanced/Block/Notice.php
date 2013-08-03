<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterHelp
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterAdvanced_Block_Notice extends Mage_Core_Block_Messages {
    public function _prepareLayout() {
        /* @var $adminHelper Ewall_Admin_Helper_Data */
        $adminHelper = Mage::helper(strtolower('Ewall_Admin'));
        $store = $adminHelper->getStore();
        if (!Mage::getStoreConfigFlag('ewall_filters/advanced/enabled', $store)) {
            $this->addMessage(Mage::getSingleton('core/message')->notice($this->__(
                'Settings from this tab will not be applied until you set %s->%s->%s->%s->%s->%s to %s.',
                $this->__('System'),
                $this->__('Configuration'),
                $this->__('Ewall Team'),
                $this->__('Layered Navigation'),
                $this->__('Advanced Display Settings'),
                $this->__('Enable Advanced Display Features'),
                $this->__('Yes')
            )));
        }

        return $this;
    }
}