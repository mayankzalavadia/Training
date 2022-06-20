<?php
/**
 * LoadByIDInterface
 *
 * @copyright Copyright © 2022 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Training\CustomData\Model\Api;

use Training\CustomData\Model\HelloWorldFactory;
use Training\CustomData\Model\ResourceModel\HelloWorld\CollectionFactory;

class LoadByIDInterface implements \Training\CustomData\Api\LoadByIDInterface
{
    private CollectionFactory $collectionFactory;
    private HelloWorldFactory $helloWorldFactory;

    /**
     * CustomDataCollection constructor.
     * @param CollectionFactory $collectionFactory
     * @param HelloWorldFactory $helloWorldFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        HelloWorldFactory $helloWorldFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->helloWorldFactory = $helloWorldFactory;
    }

    /**
     * @inheritDoc
     */
    public function getCollection(): object|bool|string
    {
        try {
            $data = $this->collectionFactory->create();
            if($data){
                $response = ['success' => true, 'message' => $data->getData()];
            }else{
                $response = ['success' => true, 'message' => 'Data Not exist.'];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return json_encode($response);
    }

    /**
     * @inheritDoc
     */
    public function loadById($id): object|string
    {
        if (!$id) {
            $response = ["code" => '301', "message" => "Please enter ID"];
        }
        try {
            $data = $this->helloWorldFactory->create()->load($id);
            if (!$id) {
                $response = ["code" => '301', "message" => "ID " . $id . " Not Found On Custom Data Table"];
            }else{
                $response = ['success' => true, 'message' => $data->getData()];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return json_encode($response);
    }
}
