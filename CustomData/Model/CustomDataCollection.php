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
     * @inheritDoc
     */
    public function loadById($id): object|string
    {
        return $this->helloWorldFactory->create()->load($id);
    }
}
