<?php

declare(strict_types=1);

namespace Devhooks\HelloWorld\Api\Data;

interface HelloWorldInterface
{

    const ID = 'id';
    const FNAME = 'fname';
    const LNAME = 'lname';

    const STATUS = 'status';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return HelloWorldInterface
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFname();

    /**
     * @param string $fname
     * @return HelloWorldInterface
     */
    public function setFname($fname);

    /**
     * @return string
     */
    public function getLname();

    /**
     * @param string $lname
     * @return HelloWorldInterface
     */
    public function setLname($lname);

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @param bool $status
     * @return HelloWorldInterface
     */
    public function setStatus($status);

}
