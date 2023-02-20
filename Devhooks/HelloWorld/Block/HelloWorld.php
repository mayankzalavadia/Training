<?php
namespace Devhooks\HelloWorld\Block;

class HelloWorld extends \Magento\Framework\View\Element\Template
{
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getSampleText()
    {
        return 'Hello World';
    }
}
