<?php

namespace Devhooks\HelloWorld\Controller\Adminhtml\Index;

use Devhooks\HelloWorld\Api\HelloWorldRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    private HelloWorldRepositoryInterface $helloWorldRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        HelloWorldRepositoryInterface $helloWorldRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->helloWorldRepository = $helloWorldRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        try {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model = $this->helloWorldRepository->get($id);
                if ($model->getData()) {
                    $this->helloWorldRepository->deleteById($id);
                    $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
                } else {
                    $this->messageManager->addErrorMessage(__("Something went wrong, Please try again."));
                }
            } else {
                $this->messageManager->addErrorMessage(__("Something went wrong, Please try again."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't delete record, Please try again."));
        }
        return $resultRedirectFactory->setPath('*/*/index');
    }
}
