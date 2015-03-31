<?php

class Aajit_Dataman_Model_Dataman extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('dataman/dataman', 'entity_id');
    }


    public function getAvailableStatuses()
    {
        $statuses = new Varien_Object(array(
            self::STATUS_ENABLED => Mage::helper('dataman')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('dataman')->__('Disabled'),
        ));

        Mage::dispatchEvent('aajit_dataman_get_available_statuses', array('statuses' => $statuses));

        return $statuses->getData();
    }
}
