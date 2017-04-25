<?php
namespace Magenest\CallToOrder\Controller\Adminhtml\Manager;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;


    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Magenest_CallToOrder::Manager');
        $resultPage->addBreadcrumb(__('Manage Call Backs'),	__('Manage Call Backs'));
        $resultPage->addBreadcrumb(__('Call Back Manager'),	__('Call Back Manager'));
        $resultPage->getConfig()->getTitle()->prepend(__('Call Back Manager'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}