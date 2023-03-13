<?php

namespace Krish\Training\Model;

use Krish\Training\Api\Data\TrainingInterface;
use Krish\Training\Api\Data\TrainingInterfaceFactory as InterfaceFactory;
use Krish\Training\Api\Data\TrainingSearchResultsInterfaceFactory as SearchResultsInterface;
use Krish\Training\Api\TrainingRepositoryInterface;
use Krish\Training\Model\ResourceModel\Training as Resource;
use Krish\Training\Model\ResourceModel\Training\CollectionFactory as Collection;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class TrainingRepository implements TrainingRepositoryInterface
{
    private Resource $resource;
    private InterfaceFactory $interfaceFactory;
    private Collection $collectionFactory;
    private SearchResultsInterface $searchResults;
    private CollectionProcessorInterface $collectionProcessor;

    /**
     * @param Resource $resource
     * @param InterfaceFactory $interfaceFactory
     * @param Collection $collectionFactory
     * @param SearchResultsInterface $searchResults
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        Resource $resource,
        InterfaceFactory $interfaceFactory,
        Collection $collectionFactory,
        SearchResultsInterface $searchResults,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->interfaceFactory = $interfaceFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResults = $searchResults;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(TrainingInterface $training): TrainingInterface
    {
        try {
            $this->resource->save($training);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Record: %1',
                $exception->getMessage()
            ));
        }
        return $training;
    }

    /**
     * @inheritDoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResults->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function deleteById(int $id): bool
    {
        return $this->delete($this->get($id));
    }

    /**
     * @inheritDoc
     */
    public function delete(TrainingInterface $training): bool
    {
        try {
            $trainingModel = $this->interfaceFactory->create();
            $this->resource->load($trainingModel, $training->getId());
            $this->resource->delete($trainingModel);
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
    public function get(int $id): TrainingInterface
    {
        try {
            $training = $this->interfaceFactory->create();
            $this->resource->load($training, $id);
            if (!$training->getId()) {
                throw new NoSuchEntityException(__('Record with id "%1" does not exist.', $id));
            }
        } catch (\Exception $exception) {
            throw new NoSuchEntityException(__($exception->getMessage()));
        }
        return $training;
    }

}
