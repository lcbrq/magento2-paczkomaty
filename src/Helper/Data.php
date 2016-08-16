<?php
namespace Flexishore\Paczkomaty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Flexishore\Paczkomaty\Model\PaczkomatyFactory;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_encryptor;

    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }
}