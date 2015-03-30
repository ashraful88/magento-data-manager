<?php

class Aajit_Dataman_AdminController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('dataman/admin')
            ->_addBreadcrumb(Mage::helper('dataman')->__('Aajit'), Mage::helper('dataman')->__('DataMan'))
            ->_addBreadcrumb(Mage::helper('dataman')->__('View dataman'), Mage::helper('dataman')->__('View Data List'));
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Aajit'))
            ->_title($this->__('DataMan'))
            ->_title($this->__('View Data Manager'));

        $this->_initAction();
        $this->_addContent($this->getLayout()->createBlock('dataman/admin'));
        $this->renderLayout();
    }

    public function exportCsvAction()
    {
        $fileName = 'dataman.csv';
        $content = $this->getLayout()->createBlock('dataman/admin_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction()
    {
        $fileName = 'dataman.xls';
        $content = $this->getLayout()->createBlock('dataman/admin_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'dataman.xml';
        $content = $this->getLayout()->createBlock('dataman/admin_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

}
