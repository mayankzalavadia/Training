<?php


namespace Training\CustomData\Api\Data;


interface CustomDataInterface
{
    /**
     * @return object|bool|string
     */
    public function getCollection():object|bool|string;

    /**
     * @param string|int $id
     * @return object|string
     */
    public function loadById($id):object|string;


}
