<?php
namespace Vendorname\Helloworld\Ui\Component\Listing\Helloworld;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

/**
 * Class Thumbnail
 * @package Vendorname\Helloworld\Ui\Component\Listing\Helloworld
 */
class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column {

	/**
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param \Magento\Framework\UrlInterface $urlBuilder
	 * @param array $components
	 * @param array $data
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		\Magento\Framework\UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	) {
		parent::__construct($context, $uiComponentFactory, $components, $data);
		$this->urlBuilder = $urlBuilder;
	}

	/**
	 * Prepare Data Source
	 *
	 * @param array $dataSource
	 * @return array
	 */
	public function prepareDataSource(array $dataSource) {
		if (isset($dataSource['data']['items'])) {
			$fieldName = $this->getData('name');
			foreach ($dataSource['data']['items'] as &$item) {
				if ($item['image_field']) {
					$imageUrl = $this->urlBuilder->getBaseUrl().'pub/media/wysiwyg/helloworld/'. $item['image_field'];
					$item[$fieldName . '_src'] = $imageUrl;
					$item[$fieldName . '_alt'] = $item['image_field'];
					$item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
						'helloworld/index/form',
						['id' => $item['id']]);
					$item[$fieldName . '_orig_src'] = $imageUrl;
				}
			}
		}
		return $dataSource;
	}
}
