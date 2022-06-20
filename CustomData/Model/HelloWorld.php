<?php

namespace Training\CustomData\Model;

use Training\CustomData\Model\ResourceModel\HelloWorld as HelloWorldResourceModel;
use Magento\Framework\Model\AbstractModel;

class HelloWorld extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(HelloWorldResourceModel::class);
    }
}
