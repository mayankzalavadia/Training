<?php

namespace Devhooks\HelloWorld\Model\Resolver\DataProvider;

class HelloWorldRecords
{
    private $HelloWorldFactory;

    public function __construct(
        \Devhooks\HelloWorld\Model\HelloWorldFactory $HelloWorldFactory
    ) {
        $this->HelloWorldFactory = $HelloWorldFactory;
    }

    public function getRecords()
    {
        try {
            $collection = $this->HelloWorldFactory->create()->getCollection();
            $Records = $collection->getData();

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }
        return $Records;
    }
}
