<?php

namespace Vendorname\Helloworld\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Form extends Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
	public function __construct(
		Context $context,
		PageFactory $resultPageFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

    /**
     * @return \Magento\Framework\View\Result\Page
     */
	public function execute() {
		$resultPage = $this->resultPageFactory->create();
        if($this->getRequest()->getParam('id')) {
    		$resultPage->getConfig()->getTitle()->prepend(__('Edit Helloworld'));
        }else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add Helloworld'));
        }
		return $resultPage;
	}
}
