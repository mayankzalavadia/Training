<?php

namespace Vendorname\Helloworld\Block\Adminhtml\Helloworld;

use Vendorname\Helloworld\Block\Adminhtml\Helloworld\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Class SaveButton
 * @package Vendorname\Helloworld\Block\Adminhtml\Helloworld\Edit
 */
class SaveNewButton extends GenericButton implements ButtonProviderInterface {

    /**
     * @return array
     */
    public function getButtonData() {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'helloworld_form.helloworld_form',
                                'actionName' => 'save',
                                'params' => [
                                    false,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
        ];
    }

    /**
     * @return array
     */
    protected function getOptions()
    {
        $options[] = [
            'id_hard' => 'save_and_new',
            'label' => __('Save & New'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'helloworld_form.helloworld_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'new',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $options[] = [
            'id_hard' => 'save_and_close',
            'label' => __('Save & Close'),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'helloworld_form.helloworld_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'close',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        return $options;
    }
}
