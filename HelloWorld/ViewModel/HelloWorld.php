<?php

namespace Training\HelloWorld\ViewModel;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Customer\Block\Account\AuthorizationLink;
use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Psr\Log\LoggerInterface;
use Training\HelloWorld\Api\SupplierRepositoryInterface;

class HelloWorld implements ArgumentInterface
{
    /**
     * @var SupplierRepositoryInterface
     */
    private SupplierRepositoryInterface $supplierRepository;
    /**
     * @var AuthorizationLink
     */
    private AuthorizationLink $authorizationLink;
    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;
    /**
     * @var UserContextInterface
     */
    private UserContextInterface $userContext;
    /**
     * @var SessionFactory
     */
    private SessionFactory $session;

    /**
     * HelloWorld constructor.
     * @param SessionFactory $session
     * @param SupplierRepositoryInterface $supplierRepository
     * @param AuthorizationLink $authorizationLink
     * @param UserContextInterface $userContext
     * @param LoggerInterface $logger
     */
    public function __construct(SessionFactory $session, SupplierRepositoryInterface $supplierRepository, AuthorizationLink $authorizationLink, UserContextInterface $userContext, LoggerInterface $logger)
    {
        $this->supplierRepository = $supplierRepository;
        $this->authorizationLink = $authorizationLink;
        $this->logger = $logger;
        $this->userContext = $userContext;
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getSupplierCode(): string
    {
        return $this->supplierRepository->createNew('Test-0012')->getSupplier();
    }

    /**
     * @param $title
     * @return string
     */
    public function getTitle($title): string
    {
        return $title;
    }

    public function isLoggedIn(): bool
    {
        return $this->authorizationLink->isLoggedIn();
    }
    
    public function getCustomerData()
    {
        if ($this->isLoggedIn()) {
            $session = $this->session->create();
            return $session->getCustomer()->getId();
        }
    }

}
