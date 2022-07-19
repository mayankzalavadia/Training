<?php
namespace Vendorname\Helloworld\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Vendorname\Helloworld\Helper\Config;
use Magento\Framework\App\Area;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class SendEmail
 * @package Vendorname\Helloworld\Helper
 */
class SendMail extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;
    /**
     * @var \Magento\Framework\Filesystem\Io\File
     */
    protected $file;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param File $file
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        Config $configHelper,
        File $file,
        ManagerInterface $messageManager
    ) {
        parent::__construct($context);
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->configHelper = $configHelper;
        $this->file = $file;
        $this->messageManager = $messageManager;
    }

    /**
     * @param $emailTemplateName
     * @param $customerData
     * @param $customerEmail
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\MailException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function sendMail($emailTemplateId, $customerData, $customerEmail, $store = '')
    {
        try {
            $store = $store ? $store : $this->storeManager->getStore()->getId();
            $sender = $this->configHelper->getEmailSender();

            $transport = $this->transportBuilder->setTemplateIdentifier($emailTemplateId)
                              ->setTemplateOptions(['area' => Area::AREA_FRONTEND, 'store' => $store])
                              ->setTemplateVars($customerData)
                              ->setFrom($sender)
                              ->addTo($customerEmail);
            /*Add attachment start*/                  
            $fileUrl = 'http://192.168.3.34/m244/pub/media/wysiwyg/helloworld/image.png';
            if ($fileUrl) {
                $fileContent = file_get_contents($fileUrl);
                $fileInfo = $this->file->getPathInfo($fileUrl);
                $fileName = $fileInfo['basename'];
                $fileType = $this->getFileType($fileInfo['extension']);
                $transport = $this->transportBuilder->addAttachment($fileContent, $fileName, $fileType);
            }
            /*Add attachment end*/                  
            $transport = $this->transportBuilder->getTransport();
            $transport->sendMessage();
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__('Email send fail'));
        }
    }

    public function getFileType($fileExtension)
    {
        $fileType = '';
        $ftype = [];
        $ftype['pdf'] = "application/pdf";
        $ftype['csv'] = "text/csv";
        $ftype['xls'] = "application/vnd.ms-excel";
        $ftype['doc'] = "application/msword";
        $ftype['docx'] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $ftype['txt'] = "text/plain";
        $ftype['jpg'] = "image/jpg";
        $ftype['jpeg'] = "image/jpeg";
        $ftype['gif'] = "image/gif";
        $ftype['png'] = "image/png";
        foreach ($ftype as $key => $validFileType) {
            if ($key == $fileExtension) {
                $fileType = $validFileType;
                break;
            }
        }
        return $fileType;
    }
}
