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
class Ewall_FilterSeoLinks_Model_Noindex_Filters {
    public function process(&$robots, $layerModel) {
        $filter = null;
        $noindex = false;
        foreach (Mage::getSingleton($layerModel)->getState()->getFilters() as $item) {
            if (!$filter) {
                $filter = $item->getFilter();
            }
            elseif ($item->getFilter() != $filter) {
                $noindex = true;
                break;
            }
        }
        if ($noindex) {
            $robots = 'NOINDEX, NOFOLLOW';
        }
    }
}