<?php
/**
 * @category    Ewall
 * @package     Ewall_Admin
 * @copyright   Copyright (c) http://www.ewalldev.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * @author Ewall Team
 *
 */
class Ewall_Admin_Block_Column_Checkbox extends Ewall_Admin_Block_Column {
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
    <input type="checkbox" name="<?php echo $this->getColumn()->getId() ?>"
           class="ct-container <?php echo $this->getColumn()->getInlineCss() ?>"
           id="<?php echo $cellId ?>"
        <?php if ($row->getData($this->getColumn()->getIndex())) : ?>checked="checked"<?php endif; ?>
        <?php if ($this->getIsDisabled()) : ?>disabled="disabled"<?php endif; ?> />
    <?php
        $html = ob_get_clean(); //.$this->renderCellOptions($cellId, $row);
        return $html;
    }
    public function renderCss() {
        return parent::renderCss()
                . ' ct-checkbox'
                . ' c-' . $this->getColumn()->getId();
    }
}