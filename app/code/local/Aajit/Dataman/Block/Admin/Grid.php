<?php

/**
 * Class Aajit_Dataman_Block_Admin_Grid
 *
 */
class Aajit_Dataman_Block_Admin_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('admin_grid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
    }

    protected function _getStore()
    {
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('dataman/dataman')->getCollection();
        //$collection->setFirstStoreFlag(true);
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array(
            'header' => Mage::helper('dataman')->__('Entity ID'),
            'align' => 'left',
            'type' => 'number',
            'index' => 'entity_id',
        ));
        $this->addColumn('contract_number', array(
            'header' => Mage::helper('dataman')->__('Contract Number'),
            'index' => 'contract_number'
        ));
        $this->addColumn('customer_id', array(
            'header' => Mage::helper('dataman')->__('Customer ID'),
            'index' => 'customer_id',
        ));
        $this->addColumn('product_id', array(
            'header' => Mage::helper('dataman')->__('Product ID'),
            'index' => 'product_id',
        ));
        $store = $this->_getStore();
        $this->addColumn('contract_price', array(
            'header' => Mage::helper('dataman')->__('Contract Price'),
            'index' => 'contract_price',
            'type' => 'price',
            'currency_code' => $store->getBaseCurrency()->getCode(),
        ));
        $this->addColumn('tier_qty', array(
            'header' => Mage::helper('dataman')->__('Tier Qty'),
            'index' => 'tier_qty',
            'type' => 'number',
        ));
        $this->addColumn('tier_price', array(
            'header' => Mage::helper('dataman')->__('Tier Price'),
            'index' => 'tier_price',
        ));

        $this->addColumn('expiration', array(
            'header' => Mage::helper('dataman')->__('Expiration'),
            'index' => 'expiration',
            'type' => 'datetime',
        ));

        $this->addColumn('is_active', array(
            'header' => Mage::helper('dataman')->__('Status'),
            'index' => 'is_active',
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('dataman')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('dataman')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('dataman')->__('XML'));

        return parent::_prepareColumns();
    }

}
