<?php

namespace Vendor\EntityModelRepository\Controller\Index;

use Vendor\EntityModelRepository\Api\MyEntityRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Index implements HttpGetActionInterface
{
    private JsonFactory $jsonFactory;
    private MyEntityRepositoryInterface $myEntityRepositoryInterface;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * JsonResponse constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param MyEntityRepositoryInterface $myEntityRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        JsonFactory                 $jsonFactory,
        MyEntityRepositoryInterface $myEntityRepositoryInterface,
        SearchCriteriaBuilder       $searchCriteriaBuilder
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->myEntityRepositoryInterface = $myEntityRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Execute action and return JSON response.
     */
    public function execute()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $collection = $this->myEntityRepositoryInterface->getList($searchCriteria)->getItems();
        $resultJson = $this->jsonFactory->create();
        $items = [];
        foreach ($collection as $item) {
            $items[] = $item->getData();
            if($item->getEntityId() == 3){
                $this->myEntityRepositoryInterface->delete($item);
            }
        }
        $resultJson->setData($items);
        return $resultJson;
    }
}
