<?php
namespace Vendorname\Helloworld\Controller\Adminhtml\Index;

use Vendorname\Helloworld\Model\HelloworldFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Delete
 * @package Vendorname\Helloworld\Controller\Adminhtml\Index
 */
class Delete extends Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var HelloworldFactory
     */
    protected $helloworldFactory;

    /**
     * Delete constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param HelloworldFactory $helloworldFactory
     */
    public function __construct(
		Context $context,
		PageFactory $resultPageFactory,
		HelloworldFactory $helloworldFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->helloworldFactory = $helloworldFactory;
		parent::__construct($context);
	}

    /**
     * @return mixed
     */
    public function execute() {
		try {
			$id = $this->getRequest()->getParam('id');
			if ($id) {
				$model = $this->helloworldFactory->create()->load($id);
				if ($model->getData()) {
					$model->delete();
					$this->messageManager->addSuccessMessage(__("Data Delete Successfully."));
				} else {
					$this->messageManager->addError(__('Id is not valid.'));
				}
			} else {
				$this->messageManager->addError(__('Something is Wrong!, Please Try again'));
			}
		} catch (\Exception $e) {
			$this->messageManager->addErrorMessage($e, __("We can\'t delete record, Please try again."));
		}
		$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
		$resultRedirect->setPath('helloworld/index/index');
		return $resultRedirect;

	}
}
