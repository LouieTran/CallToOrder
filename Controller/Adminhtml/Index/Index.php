<?php
namespace Magenest\CallToOrder\Controller\Adminhtml\Index;

use	Magento\Backend\App\Action\Context;
use	Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 * @package Magenest\CallToOrder\Controller\Adminhtml\Index
 */
class Index	extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    public function __construct(
        Context	$context,
        PageFactory	$resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    public function execute()
    {
        $resultPage	=	$this->resultPageFactory->create();
        
        return	$resultPage;
    }
}