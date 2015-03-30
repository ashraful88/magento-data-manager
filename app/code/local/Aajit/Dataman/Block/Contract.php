<?php

class Levementum_ContractPricing_Block_Contract extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'contract';
        $this->_headerText = Mage::helper('contractpricing')->__('View Contract Pricing');
        $this->_blockGroup = 'contractpricing';

        parent::__construct();

        $this->_removeButton('add');


    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('contract/' . $action);
    }

}
