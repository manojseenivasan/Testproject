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
class Ewall_FilterSeoLinks_Model_Noindex_Options {
    public function process(&$robots, $layerModel) {
        $filters = array();
        $noindex = false;
        foreach (Mage::getSingleton($layerModel)->getState()->getFilters() as $item) {
            $code = $item->getFilter()->getRequestVar();
            if (!isset($filters[$code])) {
                $filters[$code] = $code;
            }
            else {
                $noindex = true;
                break;
            }
        }
        if ($noindex) {
            $robots = 'NOINDEX, NOFOLLOW';
        }
    }
}