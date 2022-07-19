<?php

namespace Vendorname\Helloworld\Model\ResourceModel\Helloworld;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vendorname\Helloworld\Model\Helloworld as HelloworldModel;
use Vendorname\Helloworld\Model\ResourceModel\Helloworld as HelloworldResourceModel;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\Event\ManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Collection
 * @package Vendorname\Helloworld\Model\ResourceModel\Helloworld
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    protected function _construct()
    {
        $this->_init(
            HelloworldModel::class,
            HelloworldResourceModel::class
        );
    }

    /**
     * @return $this|Collection|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->join(
            ['ce' => $this->getConnection()->getTableName('customer_entity')],
            'main_table.customer_id = ce.entity_id',
            [
                'customer_name' => 'CONCAT(`ce`.`firstname`, " ", `ce`.`lastname`)'
            ]
        );
        return $this;
    }

    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'customer_name') {
            $customerTable = $this->getConnection()->getTableName('customer_entity');
            $this->getSelect()->joinLeft(
            ['cust' => $customerTable],
                'main_table.customer_id = cust.entity_id',
            []
            );
            $conditionSql = $this->_getConditionSql(
                'CONCAT(`cust`.`firstname`, " ", `cust`.`lastname`)',
                $condition
            );
            $this->getSelect()->where($conditionSql);
            return $this;
        }
        return parent::addFieldToFilter($field, $condition);
    }

}
