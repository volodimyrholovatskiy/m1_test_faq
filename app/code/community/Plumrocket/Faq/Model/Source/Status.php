<?php

class Plumrocket_Faq_Model_Source_Status
{
    const ENABLED = '1';
    const DISABLED = '0';

    public function toOptionArray()
    {
        return array(
            array('value' => self::ENABLED, 'label'=>Mage::helper('faq')->__('Enabled')),
            array('value' => self::DISABLED, 'label'=>Mage::helper('faq')->__('Disabled')),
        );
    }

    public function toArray()
    {
        return array(
            self::DISABLED => Mage::helper('faq')->__('Disabled'),
            self::ENABLED => Mage::helper('faq')->__('Enabled'),
        );
    }
}
