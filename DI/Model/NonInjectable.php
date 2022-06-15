<?php


namespace Training\DI\Model;


class NonInjectable implements NonInjectableInterface
{
    public function getId(): string
    {
        return "Class NonInjectable";
    }

}
