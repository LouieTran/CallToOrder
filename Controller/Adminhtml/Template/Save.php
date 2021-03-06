<?php
/**
 * @copyright Copyright (c) 2016 www.magebuzz.com
 */

namespace Magenest\CallToOrder\Controller\Adminhtml\Template;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\App\Cache\TypeListInterface
     */
    protected $cacheTypeList;
    protected $_logger;

    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $jsHelper;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Psr\Log\LoggerInterface $loggerInterface
     * @param \Magento\Backend\Helper\Js $jsHelper
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Psr\Log\LoggerInterface $loggerInterface,
        \Magento\Backend\Helper\Js $jsHelper
    )
    {
        $this->_logger = $loggerInterface;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context);
        $this->jsHelper = $jsHelper;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Save
     * @return $this
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $this->_logger->debug(print_r($data,true));

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \Magenest\CallToOrder\Model\Manager $model */
            $model = $this->_objectManager->create('Magenest\CallToOrder\Model\Template');

            $id = $this->getRequest()->getParam('calltoorder_id');
            if ($id) {
                $model->load($id);
            }

            $model->addData($data);

            $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($model->getData());
            try {
                $model->save();
                $this->_eventManager->dispatch('calltoorder_template_save_after', ['template' => $model, 'request' => $this->getRequest()]);
                $this->messageManager->addSuccessMessage(__('Invoice has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e, __('Something went wrong while saving the template.'));
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
            }
        }
        return $resultRedirect->setPath('*/*/');
    }
}