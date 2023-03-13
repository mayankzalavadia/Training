<?php

namespace Krish\Training\Model\ResourceModel\Training;

use Krish\Training\Model\ResourceModel\Training as TrainingResourceModel;
use Krish\Training\Model\Training;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        return $this->_init(Training::class, TrainingResourceModel::class);
    }

}
