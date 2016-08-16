<?php
namespace Flexishore\Paczkomaty\Block\Checkout\Shipping;

use Flexishore\Paczkomaty\Model\PaczkomatyFactory;

class AdditionalBlock extends \Magento\Framework\View\Element\Template
{
    protected $_paczkomatyFactory;

    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,

        PaczkomatyFactory $_paczkomatyFactory,

        array $data = []
    ) {
        $this->_paczkomatyFactory = $_paczkomatyFactory;
        
        parent::__construct($context, $data);
    }

    public function getPaczkomaty()
    {

        $collection = $this->_paczkomatyFactory->create()->getCollection();

        return $collection;
    }
}
