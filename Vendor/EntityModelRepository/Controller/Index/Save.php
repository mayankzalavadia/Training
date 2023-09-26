<?php

namespace Vendor\EntityModelRepository\Controller\Index;

use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterfaceFactory;
use Vendor\EntityModelRepository\Api\MyEntityRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Save implements HttpGetActionInterface
{
    private JsonFactory $jsonFactory;
    private MyEntityRepositoryInterface $myEntityRepositoryInterface;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private MyEntityInterfaceFactory $myEntityInterface;

    /**
     * JsonResponse constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param MyEntityRepositoryInterface $myEntityRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param MyEntityInterfaceFactory $myEntityInterface
     */
    public function __construct(
        JsonFactory                 $jsonFactory,
        MyEntityRepositoryInterface $myEntityRepositoryInterface,
        SearchCriteriaBuilder       $searchCriteriaBuilder,
        MyEntityInterfaceFactory $myEntityInterface
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->myEntityRepositoryInterface = $myEntityRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->myEntityInterface = $myEntityInterface;
    }

    /**
     * Execute action and return JSON response.
     */
    public function execute()
    {
        $myEntity = $this->myEntityInterface->create();
        $myEntity->setData([
            'first_name' => 'Mayank 5',
            'last_name' => 'Zalavadia'
        ]);
        $this->myEntityRepositoryInterface->save($myEntity);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $collection = $this->myEntityRepositoryInterface->getList($searchCriteria)->getItems();
        $resultJson = $this->jsonFactory->create();
        $items = [];
        foreach ($collection as $item) {
            $items[] = $item->getData();
        }
        $resultJson->setData($items);
        return $resultJson;
    }
}
