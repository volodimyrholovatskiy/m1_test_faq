<?php

class Plumrocket_Faq_Adminhtml_FaqbackendController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
	  {
		    //return Mage::getSingleton('admin/session')->isAllowed('faq/faqbackend');
		    return true;
	  }

	  public function indexAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('plumrocket')
             ->_title($this->__("Manage FAQ / FAQ / Plumrocket"))
						 ->_addContent($this->getLayout()->createBlock("faq/adminhtml_faqbackend"));

	      $this->renderLayout();
    }
}
