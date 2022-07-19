<?php

namespace Vendorname\Helloworld\Model;

use Magento\Framework\Model\AbstractModel;
use Vendorname\Helloworld\Model\ResourceModel\Helloworld as HelloworldResourceModel;

/**
 * Class Helloworld
 * @package Vendorname\Helloworld\Model
 */
class Helloworld extends AbstractModel
{

    protected function _construct()
    {
        $this->_init(HelloworldResourceModel::class);
    }
}
