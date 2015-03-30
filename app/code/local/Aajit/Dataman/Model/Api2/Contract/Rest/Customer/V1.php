<?php

class Bitgun_Phonebook_Model_Api2_Supplier_Rest_Customer_V1 extends Bitgun_Phonebook_Model_Api2_Supplier_Rest
{

    protected $_customer;


    protected function _getCustomer() {
        if (is_null($this->_customer)) {
            $customer = Mage::getModel('customer/customer')->load($this->getApiUser()->getUserId());
            if (!$customer->getId()) {
                $this->_critical('Customer not found.', Mage_Api2_Model_Server::HTTP_INTERNAL_ERROR);
            }
            $this->_customer = $customer;
        }
        return $this->_customer;
    }
}
