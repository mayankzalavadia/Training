<?php

namespace Krish\Training\Api;

use Krish\Training\Api\Data\TrainingInterface;
use Krish\Training\Api\Data\TrainingSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface TrainingRepositoryInterface
{
    /**
     * Save Training
     *
     * @param TrainingInterface $training
     * @return TrainingInterface
     * @throw NoSuchEntityException
     */
    public function save(
        TrainingInterface $training
    ): TrainingInterface;

    /**
     * Get Training Record
     *
     * @param int $id
     * @return TrainingInterface
     * @throw NoSuchEntityException
     */
    public function get(int $id): TrainingInterface;

    /**
     * Retrieve Training matching the search criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return TrainingSearchResultsInterface
     * @throw LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Training
     *
     * @param TrainingInterface $training
     * @return bool
     * @throw NoSuchEntityException
     */
    public function delete(
        TrainingInterface $training
    ): bool;

    /**
     * Delete Training By Id
     *
     * @param int $id
     * @return bool
     * @throw NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
