<?php
namespace Flexishore\Paczkomaty\Model\ResourceModel\Paczkomaty;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Flexishore\Paczkomaty\Model\Paczkomaty', 'Flexishore\Paczkomaty\Model\ResourceModel\Paczkomaty');
    }
}