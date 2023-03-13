<?php

namespace Devhooks\HelloWorld\Model\Api;

use Devhooks\HelloWorld\Model\HelloWorldRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Psr\Log\LoggerInterface;

class HelloWorldCollectionRepository
{
    protected $logger;
    private HelloWorldRepository $helloWorldRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private SortOrderBuilder $sortOrderBuilder;

    public function __construct(
        LoggerInterface       $logger,
        HelloWorldRepository  $helloWorldRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder      $sortOrderBuilder
    )
    {
        $this->logger = $logger;
        $this->helloWorldRepository = $helloWorldRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @inheritdoc
     */
    public function getRecords()
    {
        $response = ['success' => false];
        try {
            // Your Code here
            $sortOrder = $this->sortOrderBuilder->setField('id')->setDirection('ASC')->create();
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter('status', '1', 'eq')
                ->setSortOrders([$sortOrder])->create();
            $collection = $this->helloWorldRepository->getList($searchCriteria)->getItems();
            $items = [];
            foreach ($collection as $item) {
                $items [] = $item->getData();
            }
            $response = ['success' => true, 'data' => $items];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        $returnArray = json_encode($response);
        return $returnArray;
    }
}
