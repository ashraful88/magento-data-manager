<?php

/**
 * Class Aajit_Dataman_Block_Admin
 * This block shows the Grid page in magento backend
 */
class Aajit_Dataman_Block_Admin extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'admin';
        $this->_headerText = Mage::helper('dataman')->__('View Data');
        $this->_blockGroup = 'dataman';

        parent::__construct();

        $this->_removeButton('add');


    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/' . $action);
    }

}
