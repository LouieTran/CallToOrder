<?php

namespace Magenest\CallToOrder\Model\ResourceModel\Manager;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Magenest\CallToOrder\Model\Manager','Magenest\CallToOrder\Model\ResourceModel\Manager');
    }
}