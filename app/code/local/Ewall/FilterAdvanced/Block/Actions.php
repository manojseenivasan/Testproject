<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterAdvanced
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterAdvanced_Block_Actions extends Mage_Core_Block_Template {
    public function sortActions($actions) {
        usort($actions, array($this, '_compareActions'));
        return $actions;
    }
    public function _compareActions($a, $b) {
        if ($a['position'] < $b['position']) return -1;
        if ($a['position'] > $b['position']) return 1;
        return 0;
    }
}