<?php

class Plumrocket_Faq_Model_Resource_Block extends  Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('faq/block', 'faq_id');
    }
}
