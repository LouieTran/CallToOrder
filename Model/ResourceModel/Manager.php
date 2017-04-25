<?php
namespace Magenest\CallToOrder\Model\ResourceModel;

class Manager extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_call_to_order_manager','id');
    }
}
