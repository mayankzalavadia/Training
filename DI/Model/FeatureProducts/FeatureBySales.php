<?php

namespace Training\DI\Model\FeatureProducts;

class FeatureBySales implements FeatureProductsInterface
{
    protected array $featureProducts = [];

    public function __construct()
    {
        $this->loadFeatureProducts();
    }

    public function getFeatureProducts(): array
    {
        return $this->featureProducts;
    }

    public function count(): int
    {
        return count($this->featureProducts);
    }

    protected function loadFeatureProducts(): array
    {
        return $this->featureProducts = [
            'Sales_1',
            'Sales_2',
            'Sales_3',
            'Sales_4',
            'Sales_5',
            'Sales_6',
        ];

    }
}
