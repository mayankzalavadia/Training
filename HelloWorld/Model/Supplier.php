<?php

namespace Training\HelloWorld\Model;

use Training\HelloWorld\Api\Data\SupplierInterface;

class Supplier implements SupplierInterface
{
    /**
     * @param string $code
     * @return void
     */
    public function setSupplier(string $code): void
    {
        $this->code = $code;
    }

    protected string $code;
    /**
     * @return string
     */
    public function getSupplier(): string
    {
        return $this->code;
    }
}
