<?php

abstract class Aajit_Dataman_Model_Api2_Contract_Rest extends Aajit_Dataman_Model_Api2_Contract
{
    protected $_supplier;

    protected function _retrieve() {
        $supplier = $this->_getSupplier();
        $this->_prepareSupplierForResponse($supplier);
        return $supplier->getData();
    }

    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('contractpricing/contract_collection');
        $entityOnlyAttributes = $this->getEntityOnlyAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ
        );
        $availableAttributes = array_keys($this->getAvailableAttributes(
            $this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ)
        );
        $collection->addFieldToFilter('status', array('eq' => 1));
        $store = $this->_getStore();
        $collection->addStoreFilter($store->getId());
        $this->_applyCollectionModifiers($collection);
        $suppliers = $collection->load();
        $suppliers->walk('afterLoad');
        foreach ($suppliers as $supplier) {
            $this->_setSupplier($supplier);
            $this->_prepareSupplierForResponse($supplier);
        }
        $suppliersArray = $suppliers->toArray();
        $suppliersArray = $suppliersArray['items'];

        return $suppliersArray;
    }

    protected function _prepareSupplierForResponse(Levementum_ContractPricing_Model_Contract $supplier) {
        $supplierData = $supplier->getData();
    }

    protected function _create(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    protected function _update(array $data) {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }

    protected function _delete() {
        $this->_critical(self::RESOURCE_METHOD_NOT_ALLOWED);
    }


    protected function _setSupplier(Bitgun_Phonebook_Model_Supplier $supplier) {
        $this->_supplier = $supplier;
    }

    protected function _getSupplier() {
        if (is_null($this->_supplier)) {
            $supplierId = $this->getRequest()->getParam('id');
            $supplier = Mage::getModel('contractpricing/contract');
            $supplier->load($supplierId);
            if (!($supplier->getId())) {
                $this->_critical(self::RESOURCE_NOT_FOUND);
            }
            if ($this->_getStore()->getId()) {
                $isValidStore = count(array_intersect(array(0, $this->_getStore()->getId()), $supplier->getStoreId()));
                if (!$isValidStore) {
                    $this->_critical(self::RESOURCE_NOT_FOUND);
                }
            }
            $this->_supplier = $supplier;
        }
        return $this->_supplier;
    }
}
