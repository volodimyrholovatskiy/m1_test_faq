<?php

class Plumrocket_Faq_Block_Adminhtml_Faq_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('faqBlockGrid');
        $this->setDefaultSort('block_identifier');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('faq/block')->getCollection();

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('title', array(
            'header'    => Mage::helper('faq')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));

        $this->addColumn('faq_status', array(
            'header'    => Mage::helper('faq')->__('Status'),
            'align'     => 'left',
            'type'      => 'options',
            'options'   => Mage::getModel('faq/source_status')->toArray(),
            'index'     => 'faq_status'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('faq_id');
        $this->getMassactionBlock()->setIdFieldName('faq');

        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('faq')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('faq')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('faq')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus'),
            'additional' => array(
                  'faq_status'=> array(
                        'name' => 'faq_status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => Mage::helper('faq')->__('Status'),
                        'values' => Mage::getModel('faq/source_status')->toOptionArray()
                  )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('faq_id' => $row->getId()));
    }
}
