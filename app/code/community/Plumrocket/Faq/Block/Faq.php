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

    public function getSingleFaq()
    {
        $id = $this->getRequest()->getParam('faq_id');
        $collection = Mage::getModel('faq/block')->getCollection()
                                          ->addFieldToFilter('faq_id', $id)
                                          ->addFieldToFilter('faq_status', '1');

        $faq = $collection->getFirstItem();

        return $faq->getId() ? $faq : false;

    }
}
