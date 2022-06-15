<?php

namespace Training\CheckoutField\Plugin\Checkout\Quote\Address;

use Magento\Quote\Model\Quote\Address\ToOrderAddress as QuoteToOrderAddres;
use Magento\Quote\Model\Quote\Address;
use Magento\Sales\Api\Data\OrderAddressInterface;

class ToOrderAddress
{
    public function afterConvert(
        QuoteToOrderAddres $subject,
        OrderAddressInterface $result,
        Address $quoteAddress,
        $data = []
    ) {
        if ($quoteAddress->getData('checkout_custom_field')) {
            $result->setData('checkout_custom_field', $quoteAddress->getData('checkout_custom_field'));
        }

        return $result;
    }
}
