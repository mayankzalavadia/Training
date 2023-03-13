<?php

namespace Krish\Training\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private PageFactory $pageFactory;

    /**
     * @param PageFactory $pageFactory
     */
    public function __construct(PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPageFactory = $this->pageFactory->create();
        $resultPageFactory->getConfig()->getTitle()->prepend(__('Krish Training Index'));
        return $resultPageFactory;
    }
}
