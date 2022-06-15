<?php
/**
 * SupplierRepository
 *
 * @copyright Copyright © 2022 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Training\HelloWorld\Model;


use Training\HelloWorld\Api\Data\SupplierInterface;
use Training\HelloWorld\Api\Data\SupplierInterfaceFactory;
use Training\HelloWorld\Api\SupplierRepositoryInterface;

class SupplierRepository implements SupplierRepositoryInterface
{
    /**
     * @var SupplierInterfaceFactory
     */
    private SupplierInterfaceFactory $supplierFactory;
    /**
     * @var CodeValidationInterface
     */
    private CodeValidationInterface $codeValidation;

    /**
     * SupplierRepository constructor.
     * @param SupplierInterfaceFactory $supplierFactory
     * @param CodeValidationInterface $codeValidation
     */
    public function __construct(SupplierInterfaceFactory $supplierFactory, CodeValidationInterface $codeValidation)
    {
        $this->supplierFactory = $supplierFactory;
        $this->codeValidation = $codeValidation;
    }

    /**
     * @inheritDoc
     */
    public function createNew(string $code): SupplierInterface
    {
        $this->codeValidation->validate($code);
        $supplier = $this->supplierFactory->create();
        $supplier->setSupplier($code);
        return $supplier;
    }
}
