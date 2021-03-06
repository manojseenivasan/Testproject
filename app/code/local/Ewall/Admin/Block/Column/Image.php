<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Enter description here ...
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Column_Image extends Ewall_Admin_Block_Column {
    /**
     * Renders grid column
     *
     * @param   Varien_Object $row
     * @return  string
     */
    public function render(Varien_Object $row) {
    	ob_start();
    	$cellId = $this->generateId();
    	?>
<div style="<?php echo $this->_getStyle($row)?>"
    class="ct-container input-image <?php echo $this->getColumn()->getInlineCss() ?>"
    id="<?php echo $cellId ?>">&nbsp;
</div>
    	<?php 
    	$html = ob_get_clean();//.$this->renderCellOptions($cellId, $row);
        return $html;
    }
    public function renderCss() {
    	return parent::renderCss()
    		.' ct-image'
    		.' c-'.$this->getColumn()->getId();
    }
    protected function _getStyle($row) {
        /* @var $files Ewall_Core_Helper_Files */ $files = Mage::helper(strtolower('Ewall_Core/Files'));
        if ($image = $row->getData($this->getColumn()->getIndex())) {
            $noRepeat = $this->getColumn()->getNoRepeat() ? ' no-repeat' : '';
            $image = 'background: url('.$files->getUrl($image, array('temp/image', 'image')).')'. $noRepeat.'; ';
        }
        $width = $height = $this->getColumn()->getWidth();

        return "{$image}width: {$width}; height: {$height}; ";
    }
    protected function _renderColumnOptions($options) {
        parent::_renderColumnOptions($options);
        $options
            ->setShowUseDefault($options->getShowHelper())
            ->setShowHelper(true);
    }
}