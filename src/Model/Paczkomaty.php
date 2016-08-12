<?php
namespace Flexishore\Paczkomaty\Model;
use Magento\Framework\Exception\LocalizedException as CoreException;
class Paczkomaty extends \Magento\Framework\Model\AbstractModel
{

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Flexishore\Paczkomaty\Model\ResourceModel\Paczkomaty');
    }
}