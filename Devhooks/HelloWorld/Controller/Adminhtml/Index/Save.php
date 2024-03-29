<?php

namespace Devhooks\HelloWorld\Controller\Adminhtml\Index;

use Devhooks\HelloWorld\Api\Data\HelloWorldInterfaceFactory;
use Devhooks\HelloWorld\Api\HelloWorldRepositoryInterface;
use Devhooks\HelloWorld\Model\HelloWorldFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{

    private HelloWorldInterfaceFactory $helloWorldInterfaceFactory;
    private HelloWorldRepositoryInterface $helloWorldRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        HelloWorldFactory $HelloWorldFactory,
        HelloWorldInterfaceFactory $helloWorldInterfaceFactory,
        HelloWorldRepositoryInterface $helloWorldRepository,
        Validator $formKeyValidator
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->HelloWorldFactory = $HelloWorldFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->helloWorldInterfaceFactory = $helloWorldInterfaceFactory;
        $this->helloWorldRepository = $helloWorldRepository;
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
                $model = $this->helloWorldInterfaceFactory->create();
                $model->setData($data);
                $this->helloWorldRepository->save($model);
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
