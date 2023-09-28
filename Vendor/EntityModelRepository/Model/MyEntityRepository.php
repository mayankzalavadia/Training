<?php

namespace Vendor\EntityModelRepository\Model;

use Vendor\EntityModelRepository\Model\ResourceModel\MyEntityResourceModel;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterfaceFactory;
use Vendor\EntityModelRepository\Api\Data\MyEntitySearchResultInterfaceFactory;
use Vendor\EntityModelRepository\Api\MyEntityRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;


class MyEntityRepository extends AbstractRepository implements MyEntityRepositoryInterface
{
    private MyEntityInterfaceFactory $myEntityInterfaceFactory;
    private MyEntityResourceModel $myEntityResourceModel;

    /**
     * @param MyEntityInterfaceFactory $myEntityInterfaceFactory
     * @param MyEntitySearchResultInterfaceFactory $searchResultFactory
     * @param ResourceModel\MyEntity\CollectionFactory $myEntityCollectionFactory
     * @param MyEntityResourceModel $myEntityResourceModel
     */
    public function __construct(
        MyEntityInterfaceFactory $myEntityInterfaceFactory,
        MyEntitySearchResultInterfaceFactory $searchResultFactory,
        ResourceModel\MyEntity\CollectionFactory $myEntityCollectionFactory,
        ResourceModel\MyEntityResourceModel $myEntityResourceModel
    )
    {
        $this->myEntityInterfaceFactory = $myEntityInterfaceFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->myEntityCollectionFactory = $myEntityCollectionFactory;
        $this->myEntityResourceModel = $myEntityResourceModel;
    }

    /**
     * @inheritDoc
     */
    public function save(MyEntityInterface $myEntity)
    {
         try {
             $obj = $this->myEntityInterfaceFactory->create();
             $this->myEntityResourceModel->load($obj, $myEntity->getEntityId());
             $this->myEntityResourceModel->save($myEntity);
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
    public function getById($entity_id)
    {
        $obj = $this->myEntityInterfaceFactory->create();
        $this->myEntityResourceModel->load($obj, $entity_id);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function delete(MyEntityInterface $myEntity)
    {
        $this->myEntityResourceModel->delete($myEntity);
    }

    /**
     * @inheritDoc
     */
    public function deleteById($entity_id)
    {
        $obj = $this->getById($entity_id);
        $this->delete($obj);
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
}
