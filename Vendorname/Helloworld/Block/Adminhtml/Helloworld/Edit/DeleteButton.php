<?php

namespace Vendorname\Helloworld\Block\Adminhtml\Helloworld\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package Vendorname\Webinar\Block\Adminhtml\Helloworld\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface {

    /**
     * @var Context
     */
    protected $context;

    /**
     * DeleteButton constructor.
     * @param Context $context
     */
	public function __construct(
		Context $context
	) {
		$this->context = $context;
	}

    /**
     * @return array
     */
	public function getButtonData() {
		$data = [];
		$id = $this->context->getRequest()->getParam('id');
		if ($id) {
			$data = [
				'label' => __('Delete'),
				'class' => 'delete',
				'on_click' => 'deleteConfirm(\'' . __(
					'Are you sure you want to delete this?'
				) . '\', \'' . $this->getDeleteUrl() . '\')',
				'sort_order' => 20,
			];
		}
		return $data;
	}

    /**
     * @return mixed
     */
	public function getDeleteUrl() {
		$id = $this->context->getRequest()->getParam('id');
		return $this->getUrl('helloworld/index/delete', ['id' => $id]);
	}
}
