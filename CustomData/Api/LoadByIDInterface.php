<?php


namespace Training\CustomData\Api;


interface LoadByIDInterface
{
    /**
     * @return object|bool|string
     */
    public function getCollection():object|bool|string;

    /**
     * @param string $id
     * @return object|string
     */
    public function loadById($id):object|string;

}
