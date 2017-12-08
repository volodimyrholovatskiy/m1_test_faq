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
        $id = intval($this->getRequest()->getParam('faq_id'));

        if ( $id == 0 ){
            return false;
        }

        $faq = Mage::getModel('faq/block')->load($id);

        return $faq->getId() && $faq->getFaq_status() != 0 ? $faq : false;
    }
}
