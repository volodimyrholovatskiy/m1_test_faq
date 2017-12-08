<?php

class Plumrocket_Faq_Adminhtml_FaqController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout()
             ->_setActiveMenu('plumrocket')
             ->_title($this->__('Plumrocket'))
             ->_title($this->__('FAQ'))
             ->_title($this->__('Manage FAQ'));
        return $this;
    }

	  public function indexAction()
    {
        $this->_initAction();
	      $this->renderLayout();
    }

    public function editAction()
    {
        $id = intval($this->getRequest()->getParam('faq_id'));

        $model = Mage::getModel('faq/block')->load($id);

        if ($id) {
            if (! $model->getId() ) {
                $this->_getSession()->addError($this->__('This faq no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        Mage::register('faq_block', Mage::getModel('faq/block')->load($id));

        $this->_initAction()
             ->_title($model->getId() ? $model->getTitle() : $this->__('New Faq'));
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
                $this->_getSession()->addSuccess($this->__('FAQ was successfully saved'));
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('faq_id' => $this->getRequest()->getParam('faq_id')));
                return;
            }

        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ( $id = intval($this->getRequest()->getParam('faq_id')) ) {
            try {
                $model = Mage::getModel('faq/block')->load($id);
                $title = $model->getTitle();
                $model->delete();

                $this->_getSession()->addSuccess($this->__('Faq was deleted successfully!'));

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());

                $this->_redirect('*/*/edit', array('faq_id' => $id));
                return;
            }

        }

        $this->_getSession()->addError($this->__('Unable to find a faq to delete.'));

        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $faqIds = $this->getRequest()->getParam('massaction');

        if ( !is_array($faqIds) ) {
            $this->_getSession()->addError($this->__('Please select faq(s).'));
        } else {
            try {
                foreach ($faqIds as $faqId) {
                    $faq = Mage::getModel('faq/block')->load($faqId);
                    $faq->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d record(s) have been deleted.', count($faqIds)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }

    public function massStatusAction()
    {
        $faqIds = $this->getRequest()->getParam('massaction');

        if ( !is_array($faqIds) ) {
            $this->_getSession()->addError($this->__('Please select faq(s).'));
        } else {
            try {
                foreach ($faqIds as $faqId) {
                    $faq = Mage::getModel('faq/block')->load($faqId);
                    $faq->setFaq_status($this->getRequest()->getParam('faq_status'));
                    $faq->save();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d record(s) have been updated.', count($faqIds)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/');
    }

    protected function _getSession()
    {
        return Mage::getSingleton('adminhtml/session');
    }
}
