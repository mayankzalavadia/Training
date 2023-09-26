<?php

namespace Vendor\EntityModelRepository\Api\Data;


use Magento\Framework\Data\SearchResultInterface;

interface MyEntitySearchResultInterface extends SearchResultInterface
{
    /**
     * @return \Vendor\EntityModelRepository\Api\Data\MyEntityInterface[]
     */
    public function getItems();

    /**
     * @param \Vendor\EntityModelRepository\Api\Data\MyEntityInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
