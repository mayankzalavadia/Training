<?php

namespace Devhooks\HelloWorld\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;

class HelloWorldRecords implements ResolverInterface
{
    private $HelloWorldRecords;

    public function __construct(
        \Devhooks\HelloWorld\Model\Resolver\DataProvider\HelloWorldRecords $HelloWorldRecords
    ) {
        $this->HelloWorldRecords = $HelloWorldRecords;
    }

    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $HelloWorldRecords = $this->HelloWorldRecords->getRecords();
        return $HelloWorldRecords;
    }
}
