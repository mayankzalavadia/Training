<?php

namespace Training\ShippingInstructions\Plugin\Checkout\Quote\Address;

use Magento\Quote\Model\Quote\Address;
use Magento\Quote\Model\Quote\Address\ToOrderAddress as QuoteToOrderAddres;
use Magento\Sales\Api\Data\OrderAddressInterface;

class ToOrderAddress
{
    public function afterConvert(
        QuoteToOrderAddres $subject,
        OrderAddressInterface $result,
        Address $quoteAddress,
        $data = []
    ) {
        if ($quoteAddress->getData('shipping_instructions')) {
            $result->setData('shipping_instructions', $quoteAddress->getData('shipping_instructions'));
        }

        return $result;
    }
}
