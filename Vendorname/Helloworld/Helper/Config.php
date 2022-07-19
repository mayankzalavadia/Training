<?php
namespace Vendorname\Helloworld\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 * @package Vendorname\Helloworld\Helper
 */
class Config extends \Magento\Framework\App\Helper\AbstractHelper
{
    const EMAIL_SENDER_NAME = 'vendorname/general/email_sender';
    const EMAIL_SEND_TO   = 'vendorname/general/send_email';
    const SELECT_EMAIL_TEMPLATE = 'vendorname/general/custom_email_template';
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var $emailTemplate
     */
    protected $emailTemplate;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param StoreManagerInterface $storeManager
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param $const
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function scopConfig($const) {
       return $this->scopeConfig->getValue($const, ScopeInterface::SCOPE_STORE, $this->storeManager->getStore()->getId());
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getSendTo(){
        $newEmails = [];
        $emailString = $this->scopConfig(self::EMAIL_SEND_TO);
        $emails = $emailString ? explode(',', $emailString) : [];
        foreach ($emails as $email) {
            if ($email != '') {
                $email = preg_replace('/\s+/', '', $email);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $newEmails[] = $email;
                }
            }
        }
        return $newEmails;
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getEmailTemplate(){
        return $this->scopConfig(self::SELECT_EMAIL_TEMPLATE);
    }

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getEmailSender(){
        $sender = [];
        $emailSender = $this->scopConfig(self::EMAIL_SENDER_NAME);
        $sender['name'] = $this->scopConfig('trans_email/ident_'.$emailSender.'/name');
        $sender['email'] = $this->scopConfig('trans_email/ident_'.$emailSender.'/email');

        return $sender;
    }

}
