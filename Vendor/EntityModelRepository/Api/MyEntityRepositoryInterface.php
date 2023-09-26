<?php
namespace Vendor\EntityModelRepository\Api;

use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntitySearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface MyEntityRepositoryInterface
{
    /**
     * @param MyEntityInterface $myEntity
     * @return MyEntityInterface
     */
    public function save(MyEntityInterface $myEntity);

    /**
     * @param MyEntityInterface $myEntity
     * @return MyEntityInterface
     */
    public function delete(MyEntityInterface $myEntity);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return MyEntitySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param $entity_id
     * @return mixed
     */
    public function getById($entity_id);

    /**
     * @param $entity_id
     * @return mixed
     */
    public function deleteById($entity_id);
}
