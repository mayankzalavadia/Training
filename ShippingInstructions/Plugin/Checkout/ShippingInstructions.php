<?php

namespace Training\ShippingInstructions\Plugin\Checkout;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement;

class ShippingInstructions
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
            $checkoutField = $shippingAddressExtensionAttributes->getShippingInstructions();
            $shippingAddress->setShippingInstructions($checkoutField);
        }
    }
}
