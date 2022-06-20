<?php

namespace Training\CustomData\Model\ResourceModel\HelloWorld;

use Training\CustomData\Model\HelloWorld as HelloWorldModel;
use Training\CustomData\Model\ResourceModel\HelloWorld as HelloWorldResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            HelloWorldModel::class,
            HelloWorldResourceModel::class
        );
    }
}
