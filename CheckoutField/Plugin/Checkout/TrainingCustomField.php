<?php

namespace Training\CheckoutField\Plugin\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;

class TrainingCustomField
{

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    )
    {
        $shippingAddress = $addressInformation->getShippingAddress();
        $shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
        if ($shippingAddressExtensionAttributes) {
            $checkoutField = $shippingAddressExtensionAttributes->getCheckoutCustomField();
            $shippingAddress->setCheckoutCustomField($checkoutField);
        }
    }
}
