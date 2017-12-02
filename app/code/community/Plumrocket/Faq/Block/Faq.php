<?php
class Plumrocket_Faq_Block_Faq extends Mage_Core_Block_Template
{
    public function getFaqlist()
    {
        $collection = Mage::getModel('faq/block')->getCollection()
                                                 ->addFieldToFilter('faq_status', '1')
                                                 ->setOrder('title', 'asc');

        return $collection->getdata();
    }
}
