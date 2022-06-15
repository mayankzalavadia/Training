<?php

namespace Training\DI\Plugin\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Quote\Model\QuoteRepository;
use Psr\Log\LoggerInterface;


class TrainingCustomField
{
    protected $logger;

    /**
     * @var QuoteRepository
     */
    protected $quoteRepository;

    public function __construct(LoggerInterface $logger, QuoteRepository $quoteRepository)
    {
        $this->logger = $logger;
        $this->quoteRepository = $quoteRepository;
    }

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    )
    {
        /*$extensionAttrs = $addressInformation->getShippingAddress()->getExtensionAttributes();*/
        $extensionAttrs = $addressInformation->getExtensionAttributes();
        if(!$extensionAttrs){
            return;
        }
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setTrainingCustomField('registration.php');
        /*if ($extensionAttrs->getTrainingCustomField()){
            $this->logger->info('Mayank');
            $addressInformation->getShippingAddress()->setTrainingCustomField($extensionAttrs->getTrainingCustomField());
        }*/
    }
}
