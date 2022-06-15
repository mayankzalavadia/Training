<?php
/**
 * CodeLenghtValidate
 *
 * @copyright Copyright © 2022 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Training\HelloWorld\Model;


use Magento\Framework\Message\ManagerInterface as MessageManager;

class CodeLengthValidate implements CodeValidationInterface
{
    /**
     * @var MessageManager
     */
    private MessageManager $messageManager;

    /**
     * CodeLengthValidate constructor.
     * @param MessageManager $messageManager
     */
    public function __construct(MessageManager $messageManager)
    {
        $this->messageManager = $messageManager;
    }

    /**
     * @inheritDoc
     */
    public function validate($code): void
    {
        if(strlen($code) > 9){
            throw new \InvalidArgumentException('Code Must be less then 9 characters');
        }
    }
}
