<?php

namespace Devhooks\HelloWorld\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Devhooks\HelloWorld\Api\Data\HelloWorldInterface;
use Devhooks\HelloWorld\Api\Data\HelloWorldSearchResultsInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface HelloWorldRepositoryInterface
{
    /**
     * Save HelloWorld
     *
     * @param HelloWorldInterface $helloWorld
     * @return HelloWorldInterface
     * @throws LocalizedException
     */
    public function save(
        HelloWorldInterface $helloWorld
    );

    /**
     * Retrieve HelloWorld
     *
     * @param int $Id
     * @return HelloWorldInterface
     * @throws LocalizedException
     */
    public function get(int $Id);

    /**
     * Retrieve HelloWorld matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return HelloWorldSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete HelloWorld
     *
     * @param HelloWorldInterface $helloWorld
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(
        HelloWorldInterface $helloWorld
    );

    /**
     * Delete HelloWorld by ID
     *
     * @param int $Id
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $Id);

    /**
     * Get HelloWorld by ID
     *
     * @param int $Id
     * @return mixed
     */
    public function getById(int $Id);

}
