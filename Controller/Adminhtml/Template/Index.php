<?php
namespace Magenest\CallToOrder\Controller\Adminhtml\Template;

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
        $resultPage->setActiveMenu('Magenest_CallToOrder::Templates');
        $resultPage->addBreadcrumb(__('Template'),	__('Template'));
        $resultPage->addBreadcrumb(__('Template Manager'),	__('Template Manager'));
        $resultPage->getConfig()->getTitle()->prepend(__('Email Template'));
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}