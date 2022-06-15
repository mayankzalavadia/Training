<?php
namespace Training\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class HelloWorld extends Template
{
    /**
     * @return HelloWorld
     */
    public function _prepareLayout(): HelloWorld
    {
        return parent::_prepareLayout();
    }

    /**
     * @return string
     */
    public function getSampleText()
    {
        return 'Hello World';
    }
}
