<?php
namespace Flexishore\Paczkomaty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Flexishore\Paczkomaty\Model\ResourceModel\Paczkomaty\CollectionFactory;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_encryptor;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;
    
    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
    
    /**
     * @return
     */
    public function getPoints()
    {
       return $this->_collectionFactory->create();
    }
    
    
    
}