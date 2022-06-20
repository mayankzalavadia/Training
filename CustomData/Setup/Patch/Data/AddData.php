<?php

namespace Training\CustomData\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\CustomData\Model\HelloWorldFactory;

class AddData implements DataPatchInterface
{
    private $HelloWorldFactory;

    /**
     * AddData constructor.
     * @param HelloWorldFactory $HelloWorldFactory
     */
    public function __construct(
        HelloWorldFactory $HelloWorldFactory
    ) {
        $this->HelloWorldFactory = $HelloWorldFactory;
    }

    /**
     * @return AddData|void
     */
    public function apply():void
    {
        $sampleData = [
            [
                'status' => 1,
                'custom_field_one' => 'Sample Text 1 for Data 1',
                'custom_field_two' => 'Sample Text 2 for Data 1'
            ],
            [
                'status' => 1,
                'custom_field_one' => 'Sample Text 1 for Data 2',
                'custom_field_two' => 'Sample Text 2 for Data 2'
            ]
        ];
        foreach ($sampleData as $data) {
            $this->HelloWorldFactory->create()->setData($data)->save();
        }
    }

    /**
     * @return array
     */
    public static function getDependencies():array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases():array
    {
        return [];
    }

}
