<?php

namespace Training\HelloWorld\Api;

use Training\HelloWorld\Api\Data\SupplierInterface;

interface SupplierRepositoryInterface
{
    /**
     * @param string $code
     * @return SupplierInterface
     */
    public function createNew(string $code):SupplierInterface;
}
