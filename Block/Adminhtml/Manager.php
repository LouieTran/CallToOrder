<?php
namespace Magenest\CallToOrder\Block\Adminhtml;
class Manager extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup	= 'Magenest_CallToOrder';
        $this->_controller	= 'adminhtml_manager';
        parent::_construct();
        $this->removeButton('add');
    }
}