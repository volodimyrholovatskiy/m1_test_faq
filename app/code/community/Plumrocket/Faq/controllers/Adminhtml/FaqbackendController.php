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

        $model = Mage::getModel('faq/block')->load($id);

        if ($id) {
            if (! $model->getId() ) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('faq')->__('This faq no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

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

    public function saveAction()
    {

        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $model = Mage::getModel('faq/block');
                $model->setId($this->getRequest()->getParam('faq_id'))
                      ->setTitle($postData['title'])
                      ->setFaq_status($postData['faq_status'])
                      ->setContent($postData['content'])
                      ->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('faq')->__('FAQ was successfully saved'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('faq_id' => $this->getRequest()->getParam('faq_id')));
                return;
            }

        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('faq_id')) {
            try {
                $model = Mage::getModel('faq/block');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess('Faq was deleted successfully!');

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());

                $this->_redirect('*/*/edit', array('faq_id' => $id));
                return;
            }

        }

        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('faq')->__('Unable to find a faq to delete.'));

        $this->_redirect('*/*/');
    }
}
