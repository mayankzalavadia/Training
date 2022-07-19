<?php
namespace Vendorname\Helloworld\Model;

use Vendorname\Helloworld\Model\ResourceModel\Helloworld\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 * @package Vendorname\Helloworld\Model
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

    /**
     * @var $loadedData
     */
    protected $loadedData;

    /**
     * @var $collection
     */
	protected $collection;


    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
	public function __construct(
		$name,
		$primaryFieldName,
		$requestFieldName,
		CollectionFactory $collectionFactory,
		StoreManagerInterface $storeManager,
		array $meta = [],
		array $data = []
	) {
		$this->collection = $collectionFactory->create();
		$this->storeManager = $storeManager;
		parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
	}

    /**
     * @return mixed
     */
    public function getData() {
		$items = $this->collection->getItems();
		foreach ($items as $model) {
			$this->loadedData[$model->getId()] = $model->getData();
			if ($model->getImageField()) {
				$m['image_field'][0]['name'] = $model->getImageField();
				$m['image_field'][0]['url'] = $this->getMediaUrl($model->getImageField());
				$fullData = $this->loadedData;
				$this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
			}
		}
		return $this->loadedData;
	}
	public function getMediaUrl($path = '')
    {
        $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'wysiwyg/helloworld/' . $path;
        return $mediaUrl;
    }
}
