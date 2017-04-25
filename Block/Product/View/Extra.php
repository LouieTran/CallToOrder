<?php

namespace Magenest\CallToOrder\Block\Product\View;

use Magento\Catalog\Block\Product\AbstractProduct;

class Extra extends AbstractProduct
{

    public function getConfig()
    {
        $model = \Magento\Framework\App\ObjectManager::getInstance()->
        create('Magento\Framework\App\Config\ScopeConfigInterface');
        $pattern =  $model->getValue('calltoorder_setting/call_order/phone',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $pattern;
    }
    
    public function getAjax()
    {
        return $this->getUrl('calltoorder/product/save');
    }
    
    
//    public function getProduct()
//    {
//        $data = $this->_request->getParams();
//
//        return $data;
//    }
}