<?php

namespace Devhooks\HelloWorld\Model;

use Devhooks\HelloWorld\Api\Data\HelloWorldInterface;
use Devhooks\HelloWorld\Api\Data\HelloWorldInterfaceFactory;
use Devhooks\HelloWorld\Api\Data\HelloWorldSearchResultsInterfaceFactory;
use Devhooks\HelloWorld\Api\HelloWorldRepositoryInterface;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld as ResourceHelloWorld;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld\CollectionFactory as HelloWorldCollection;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

class HelloWorldRepository implements HelloWorldRepositoryInterface
{
    private ResourceHelloWorld $resource;
    private HelloWorldInterfaceFactory $helloWorldFactory;
    private HelloWorldCollection $helloWorldCollectionFactory;

    private HelloWorldSearchResultsInterfaceFactory $helloWorldSearchResults;
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param ResourceHelloWorld $resource
     * @param HelloWorldInterfaceFactory $helloWorldFactory
     * @param HelloWorldCollection $helloWorldCollectionFactory
     * @param HelloWorldSearchResultsInterfaceFactory $helloWorldSearchResults
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceHelloWorld $resource,
        HelloWorldInterfaceFactory $helloWorldFactory,
        HelloWorldCollection $helloWorldCollectionFactory,
        HelloWorldSearchResultsInterfaceFactory $helloWorldSearchResults,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->helloWorldFactory = $helloWorldFactory;
        $this->helloWorldCollectionFactory = $helloWorldCollectionFactory;
        $this->helloWorldSearchResults = $helloWorldSearchResults;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(HelloWorldInterface $helloWorld)
    {
        try {
            $this->resource->save($helloWorld);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the offers: %1',
                $exception->getMessage()
            ));
        }
        return $helloWorld;
    }

    /**
     * @inheritDoc
     */
    public function get(int $id)
    {
        $helloWorld = $this->helloWorldFactory->create();
        $this->resource->load($helloWorld, $id);
        if (!$helloWorld->getId()) {
            throw new NoSuchEntityException(__('Record with id "%1" does not exist.', $id));
        }
        return $helloWorld;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->helloWorldCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->helloWorldSearchResults->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(HelloWorldInterface $helloWorld)
    {
        try {
            $helloWorldModel = $this->helloWorldFactory->create();
            $this->resource->load($helloWorldModel, $helloWorld->getId());
            $this->resource->delete($helloWorldModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the record: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->get($id));
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id)
    {
        if (!isset($this->instances[$id])) {
            $helloWorld = $this->helloWorldFactory->create();
            $this->resource->load($helloWorld, $id);
            if (!$helloWorld->getId()) {
                throw new NoSuchEntityException(__('Requested record doesn\'t exist'));
            }
            $this->instances[$id] = $helloWorld;
        }
        return $this->instances[$id];
    }
}
