<?php

$installer = $this;

$installer->startSetup();

/**
 * Create table 'contractpricing/contract'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('contractpricing/contract'))
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Entity ID')
    ->addColumn('contract_number', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Contract Number')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Customer ID')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Product ID')
    ->addColumn('contract_price', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        ), 'Contract Price')
    ->addColumn('tier_qty', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        ), 'Tire Qty')
    ->addColumn('tier_price', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(
        ), 'Tier Price')
    ->addColumn('expiration', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'expiration')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'nullable'  => false,
        'default'   => '1',
        ), 'Is Active')
    ->addIndex($installer->getIdxName('contractpricing/contract', array('contract_number')),
        array('contract_number'))
    ->addIndex($installer->getIdxName('contractpricing/contract', array('product_id')),
        array('product_id'))
    ->addIndex($installer->getIdxName('contractpricing/contract', array('customer_id')),
        array('customer_id'))
    ->setComment('Contract Pricing Table');
$installer->getConnection()->createTable($table);

$installer->endSetup();
