<?php
/**
 * Copyright © 2015 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Magenest_QuickBooksDesktop extension
 * NOTICE OF LICENSE
 */
namespace Magenest\CallToOrder\Controller\Adminhtml\Manager;

use Magenest\CallToOrder\Controller\Adminhtml\Manager as ManagerController;

/**
 * Class MassDelete
 * @package Magenest\CallToOrder\Controller\Adminhtml\Manager
 */
class MassDelete extends ManagerController
{
    /**
     * @return mixed
     */
    public function execute()
    {
        $collection = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = \Magento\Framework\App\ObjectManager::getInstance()->create('Magenest\CallToOrder\Model\Manager');
        if(isset($collection['selected'])){
            $cols = $collection['selected'];
        }
        else{
            foreach ($model->getCollection() as $item){
                $model->load($item->getGalleryId())->delete();
            }
            $this->messageManager->addSuccessMessage(__('All records have been deteled.'));
            return $resultRedirect->setPath('*/*/');
        }
        $totals = 0;

        try {
            foreach ($cols as $item) {
                /** @var \Magenest\CallToOrder\Model\Manager $item */
                $model ->load($item);
                $model->delete();
                $totals++;
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deteled.', $totals));
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->_getSession()->addException($e, __('Something went wrong while delete the post(s).'));
        }


        return $resultRedirect->setPath('*/*/');

    }
}