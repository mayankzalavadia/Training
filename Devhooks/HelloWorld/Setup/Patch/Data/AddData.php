<?php

namespace Devhooks\HelloWorld\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface
{
    private $HelloWorldFactory;

    public function __construct(
        \Devhooks\HelloWorld\Model\HelloWorldFactory $HelloWorldFactory
    ) {
        $this->HelloWorldFactory = $HelloWorldFactory;
    }

    public function apply()
    {
        $sampleData = [
            [
                'status' => 1,
                'fname' => 'Sample Text 1 for Data 1',
                'lname' => 'Sample Text 2 for Data 1'
            ],
            [
                'status' => 1,
                'fname' => 'Sample Text 1 for Data 2',
                'lname' => 'Sample Text 2 for Data 2'
            ]
        ];
        foreach ($sampleData as $data) {
            $this->HelloWorldFactory->create()->setData($data)->save();
        }
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

}
