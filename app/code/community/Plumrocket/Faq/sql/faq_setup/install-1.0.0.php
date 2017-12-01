<?php

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()

    ->newTable($this->getTable('faq/block'))

    ->addColumn('faq_id',Varien_Db_Ddl_Table::TYPE_INTEGER,null,array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true))

    ->addColumn('title',Varien_Db_Ddl_Table::TYPE_VARCHAR,null,array(
        'nullable' => false))

    ->addColumn('content',Varien_Db_Ddl_Table::TYPE_TEXT,null,array(
        'nullable' => false))

    ->addColumn('faq_status',Varien_Db_Ddl_Table::TYPE_TINYINT,null,array(
        'nullable' => false));

$installer->getConnection()->createTable($table);

$installer->endSetup();
