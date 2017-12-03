<?php

class Plumrocket_Faq_Block_Adminhtml_Faq_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'faq_id';
        $this->_controller = 'adminhtml_faq';
        $this->_blockGroup = 'faq';

        parent::__construct();
    }

    public function getHeaderText()
    {
        if (Mage::registry('faq_block')->getId()) {
            return Mage::helper('faq')->__("Edit Faq '%s'", $this->escapeHtml(Mage::registry('faq_block')->getTitle()));
        } else {
            return Mage::helper('faq')->__('New Faq');
        }
    }
}
