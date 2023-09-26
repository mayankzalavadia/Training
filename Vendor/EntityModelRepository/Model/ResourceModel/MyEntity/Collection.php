<?php
namespace Vendor\EntityModelRepository\Model\ResourceModel\MyEntity;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Vendor\EntityModelRepository\Model\MyEntityModel', 'Vendor\EntityModelRepository\Model\ResourceModel\MyEntityResourceModel');
    }

}
