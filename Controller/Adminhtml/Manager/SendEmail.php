<?php
/**
 * Copyright © 2015 Magenest. All rights reserved.
 * See COPYING.txt for license details.
 *
 *
 * Magenest_Ticket extension
 * NOTICE OF LICENSE
 *
 * @category  Magenest
 * @package   Magenest_Ticket
 * @author ThaoPV <thaopw@gmail.com>
 */
namespace Magenest\Ticket\Model;

use Magenest\CallToOrder\Model\Manager;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\Area;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class Email
 * @package Magenest\Ticket\Model
 */
class Email extends AbstractModel
{
    /**
     * Const Email
     */
    const XML_PATH_EMAIL_SENDER = 'trans_email/ident_general/email';

    /**
     * Const Name
     */
    const XML_PATH_NAME_SENDER = 'trans_email/ident_general/name';

    protected $_logger;

    /**
     * @var ScopeConfigInterface
     */
    protected $_scopeConfig;


    protected $_transportBuilder;

    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var ManagerFactory
     */
    protected $manager;

    /**
     * Email constructor.
     * @param Context $context
     * @param Registry $registry
     * @param ScopeConfigInterface $scopeConfig
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param StoreManagerInterface $storeManager
     * @param ManagerFactory $managerFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        \Psr\Log\LoggerInterface $loggerInterface,
        StoreManagerInterface $storeManager,
        ManagerFactory $managerFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry);
        $this->_scopeConfig = $scopeConfig;
        $this->_transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->_storeManager = $storeManager;
        $this->_logger = $loggerInterface;
        $this->manager = $managerFactory;
    }

    /**
     * Send Mail to customer
     *
     * @param $eventName
     */
    public function sendMail()
    {
        $id = 2;
        $model = $this->manager->create()->load($id);

        $this->inlineTranslation->suspend();
        $array = [
            'store' => $this->_storeManager->getStore(),
            'store URL' => $this->_storeManager->getStore()->getBaseUrl(),
            'ticket_code' => $this->getCode(),
            'customer_name' => $this->getCustomerName(),
        ];

        $this->_logger->debug(print_r($model,true));
//        $transport = $this->_transportBuilder->setTemplateIdentifier('calltoorder_email_template')->setTemplateOptions(
//            [
//                'area' => Area::AREA_FRONTEND,
//                'store' => $this->_storeManager->getStore()->getId(),
//            ]
//        )->setTemplateVars(
//            [
//                'store' => $this->_storeManager->getStore(),
//                'store URL' => $this->_storeManager->getStore()->getBaseUrl(),
//                'ticket_code' => $this->getCode(),
//                'customer_name' => $this->getCustomerName(),
//            ]
//        )->setFrom(
//            [
//                'email' => $this->_scopeConfig->getValue(self::XML_PATH_EMAIL_SENDER),
//                'name' => $this->_scopeConfig->getValue(self::XML_PATH_NAME_SENDER)
//            ]
//        )->addTo(
//            $model->getEmail(),
//            $model->getName()
//        )->getTransport();
//        $transport->sendMessage();
//        $this->inlineTranslation->resume();
    }

}