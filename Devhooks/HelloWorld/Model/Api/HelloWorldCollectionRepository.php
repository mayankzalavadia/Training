<?php
namespace Devhooks\HelloWorld\Model\Api;
use Devhooks\HelloWorld\Model\HelloWorldFactory;
use Psr\Log\LoggerInterface;
class HelloWorldCollectionRepository
{
    protected $logger;
    private HelloWorldFactory $helloWorldFactory;

    public function __construct(
        LoggerInterface $logger,
        HelloWorldFactory $helloWorldFactory
    )
    {
        $this->logger = $logger;
        $this->helloWorldFactory = $helloWorldFactory;
    }
    /**
     * @inheritdoc
     */
    public function getRecords()
    {
        $response = ['success' => false];
        try {
            // Your Code here
            $collection = $this->helloWorldFactory->create()->getCollection();
            $response = ['success' => true, 'data' => $collection->getData()];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
            $this->logger->info($e->getMessage());
        }
        $returnArray = json_encode($response);
        return $returnArray;
    }
}
