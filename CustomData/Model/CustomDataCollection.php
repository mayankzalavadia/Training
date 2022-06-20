<?php

namespace Training\CustomData\Model;

use Training\CustomData\Api\Data\CustomDataInterface;
use Training\CustomData\Model\ResourceModel\HelloWorld\CollectionFactory;

class CustomDataCollection implements CustomDataInterface
{


    /**
     * CustomDataCollection constructor.
     * @param CollectionFactory $collectionFactory
     * @param HelloWorldFactory $helloWorldFactory
     */
    public function __construct(
        private CollectionFactory $collectionFactory,
        private HelloWorldFactory $helloWorldFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getCollection(): object
    {
        return $this->collectionFactory->create();
    }

    /**
     * @param $id
     * @return array|object
     */
    public function loadById($id): array|object
    {
        return $this->helloWorldFactory->create()->load($id);
    }
}
