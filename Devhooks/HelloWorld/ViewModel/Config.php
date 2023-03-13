<?php

namespace Devhooks\HelloWorld\ViewModel;

use Devhooks\HelloWorld\Model\HelloWorldRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Config implements ArgumentInterface
{
    protected $helperData;
    private HelloWorldRepository $helloWorldRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private SortOrderBuilder $sortOrderBuilder;

    public function __construct(
        \Devhooks\HelloWorld\Helper\Data $helperData,
        HelloWorldRepository             $helloWorldRepository,
        SearchCriteriaBuilder            $searchCriteriaBuilder,
        SortOrderBuilder                 $sortOrderBuilder
    )
    {
        $this->helperData = $helperData;
        $this->helloWorldRepository = $helloWorldRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @return mixed
     */
    public function getConfigIsEnable()
    {
        return $this->helperData->getGeneralConfig('enable');
    }

    /**
     * @return mixed
     */
    public function getConfigDisplayText()
    {
        return $this->helperData->getGeneralConfig('display_text');
    }

    public function getRecords()
    {
        $sortOrder = $this->sortOrderBuilder->setField('id')->setDirection('ASC')->create();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('status', '1', 'eq')
            ->setSortOrders([$sortOrder])->create();
        $collection = $this->helloWorldRepository->getList($searchCriteria)->getItems();
        //$collection = $this->helloWorldFactory->create()->getCollection();
        $response = $collection;
        return $response;
    }
}
