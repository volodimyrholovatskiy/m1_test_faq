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

    public function editAction()
    {
        $id = $this->getRequest()->getParam('faq_id');
        Mage::register('faq_block',Mage::getModel('faq/block')->load($id));
        
        $this->loadLayout()
             ->_setActiveMenu('plumrocket')
             ->_addContent($this->getLayout()->createBlock("faq/adminhtml_faq_edit"));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }
}
