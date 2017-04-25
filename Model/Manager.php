<?php
namespace Magenest\CallToOrder\Model;


class Manager extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Magenest\CallToOrder\Model\ResourceModel\Manager');
    }
}