<?php

class Plumrocket_Faq_Model_Block extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('faq/block');
    }
}
