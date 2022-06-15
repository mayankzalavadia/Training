<?php

namespace Training\DI\Model;

use Training\DI\Model\FeatureProducts\FeatureByCategory;
use Training\DI\Model\FeatureProducts\FeatureBySales;

class FeatureProducts
{
    /**
     * @var FeatureByCategory
     */
    private FeatureByCategory $featureByCategory;
    /**
     * @var FeatureBySales
     */
    private FeatureBySales $featureBySales;

    public function __construct(FeatureByCategory $featureByCategory, FeatureBySales $featureBySales)
    {

        $this->featureByCategory = $featureByCategory;
        $this->featureBySales = $featureBySales;
    }

    public function getFeatureProducts(): array
    {
        if($this->featureByCategory->count() < 7){
            return $this->featureBySales->getFeatureProducts();
        }

        return $this->featureByCategory->getFeatureProducts();
    }

}

