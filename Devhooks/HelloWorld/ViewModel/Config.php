<?php

namespace Devhooks\HelloWorld\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Config implements ArgumentInterface
{
    protected $helperData;

    public function __construct(
        \Devhooks\HelloWorld\Helper\Data $helperData
    ) {
        $this->helperData = $helperData;
    }

    /**
     * @return mixed
     */
    public function getConfigIsEnable()
    {
        return $this->helperData->getGeneralConfig('enable');
    }

    /**
     * @return mixed
     */
    public function getConfigDisplayText()
    {
        return $this->helperData->getGeneralConfig('display_text');
    }
}
