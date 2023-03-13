<?php

namespace Krish\Training\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Training extends AbstractDb
{

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        return $this->_init('krish_training', 'id');
    }
}
