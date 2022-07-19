<?php

namespace Vendorname\Helloworld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Helloworld extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('helloworld_data', 'id');
    }
}
