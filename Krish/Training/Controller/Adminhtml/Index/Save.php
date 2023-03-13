<?php

namespace Krish\Training\Controller\Adminhtml\Index;

use Krish\Training\Api\Data\TrainingInterfaceFactory;
use Krish\Training\Api\TrainingRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{

    private TrainingInterfaceFactory $trainingInterfaceFactory;
    private TrainingRepositoryInterface $trainingRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        TrainingInterfaceFactory $trainingInterfaceFactory,
        TrainingRepositoryInterface $trainingRepository,
        Validator $formKeyValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->trainingInterfaceFactory = $trainingInterfaceFactory;
        $this->trainingRepository = $trainingRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPageFactory = $this->resultRedirectFactory->create();
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->messageManager->addErrorMessage(__("Form key is Invalidate"));
            return $resultPageFactory->setPath('*/*/index');
        }
        $data = $this->getRequest()->getPostValue();
        try {
            if ($data) {
                $model = $this->trainingInterfaceFactory->create();
                $model->setData($data);
                $this->trainingRepository->save($model);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
                $buttondata = $this->getRequest()->getParam('back');
                if ($buttondata == 'add') {
                    return $resultPageFactory->setPath('*/*/form');
                }
                if ($buttondata == 'close') {
                    return $resultPageFactory->setPath('*/*/index');
                }
                $id = $model->getId();
                return $resultPageFactory->setPath('*/*/form', ['id' => $id]);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can't submit your request, Please try again."));
        }
        return $resultPageFactory->setPath('*/*/index');
    }
}
