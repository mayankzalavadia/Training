<?php
namespace Devhooks\HelloWorld\Block;

use Devhooks\HelloWorld\Model\HelloWorldFactory;
use Devhooks\HelloWorld\Model\HelloWorld as HelloWorldCollection;
use Devhooks\HelloWorld\Model\ResourceModel\HelloWorld\Collection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class HelloWorld extends Template
{

    private HelloWorldFactory $helloWorldFactory;
    private HelloWorldCollection $helloWorld;
    private Collection $helloworldCollection;

    public function __construct(Context $context,
                                HelloWorldFactory $helloWorldFactory,
                                HelloWorldCollection $helloWorld,
                                Collection $helloworldCollection,
                                array $data = [])
    {
        $this->helloWorldFactory = $helloWorldFactory;
        $this->helloWorld = $helloWorld;
        parent::__construct($context, $data);
        $this->helloworldCollection = $helloworldCollection;
    }

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function getSampleText()
    {
        return 'Hello World';
    }

    public function getModelFactoryCollection()
    {
        $collection = $this->helloWorldFactory->create()->getCollection()->setPageSize(3);
        return $collection;
    }

    public function getModelCollection()
    {
        $collection = $this->helloWorld->getCollection();
        return $collection;
    }

    public function getRecordbyID($id)
    {
        $collection = $this->helloWorldFactory->create()->load($id);;
        return $collection;
    }

    public function getRecourceCollection(){
        return $this->helloworldCollection;
    }

    public function getResourceCollectionFilter($id){
        return $this->helloworldCollection->addFieldToFilter('id', $id)->getFirstItem();;
    }

}
