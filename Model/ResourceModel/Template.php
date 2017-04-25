<?php
namespace Magenest\CallToOrder\Model\ResourceModel;

class Template extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('magenest_call_to_order_template','id');
    }
}
