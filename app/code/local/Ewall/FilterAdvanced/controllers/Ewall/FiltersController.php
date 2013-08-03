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
class Ewall_FilterAdvanced_Ewall_FiltersController extends Ewall_Admin_Controller_Crud {
    protected function _getEntityName() {
        return 'ewall_filters/filter2';
    }
    public function tabAdvancedAction() {
        $model = $this->_registerModel();

        // layout
        $this->addActionLayoutHandles();
        $this->loadLayoutUpdates();
        $this->generateLayoutXml()->generateLayoutBlocks();
        $this->_isLayoutLoaded = true;

        // render AJAX result
        $this->renderLayout();
    }
}