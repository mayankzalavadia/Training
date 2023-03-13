<?php

namespace Krish\Training\Model;

use Krish\Training\Api\Data\TrainingInterface;
use Krish\Training\Model\ResourceModel\Training as TrainingResourceModel;
use Magento\Framework\Model\AbstractModel;

class Training extends AbstractModel implements TrainingInterface
{
    const CACHE_TAG = 'krish_training_record';

    protected function _construct()
    {
        return $this->_init(TrainingResourceModel::class);
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    /**
     * @inheirtDoc
     */
    public function getId(): mixed
    {
        return $this->getData(self::ID);
    }

    /**
     * @inheirtDoc
     */
    public function setId($id): TrainingInterface
    {
        return $this->setData(self::ID, $id);

    }

    /**
     * @inheirtDoc
     */
    public function getFirstName(): string
    {
        return $this->getData(self::FIRST_NAME);
    }

    /**
     * @inheirtDoc
     */
    public function setFirstName($first_name): TrainingInterface
    {
        return $this->setData(self::FIRST_NAME, $first_name);
    }

    /**
     * @inheirtDoc
     */
    public function getLastName(): string
    {
        return $this->getData(self::Last_NAME);
    }

    /**
     * @inheirtDoc
     */
    public function setLastName($last_name): TrainingInterface
    {
        return $this->setData(self::Last_NAME, $last_name);
    }

    /**
     * @inheirtDoc
     */
    public function getStatus(): bool
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheirtDoc
     */
    public function setStatus($status): TrainingInterface
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @inheirtDoc
     */
    public function getCreatedAt(): mixed
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheirtDoc
     */
    public function setCreatedAt($created_at): TrainingInterface
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * @inheirtDoc
     */
    public function getUpdatedAt(): mixed
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheirtDoc
     */
    public function setUpdatedAt($updated_at): TrainingInterface
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}
