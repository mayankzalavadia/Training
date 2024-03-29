<?php

namespace Devhooks\HelloWorld\Controller\Adminhtml\Index;

use Devhooks\HelloWorld\Api\HelloWorldRepositoryInterface;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected $_coreRegistry = null;
    protected $resultPageFactory;
    protected $HelloWorldFactory;
    private HelloWorldRepositoryInterface $helloWorldRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Filter $filter,
        CollectionFactory $HelloWorld,
        HelloWorldRepositoryInterface $helloWorldRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->HelloWorldFactory = $HelloWorld;
        $this->filter = $filter;
        $this->helloWorldRepository = $helloWorldRepository;
        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->HelloWorldFactory->create());
        $count = 0;
        foreach ($collection as $child) {
            $this->helloWorldRepository->deleteById($child->getID());
            $count++;
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $count));
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }
}
