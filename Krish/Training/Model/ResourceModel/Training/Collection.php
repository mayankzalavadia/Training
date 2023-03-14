<?php

namespace Krish\Training\Model\ResourceModel\Training;

use Krish\Training\Model\ResourceModel\Training as TrainingResourceModel;
use Krish\Training\Model\Training;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        return $this->_init(Training::class, TrainingResourceModel::class);
    }

    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->columns('CONCAT(`first_name`, " ", `last_name`) as full_name');
        return $this;
    }

    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'full_name') {
            $conditionSql = $this->_getConditionSql(
                'CONCAT(`main_table`.`first_name`, " ", `main_table`.`last_name`)',
                $condition
            );
            $this->getSelect()->where($conditionSql);
            return $this;
        }
        return parent::addFieldToFilter($field, $condition);
    }

}
