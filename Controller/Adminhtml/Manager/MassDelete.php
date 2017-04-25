<?php
/**
 * Copyright © 2015 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 *
 * Magenest_ProductLabel extension
 * NOTICE OF LICENSE
 *
 * @category  Magenest
 * @package   Magenest_ProductLabel
 * @author <ThaoPV>-thaopw@gmail.com
 */
namespace Magenest\CallToOrder\Controller\Adminhtml\Manager;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Magenest\CallToOrder\Model\ResourceModel\Manager\CollectionFactory as ManagerCollectionFactory;
use Magenest\CallToOrder\Controller\Adminhtml\Manager as ManagerController;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\ForwardFactory;

/**
 * Class MassDelete
 * @package Magenest\CallToOrder\Controller\Adminhtml\Manager
 */
class MassDelete extends ManagerController
{
    /**
     * @var Filter
     */
    protected $_filter;
    protected  $_logger;
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     * @param ManagerCollectionFactory $collectionFactory
     * @param Filter $filter
     * @param ForwardFactory $resultForwardFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        ManagerCollectionFactory $collectionFactory,
        Filter $filter,
        ForwardFactory $resultForwardFactory,
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magenest\CallToOrder\Model\ManagerFactory $managerFactory
    ) {
        $this->_logger = $loggerInterface;
        $this->manager = $managerFactory;
        $this->_filter = $filter;
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context, $coreRegistry, $resultPageFactory, $collectionFactory);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $data = $this->_request->getParams();
        $this->_logger->debug(print_r($data,true));
        $array = $data['selected'];
        $totals = 0;
        try {
            foreach ($array as $item) {
                $model = $this->manager->create()->load($item);
                $model->delete();
                $totals++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deteled.', $totals));
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->_getSession()->addException($e, __('Something went wrong while delete the post(s).'));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        
        return $resultRedirect->setPath('*/*/');
    }
}
