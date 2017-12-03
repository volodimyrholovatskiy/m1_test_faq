<?php

class Plumrocket_Faq_Block_Adminhtml_Faq_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('faq_form');
        $this->setTitle(Mage::helper('faq')->__('Faq information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('faq_block');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'method' => 'post')
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

        $fieldset->addField('content', 'textarea', array(
            'name' => 'content',
            'label' => Mage::helper('faq')->__('Content'),
            'title' => Mage::helper('faq')->__('Content'),
            'required' => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
