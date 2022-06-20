<?php


namespace Training\CustomData\Api\Data;


interface CustomDataInterface
{
    /**
     * @return object|bool|string
     */
    public function getCollection():object|bool|string;

    /**
     * @param $id
     * @return array|object|bool|string
     */
    public function loadById($id):array|object|bool|string;


}
