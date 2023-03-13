<?php

namespace Krish\Training\Controller\Adminhtml\Index;

use Krish\Training\Api\TrainingRepositoryInterface;
use Krish\Training\Model\ResourceModel\Training\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected $_coreRegistry = null;
    protected $resultPageFactory;
    protected CollectionFactory $trainingCollectionFactory;
    private TrainingRepositoryInterface $helloWorldRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        Filter $filter,
        CollectionFactory $trainingCollectionFactory,
        TrainingRepositoryInterface $helloWorldRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->trainingCollectionFactory = $trainingCollectionFactory;
        $this->filter = $filter;
        $this->helloWorldRepository = $helloWorldRepository;
        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->trainingCollectionFactory->create());
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
