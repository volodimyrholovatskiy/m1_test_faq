<?php

class Plumrocket_Faq_IndexController extends Mage_Core_Controller_Front_Action
{

    public function preDispatch()
    {
        parent::preDispatch();

        if( !Mage::getStoreConfigFlag('faq/general/enabled') ) {
            $this->norouteAction();
        }
    }
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock("head")->setTitle($this->__("FAQ"));
        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
        ));

        $breadcrumbs->addCrumb("faq", array(
                "label" => $this->__("Faq"),
                "title" => $this->__("Faq")
		    ));
        $this->renderLayout();
    }

    public function viewAction()
    {
        $id = $this->getRequest()->getParam('faq_id');

        $model = Mage::getModel('faq/block')->load($id);

        $this->loadLayout();

        $this->getLayout()->getBlock("head")->setTitle($model->getId() ? $model->getTitle() : $this->__('Question not found'));

        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
        $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
        ));

        $breadcrumbs->addCrumb("faq", array(
                "label" => $this->__("Faq"),
                "title" => $this->__("Faq"),
                "link"  => Mage::getUrl('faq')
		    ));
        $breadcrumbs->addCrumb($model->getTitle(), array(
                "label" => $model->getTitle(),
                "title" => $model->getTitle()
		    ));
        $this->renderLayout();
    }
}
