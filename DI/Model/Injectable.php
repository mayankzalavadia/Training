<?php

declare(strict_types=1);

namespace Training\DI\Model;

class Injectable implements InjectableInterface
{
    /**
     * @return string
     */
    public function getId(): string
    {
        return "Class Injectable";
    }
}
