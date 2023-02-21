<?php

declare(strict_types=1);

namespace Devhooks\HelloWorld\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface HelloWorldSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Offers list.
     *
     * @return HelloWorldInterface[]
     */
    public function getItems();

    /**
     * Set sku list.
     *
     * @param HelloWorldInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

