<?php

class Plumrocket_Faq_Block_Adminhtml_Faq_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('faq_form');
        $this->setTitle(Mage::helper('faq')->__('Faq Information'));
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('faq_block');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'method' => 'post', 'action' => $this->getUrl('*/*/save', array('faq_id' => $this->getRequest()->getParam('faq_id'))))
        );

        $form->setHtmlIdPrefix('faq_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('faq')->__('Faq Information'), 'class'=>'fieldset-wide'));

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('faq')->__('Faq Title'),
            'title' => Mage::helper('faq')->__('Faq Title'),
            'required' => true,
        ));

        $fieldset->addField('faq_status', 'select', array(
            'name' => 'faq_status',
            'label' => Mage::helper('faq')->__('Status'),
            'title' => Mage::helper('faq')->__('Status'),
            'options' => Mage::getModel('faq/source_status')->toArray(),
            'required' => true,
        ));

        $fieldset->addField('content', 'editor', array(
            'name' => 'content',
            'label' => Mage::helper('faq')->__('Content'),
            'title' => Mage::helper('faq')->__('Content'),
            'style'     => 'height:36em',
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
            'required' => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
