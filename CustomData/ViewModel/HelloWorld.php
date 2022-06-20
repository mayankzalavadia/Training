<?php

namespace Training\CustomData\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Training\CustomData\Api\Data\CustomDataInterface;

class HelloWorld implements ArgumentInterface
{
    /**
     * @var CustomDataInterface
     */
    private CustomDataInterface $customData;

    /**
     * HelloWorld constructor.
     * @param CustomDataInterface $customData
     */
    public function __construct(CustomDataInterface $customData)
    {
        $this->customData = $customData;
    }

    /**
     * @return object|array
     */
    public function getCollection(): object|array
    {
        return $this->customData->getCollection();
    }

    public function loadById($id):array|object
    {
        return $this->customData->loadById($id);

    }

}
