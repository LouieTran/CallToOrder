<?php

namespace Magenest\CallToOrder\Model\ResourceModel\Template;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init('Magenest\CallToOrder\Model\Template','Magenest\CallToOrder\Model\ResourceModel\Template');
    }
}