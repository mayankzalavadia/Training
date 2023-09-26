<?php
namespace Vendor\EntityModelRepository\Model;

use Vendor\EntityModelRepository\Api\Data\MyEntityInterface;
use Magento\Framework\Model\AbstractModel;

class MyEntityModel extends AbstractModel implements MyEntityInterface
{
    const ENTITY_ID = 'entity_id';
    const FIRST_NAME = 'first_name';
    const LAST_NAME = 'last_name';
    const STATUS = 'status';
    const CREATE_AT = 'create_at';

    protected function _construct()
    {
        $this->_init(ResourceModel\MyEntityResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getFirstName()
    {
         return $this->_getData(self::FIRST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setFirstName($firstName)
    {
        $this->setData(self::FIRST_NAME, $firstName);
    }

    /**
     * @inheritDoc
     */
    public function getLastName()
    {
         return $this->_getData(self::LAST_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setLastName($lastName)
    {
         $this->setData(self::LAST_NAME, $lastName);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
         return $this->_getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * @inheritDoc
     */
    public function getCreateAt()
    {
        return $this->_getData(self::CREATE_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreateAt($createAt)
    {
        $this->setData(self::CREATE_AT, $createAt);
    }
}
