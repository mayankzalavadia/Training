<?php

namespace Vendor\EntityModelRepository\Model;

use Vendor\EntityModelRepository\Model\ResourceModel\MyEntityResourceModel;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterfaceFactory;
use Vendor\EntityModelRepository\Api\Data\MyEntitySearchResultInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntitySearchResultInterfaceFactory;
use Vendor\EntityModelRepository\Api\MyEntityRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class MyEntityRepository extends AbstractRepository implements MyEntityRepositoryInterface
{
    private MyEntityInterfaceFactory $MyEntityInterfaceFactory;

    /**
     * @param MyEntityInterfaceFactory $MyEntityInterfaceFactory
     * @param MyEntitySearchResultInterfaceFactory $searchResultFactory
     * @param ResourceModel\MyEntity\CollectionFactory $myEntityCollectionFactory
     */
    public function __construct(
        MyEntityInterfaceFactory $MyEntityInterfaceFactory,
        MyEntitySearchResultInterfaceFactory $searchResultFactory,
        ResourceModel\MyEntity\CollectionFactory $myEntityCollectionFactory
    )
    {
        $this->MyEntityInterfaceFactory = $MyEntityInterfaceFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->myEntityCollectionFactory = $myEntityCollectionFactory;
    }

    /**
     * @inheritDoc
     */
    public function save(MyEntityInterface $myEntity)
    {
         try {
             $obj = $this->MyEntityInterfaceFactory->create();
             $obj->getResource()->load($obj, $myEntity->getEntityId());
             $obj->getResource()->save($myEntity);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the offers: %1',
                $exception->getMessage()
            ));
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function delete(MyEntityInterface $myEntity)
    {
        $obj = $this->MyEntityInterfaceFactory->create();
        $obj->getResource()->delete($myEntity);
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
         $collection = $this->myEntityCollectionFactory->create();
        $searchResults = $this->searchResultFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection, $searchResults);
    }

    /**
     * @inheritDoc
     */
    public function getById($entity_id)
    {
        $obj = $this->MyEntityInterfaceFactory->create();
        $obj->getResource()->load($obj, $entity_id);
        if (! $obj->getId()) {
            throw new NoSuchEntityException(__('Unable to find My Entity with ID "%1"', $entity_id));
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($entity_id)
    {
        $obj = $this->getById($entity_id);
        $obj->delete();
    }
}
