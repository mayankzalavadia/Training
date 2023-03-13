<?php

namespace Krish\Training\Controller\Index;

use Krish\Training\Api\Data\TrainingInterfaceFactory;
use Krish\Training\Model\TrainingRepository;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Message\ManagerInterface;

class Save implements HttpPostActionInterface
{
    private TrainingRepository $trainingRepository;
    private TrainingInterfaceFactory $interfaceFactory;
    private Context $context;
    private RequestInterface $request;
    private ManagerInterface $messageManager;
    private RedirectFactory $resultRedirectFactory;
    private Validator $formKeyValidator;

    /**
     * @param Context $context
     * @param RequestInterface $request
     * @param Validator $formKeyValidator
     * @param TrainingInterfaceFactory $interfaceFactory
     * @param TrainingRepository $trainingRepository
     * @param ManagerInterface $messageManager
     * @param RedirectFactory $resultRedirectFactory
     */
    public function __construct(
        Context $context,
        RequestInterface $request,
        Validator $formKeyValidator,
        TrainingInterfaceFactory $interfaceFactory,
        TrainingRepository $trainingRepository,
        ManagerInterface $messageManager,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->trainingRepository = $trainingRepository;
        $this->interfaceFactory = $interfaceFactory;
        $this->context = $context;
        $this->request = $request;
        $this->messageManager = $messageManager;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {

        if (!$this->request->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            if ($this->formKeyValidator->validate($this->request)) {
                $data = $this->request->getPostValue();
                $trainingModel = $this->interfaceFactory->create();
                $trainingModel->setData($data);
                $this->trainingRepository->save($trainingModel);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception, __("We can\'t submit your request, Please try again."));
        }

        /*$this->dataPersistor->set('training_form', $this->request->getParams());*/
        return $this->resultRedirectFactory->create()->setPath('*/*');
    }
}
