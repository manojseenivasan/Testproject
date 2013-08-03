<?php
/**
 * @category    Ewall
 * @package     Ewall_FilterSeoLinks
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://www.ewalldev.com/license  Proprietary License
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_FilterSeoLinks_Model_Noindex_Slider {
    public function process(&$robots, $layerModel) {
        $filter = null;
        $noindex = false;
        foreach (Mage::getSingleton($layerModel)->getState()->getFilters() as $item) {
            if ($item->getFilter()->getFilterOptions() && $item->getFilter()->getFilterOptions()->getDisplay() == 'slider') {
                $noindex = true;
                break;
            }
        }
        if ($noindex) {
            $robots = 'NOINDEX, NOFOLLOW';
        }
    }
}