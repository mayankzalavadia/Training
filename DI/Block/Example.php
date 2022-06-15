<?php

namespace Training\DI\Block;

use Magento\Framework\View\Element\Template;
use Training\DI\Model\Main;

class Example extends Template
{
    /**
     * @var Main
     */
    private Main $main;

    public function __construct(
        Template\Context $context,
        Main $main,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->main = $main;
    }

    public function getMain(): Main
    {
       return $this->main;
    }

}
