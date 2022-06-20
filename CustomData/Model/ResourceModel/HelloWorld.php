<?php

namespace Training\CustomData\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class HelloWorld extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('training_customdata', 'id');
    }
}
