<?php

namespace Devhooks\HelloWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld as HelloWorldResourceModel;

class   HelloWorld extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(HelloWorldResourceModel::class);
    }
}
