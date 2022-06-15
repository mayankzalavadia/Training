<?php

declare(strict_types=1);

namespace Training\DI\Model\FeatureProducts;

interface FeatureProductsInterface
{
    public function getFeatureProducts(): array;

    public function count(): int;
}
