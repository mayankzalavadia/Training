<?php

namespace Vendor\EntityModelRepository\Controller\Index;

use Magento\Framework\App\ResourceConnection;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\DB\Adapter\AdapterInterface;

class InsertMultipleRecords implements HttpGetActionInterface
{
    private ResourceConnection $resource;
    private AdapterInterface $connection;
    private RedirectFactory $redirectFactory;

    /**
     * JsonResponse constructor.
     * @param ResourceConnection $resource
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        ResourceConnection $resource,
        RedirectFactory $redirectFactory
    )
    {
        $this->resource = $resource;
        $this->connection = $resource->getConnection();
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        $tableName = $this->resource->getTableName('vendor_custom_table');
        $data = ['first_name' => 'Developer '.rand(10,100), 'last_name' => 'Test'];
        $this->connection->insertMultiple($tableName, $data);
        return $this->redirectFactory->create()->setPath('*/*/');
    }
}
