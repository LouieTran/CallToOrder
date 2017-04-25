<?php
namespace Magenest\CallToOrder\Controller\Adminhtml\Report;

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
        $resultPage->setActiveMenu('Magenest_CallToOrder::Report');
        $resultPage->addBreadcrumb(__('Report for admin'),	__('Report for admin'));
        $resultPage->addBreadcrumb(__('Report for admin'),	__('Report for admin'));
        $resultPage->getConfig()->getTitle()->prepend(__('Report Call To Order'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}