<?php

class Aajit_Dataman_Model_Resource_Contract extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('contractpricing/contract', 'entity_id');
    }

}
