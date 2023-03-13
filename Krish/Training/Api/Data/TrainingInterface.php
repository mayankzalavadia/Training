<?php

namespace Krish\Training\Api\Data;

interface TrainingInterface
{
    const ID = 'id';
    const FIRST_NAME = 'first_name';
    const Last_NAME = 'last_name';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    /**
     * @return mixed
     */
    public function getId(): mixed;

    /**
     * @param int $id
     * @return TrainingInterface
     */
    public function setId($id): TrainingInterface;

    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @param string $first_name
     * @return TrainingInterface
     */
    public function setFirstName($first_name): TrainingInterface;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @param string $last_name
     * @return TrainingInterface
     */
    public function setLastName($last_name): TrainingInterface;

    /**
     * @return bool
     */
    public function getStatus(): bool;

    /**
     * @param bool $status
     * @return TrainingInterface
     */
    public function setStatus($status): TrainingInterface;

    /**
     * @return mixed
     */
    public function getCreatedAt(): mixed;

    /**
     * @param string $created_at
     * @return TrainingInterface
     */
    public function setCreatedAt($created_at): TrainingInterface;


    /**
     * @return mixed
     */
    public function getUpdatedAt(): mixed;

    /**
     * @param $updated_at
     * @return TrainingInterface
     */
    public function setUpdatedAt($updated_at): TrainingInterface;

}
