<?php
namespace Vendor\EntityModelRepository\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MyEntityResourceModel extends AbstractDb
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('vendor_custom_table', 'entity_id');
    }

}
