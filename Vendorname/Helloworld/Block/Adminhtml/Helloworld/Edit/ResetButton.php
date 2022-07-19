<?php

namespace Vendorname\Helloworld\Block\Adminhtml\Helloworld\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class ResetButton
 * @package Vendorname\Helloworld\Block\Adminhtml\Helloworld\Edit
 */
class ResetButton implements ButtonProviderInterface {

    /**
     * @return array
     */
    public function getButtonData() {
		return [
			'label' => __('Reset'),
			'class' => 'reset',
			'on_click' => 'location.reload();',
			'sort_order' => 30,
		];
	}
}
