<?php
namespace Vendor\EntityModelRepository\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface MyEntityInterface
{
    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param $entityId
     * @return void
     */
    public function setEntityId($entityId);

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param $firstName
     * @return void
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param $lastName
     * @return void
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param $status
     * @return void
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getCreateAt();

    /**
     * @param $createAt
     * @return void
     */
    public function setCreateAt($createAt);

}
