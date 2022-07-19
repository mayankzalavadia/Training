<?php

namespace Vendorname\Helloworld\Controller\Adminhtml\Index;

use Vendorname\Helloworld\Model\HelloworldFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Vendorname\Helloworld\Model\ImageUploader;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Cache\Manager;

/**
 * Class Save
 * @package Vendorname\Helloworld\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var HelloworldFactory
     */
    protected $helloworldFactory;

    /**
     * @var ManagerInterface
     */
    protected $_messageManager;
    /**
     * @var TypeListInterface
     */
    protected $cacheManager;

    /**
     * Save constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param HelloworldFactory $helloworldFactory
     * @param ManagerInterface $messageManager
     * @param UrlRewriteFactory $urlRewriteFactory
     * @param StoreRepositoryInterface $storeRepository
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        HelloworldFactory $helloworldFactory,
        ImageUploader $imageUploaderModel,
        ManagerInterface $messageManager,
        Manager $cacheManager
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->helloworldFactory = $helloworldFactory;
        $this->imageUploaderModel = $imageUploaderModel;
        $this->messageManager = $messageManager;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        try {
            $resultPageFactory = $this->resultRedirectFactory->create();
            $data = $this->getRequest()->getPostValue();
            $model = $this->helloworldFactory->create();
            $model->setData($data);
            $model = $this->imageData($model, $data);
            $model->save();
            $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            $buttonData = $this->getRequest()->getParam('back');
            if ($buttonData == 'edit' && $model->getId()) {
                    return $resultPageFactory->setPath('helloworld/index/form', ['id' => $model->getId()]);
            }
			if ($buttonData == 'new') {
			    return $resultPageFactory->setPath('helloworld/index/form');
			}
			if ($buttonData == 'close') {
				$this->_redirect('helloworld/index/index');
			}
		} catch (\Exception $e) {
			$this->_messageManager->addErrorMessage(__($e));
		}
        return $resultPageFactory->setPath('helloworld/index/index');
    }

    /**
     * @param $model
     * @param $data
     * @return mixed
     */
    public function imageData($model, $data)
    {
        if ($model->getId()) {
            $pageData = $this->helloworldFactory->create();
            $pageData->load($model->getId());
            if (isset($data['image_field'][0]['name'])) {
                $imageName1 = $pageData->getThumbnail();
                $imageName2 = $data['image_field'][0]['name'];
                if ($imageName1 != $imageName2) {
                    $imageUrl = $data['image_field'][0]['url'];
                    $imageName = $data['image_field'][0]['name'];
                    $data['image_field'] = $this->imageUploaderModel->saveMediaImage($imageName, $imageUrl);
                } else {
                    $data['image_field'] = $data['image_field'][0]['name'];
                }
            } else {
                $data['image_field'] = '';
            }
        } else {
            if (isset($data['image_field'][0]['name'])) {
                $imageUrl = $data['image_field'][0]['url'];
                $imageName = $data['image_field'][0]['name'];
                $data['image_field'] = $this->imageUploaderModel->saveMediaImage($imageName, $imageUrl);
            }
        }
        $model->setData($data);
        return $model;
    }
}
