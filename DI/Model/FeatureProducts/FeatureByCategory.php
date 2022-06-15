<?php

namespace Training\DI\Model\FeatureProducts;

class FeatureByCategory implements FeatureProductsInterface
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
            'Products_1',
            'Products_2',
            'Products_3',
            'Products_4',
            'Products_5',
            'Products_6',
        ];

    }
}
