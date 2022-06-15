<?php

namespace Training\DI\ViewModel;

use \Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\DI\Model\FeatureProducts;

class Example implements ArgumentInterface
{
    /**
     * @var FeatureProducts
     */
    private FeatureProducts $featureProducts;

    public function __construct(FeatureProducts $featureProducts)
    {
        $this->featureProducts = $featureProducts;
    }

    /**
     * @return FeatureProducts
     */
    public function getFeatureProducts(): array
    {
        return $this->featureProducts->getFeatureProducts();
    }
}
