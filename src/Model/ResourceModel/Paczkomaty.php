<?php
namespace Flexishore\Paczkomaty\Model\ResourceModel;

class Paczkomaty extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('flexishore_paczkomaty', 'id');
    }
}