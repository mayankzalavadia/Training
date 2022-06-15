<?php

namespace Training\HelloWorld\Api\Data;


interface SupplierInterface
{
    /**
     * @param string $code
     * @return string
     */
    public function setSupplier(string $code):void;

    /**
     * @return string
     */
    public function getSupplier():string;

}
