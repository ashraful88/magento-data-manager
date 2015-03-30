<?php

class Levementum_ContractPricing_Model_Contract extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('contractpricing/contract', 'entity_id');
    }


    public function getAvailableStatuses()
    {
        $statuses = new Varien_Object(array(
            self::STATUS_ENABLED => Mage::helper('contractpricing')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('contractpricing')->__('Disabled'),
        ));

        Mage::dispatchEvent('contractpricing_contract_get_available_statuses', array('statuses' => $statuses));

        return $statuses->getData();
    }
}
