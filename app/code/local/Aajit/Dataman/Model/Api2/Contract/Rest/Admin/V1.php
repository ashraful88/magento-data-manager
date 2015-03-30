<?php
class Levementum_ContractPricing_Model_Api2_Contract_Rest_Admin_V1 extends Levementum_ContractPricing_Model_Api2_Contract_Rest
{


    protected function _filterOutArrayKeys(array $array, array $keys, $dropOrigKeys = false) {
        $isIndexedArray = is_array(reset($array));
        if ($isIndexedArray) {
            foreach ($array as &$value) {
                if (is_array($value)) {
                    $value = array_diff_key($value, array_flip($keys));
                }
            }
            if ($dropOrigKeys) {
                $array = array_values($array);
            }
            unset($value);
        } else {
            $array = array_diff_key($array, array_flip($keys));
        }
        return $array;
    }


    protected function _retrieveCollection() {
        $collection = Mage::getResourceModel('contractpricing/contract_collection');
        $entityOnlyAttributes = $this->getEntityOnlyAttributes($this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ);
        $availableAttributes = array_keys($this->getAvailableAttributes($this->getUserType(),
            Mage_Api2_Model_Resource::OPERATION_ATTRIBUTE_READ));
        $this->_applyCollectionModifiers($collection);
        $suppliers = $collection->load();

        foreach ($suppliers as $supplier) {
            $this->_setSupplier($supplier);
            $this->_prepareSupplierForResponse($supplier);
        }
        $suppliersArray = $suppliers->toArray();
        $suppliersArray = $suppliersArray['items'];

        return $suppliersArray;
    }


    protected function _delete() {
        $supplier = $this->_getSupplier();
        try {
            $supplier->delete();
        } catch (Mage_Core_Exception $e) {
            $this->_critical($e->getMessage(), Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        } catch (Exception $e) {
            $this->_critical(self::RESOURCE_INTERNAL_ERROR);
        }
    }


    protected function _create(array $data) {
        $supplier = Mage::getModel('contractpricing/contract')->setData($data);
        try {
            $supplier->save();
        }
        catch (Mage_Core_Exception $e) {
            $this->_critical($e->getMessage(), Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        } catch (Exception $e) {
            $this->_critical(self::RESOURCE_UNKNOWN_ERROR);
        }
        return $this->_getLocation($supplier->getId());
    }


    protected function _update(array $data) {
        $supplier = $this->_getSupplier();
        $supplier->addData($data);
        try {
            $supplier->save();
        } catch (Mage_Core_Exception $e) {
            $this->_critical($e->getMessage(), Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
        } catch (Exception $e) {
            $this->_critical(self::RESOURCE_UNKNOWN_ERROR);
        }
    }


    protected function _prepareDataForSave($product, $productData) {
        //add your data processing algorithm here if needed
    }
}