<?php

namespace Devhooks\HelloWorld\Model;

use Devhooks\HelloWorld\Model\HelloWorldRepository;
use Devhooks\HelloWorld\Api\Data\HelloWorldInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Exception\LocalizedException;

class HelloWorldCollections
{
    private HelloWorldRepository $helloWorldRepository;

    /**
     * @param HelloWorldRepository $helloWorldRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     */
    public function __construct(
        HelloWorldRepository $helloWorldRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder
    ) {
        $this->helloWorldRepository = $helloWorldRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * HelloWorld Collection by Name
     *
     * @param string $name
     * @return HelloWorldInterface[]
     * @throws LocalizedException
     */
    public function getCollectionByName($name)
    {
        $sortOrder = $this->sortOrderBuilder->setField('position')->setDirection('ASC')->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('fname', $name, 'like')
            ->addFilter('lname', $name, 'like')
            ->addFilter('status', '1', 'eq')
            ->setSortOrders([$sortOrder])->create();
        return $this->helloWorldRepository->getList($searchCriteria)->getItems();
    }
}
