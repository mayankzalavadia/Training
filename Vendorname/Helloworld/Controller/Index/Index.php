<?php

namespace Vendorname\Helloworld\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vendorname\HelloWorld\Helper\SendMail as MailSenderHelper;
use Vendorname\HelloWorld\Helper\Config as ConfigHelper;

/**
 * Class Index
 * @package Vendorname\Helloworld\Controller\Index
 */
class Index extends Action {

    /**
     * Index constructor.
     * @param Context $context
     * @param MailSenderHelper $mailSenderHelper
     * @param configHelper $configHelper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MailSenderHelper $mailSenderHelper,
        ConfigHelper $configHelper
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->mailSenderHelper = $mailSenderHelper;
        $this->configHelper = $configHelper;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        $resultPage = $this->resultPageFactory->create();
        
        $emailTemplate = $this->configHelper->getEmailTemplate();
        $mailReceiver = $this->configHelper->getSendTo();
        $customVariables = [];
        $customVariables['your_custom_varibale'] = "HelloWorld";
        try{
            $this->mailSenderHelper->sendMail($emailTemplate, $customVariables, $mailReceiver);
            $this->messageManager->addSuccessMessage(__("Email send Successfully."));
        }catch (\Exception $e){
            $this->messageManager->addErrorMessage(__("Email send fail."));
        }
        return $resultPage;
    }
}
