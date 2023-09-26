<?php

namespace Vendor\EntityModelRepository\Controller\Index;

use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Vendor\EntityModelRepository\Api\Data\MyEntityInterfaceFactory;
use Vendor\EntityModelRepository\Api\MyEntityRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\RequestInterface;

class Delete implements HttpGetActionInterface
{
    private JsonFactory $jsonFactory;
    private MyEntityRepositoryInterface $myEntityRepositoryInterface;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private MyEntityInterfaceFactory $myEntityInterface;
    private RequestInterface $request;

    /**
     * JsonResponse constructor.
     *
     * @param JsonFactory $jsonFactory
     * @param MyEntityRepositoryInterface $myEntityRepositoryInterface
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param MyEntityInterfaceFactory $myEntityInterface
     * @param RequestInterface $request
     */
    public function __construct(
        JsonFactory                 $jsonFactory,
        MyEntityRepositoryInterface $myEntityRepositoryInterface,
        SearchCriteriaBuilder       $searchCriteriaBuilder,
        MyEntityInterfaceFactory $myEntityInterface,
        RequestInterface $request
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->myEntityRepositoryInterface = $myEntityRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->myEntityInterface = $myEntityInterface;
        $this->request = $request;
    }

    /**
     * Execute action and return JSON response.
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $id = $this->request->getParam('id');
        if ($id != ''){
        $myEntity = $this->myEntityRepositoryInterface->deleteById($id);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $collection = $this->myEntityRepositoryInterface->getList($searchCriteria)->getItems();
        $items = [];
        foreach ($collection as $item) {
            $items[] = $item->getData();
        }
        $resultJson->setData($items);
        }
        return $resultJson;
    }
}
