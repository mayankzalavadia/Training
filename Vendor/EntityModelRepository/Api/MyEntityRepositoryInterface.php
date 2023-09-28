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
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\StateException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(MyEntityInterface $myEntity);

    /**
     * @param $entity_id
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($entity_id);

    /**
     * @param MyEntityInterface $myEntity
     * @return MyEntityInterface
     * @throws \Magento\Framework\Exception\StateException
     */
    public function delete(MyEntityInterface $myEntity);

    /**
     * @param $entity_id
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateExceptio
     */
    public function deleteById($entity_id);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return MyEntitySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
