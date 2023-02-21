<?php

declare(strict_types=1);

namespace Devhooks\HelloWorld\Api\Data;

use Magento\Tests\NamingConvention\true\bool;

interface HelloWorldInterface
{

    const ID = 'id';
    const FNAME = 'fname';
    const LNAME = 'lname';
    const STATUS = 'status';

    /**
     * @return int
     */
    public function getId():int;

    /**
     * @param int $id
     * @return HelloWorldInterface
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getFname():string;

    /**
     * @param string $fname
     * @return HelloWorldInterface
     */
    public function setFname($fname);

    /**
     * @return string
     */
    public function getLname():string;

    /**
     * @param string $lname
     * @return HelloWorldInterface
     */
    public function setLname($lname);

    /**
     * @return bool
     */
    public function getStatus():bool;

    /**
     * @param bool $status
     * @return HelloWorldInterface
     */
    public function setStatus($status);

}
