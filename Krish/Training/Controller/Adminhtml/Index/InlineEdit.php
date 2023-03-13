<?php

namespace Krish\Training\Controller\Adminhtml\Index;

use Krish\Training\Api\TrainingRepositoryInterface;
use Krish\Training\Api\Data\TrainingInterfaceFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;

class InlineEdit extends Action
{
    private TrainingInterfaceFactory $trainingFactory;
    private TrainingRepositoryInterface $trainingRepository;
    protected $jsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        TrainingInterfaceFactory $trainingFactory,
        TrainingRepositoryInterface $trainingRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->trainingFactory = $trainingFactory;
        $this->trainingRepository = $trainingRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $Id) {
                    try {
                        $model = $this->trainingFactory->create();
                        $model->setData(array_merge($model->getData(), $postItems[$Id]));
                        $this->trainingRepository->save($model);
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
