<?php

declare(strict_types=1);

namespace Training\DI\Model;

use Magento\Rule\Model\Action\AbstractAction;

class Main
{
    private array $data;
    /**
     * @var Injectable
     */
    private Injectable $injectable;
    /**
     * @var NonInjectableFactory
     */
    private NonInjectableInterfaceFactory $nonInjectableFactory;
    /**
     * @var AbstractUtils
     */
    private AbstractUtils $abstractUtils;

    /**
     * Main constructor.
     * @param NonInjectableInterfaceFactory $nonInjectableFactory
     * @param InjectableInterface $injectable
     * @param AbstractUtils $abstractUtils
     * @param array $data
     */
    public function __construct(
        NonInjectableInterfaceFactory $nonInjectableFactory,
        InjectableInterface $injectable,
        AbstractUtils $abstractUtils,
        array $data = [])
    {
        $this->data = $data;
        $this->injectable = $injectable;
        $this->nonInjectableFactory = $nonInjectableFactory;
        $this->abstractUtils = $abstractUtils;
    }

    public function getId(): string
    {
        return $this->data['id'];
    }

    /**
     * @return Injectable
     */
    public function getInjectable(): Injectable
    {
        return $this->injectable;
    }

    /**
     * @return NonInjectableFactory
     */
    public function getNonInjectable(): NonInjectable
    {
        return $this->nonInjectableFactory->create();
    }

    public function getUtils(): AbstractUtils
    {
        return $this->abstractUtils;
    }
}
