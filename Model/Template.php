<?php
namespace Magenest\CallToOrder\Model;


class Template extends \Magento\Framework\Model\AbstractModel
{
    public function _construct()
    {
        $this->_init('Magenest\CallToOrder\Model\ResourceModel\Template');
    }
}