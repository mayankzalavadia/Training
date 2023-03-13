<?php

namespace Krish\Training\Block\Frontend;

use Krish\Training\Api\TrainingRepositoryInterfaceFactory;
use Krish\Training\Model\ResourceModel\Training\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    private CollectionFactory $collection;
    private TrainingRepositoryInterfaceFactory $trainingRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;
    private SortOrderBuilder $sortOrderBuilder;
    private FormKey $formKey;

    /**
     * @param Context $context
     * @param FormKey $formKey
     * @param CollectionFactory $collection
     * @param TrainingRepositoryInterfaceFactory $trainingRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        FormKey $formKey,
        CollectionFactory $collection,
        TrainingRepositoryInterfaceFactory $trainingRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collection = $collection;
        $this->trainingRepository = $trainingRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->formKey = $formKey;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('training/index/save', ['_secure' => true]);
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }

    /**
     * @return DataObject
     */
    public function getTrainingCollection()
    {
        return $this->collection->create()->getItems();
    }

    /**
     * @return DataObject
     */
    public function getTrainingRepositoryData()
    {
        //$sortOrder = $this->sortOrderBuilder->setField('id')->setDirection('ASC')->create();
        $searchCriteria = $this->searchCriteriaBuilder->create();
        return $this->trainingRepository->create()->getList($searchCriteria)->getItems();
    }


}
