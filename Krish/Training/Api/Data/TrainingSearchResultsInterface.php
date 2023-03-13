<?php

namespace Krish\Training\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface TrainingSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get Record list.
     *
     * @return \Krish\Training\Api\Data\TrainingInterface[]
     */
    public function getItems();

    /**
     * Set Record list.
     *
     * @param \Krish\Training\Api\Data\TrainingInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}
