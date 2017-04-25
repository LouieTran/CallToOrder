<?php
namespace	Magenest\CallToOrder\Controller\Adminhtml\Index;
class	Manager	extends	\Magento\Framework\App\Action\Action	{
    public	function	execute()	{
        $subscription	=	$this->_objectManager->create('Magenest\CallToOrder\Model\Manager');
				$subscription->setName('John');
				$subscription->setPhone('Doe');
				$subscription->setEmail('john.doe@example.com');
				$subscription->save();
				$this->getResponse()->setBody('success');
    }
}