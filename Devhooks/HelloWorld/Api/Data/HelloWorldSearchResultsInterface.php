<?php

namespace Devhooks\HelloWorld\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface HelloWorldSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Record list.
     *
     * @return HelloWorldInterface[]
     */
    public function getItems();

    /**
     * Set Record list.
     *
     * @param HelloWorldInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

