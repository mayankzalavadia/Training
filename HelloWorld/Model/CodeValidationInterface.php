<?php


namespace Training\HelloWorld\Model;


interface CodeValidationInterface
{
    /**
     * @param $code
     */
    public function validate($code):void;

}
