<?php

namespace Krish\Training\Controller\Adminhtml\Index;

use Krish\Training\Api\TrainingRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $resultPageFactory;
    protected $trainingRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        TrainingRepositoryInterface $trainingRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->trainingRepository = $trainingRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirectFactory = $this->resultRedirectFactory->create();
        try {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model = $this->trainingRepository->get($id);
                if ($model->getData()) {
                    $this->trainingRepository->deleteById($id);
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
