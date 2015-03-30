<?php

class Levementum_ContractPricing_Model_Resource_Contract_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected $_previewFlag;


    protected function _construct()
    {
        $this->_init('contractpricing/contract');
        //$this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }

    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();

        $countSelect->reset(Zend_Db_Select::GROUP);

        return $countSelect;
    }
}
