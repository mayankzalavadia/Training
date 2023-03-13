<?php

namespace Devhooks\HelloWorld\Model;

use Devhooks\HelloWorld\Api\Data\HelloWorldInterface;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld as HelloWorldResourceModel;
use Magento\Framework\Model\AbstractModel;

class HelloWorld extends AbstractModel implements HelloWorldInterface
{
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(self::ID);

    }

    /**
     * @inheritDoc
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);

    }

    /**
     * @inheritDoc
     */
    public function getFname()
    {
        return $this->getData(self::FNAME);
    }

    /**
     * @inheritDoc
     */
    public function setFname($fname)
    {
        return $this->setData(self::FNAME, $fname);
    }

    /**
     * @inheritDoc
     */
    public function getLname()
    {
        return $this->getData(self::LNAME);
    }

    /**
     * @inheritDoc
     */
    public function setLname($lname)
    {
        return $this->setData(self::LNAME, $lname);
    }

    /**
     * @inheritDoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheritDoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    protected function _construct()
    {
        $this->_init(HelloWorldResourceModel::class);
    }
}
