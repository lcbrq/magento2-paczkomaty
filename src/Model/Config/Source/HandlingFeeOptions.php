<?php

namespace Flexishore\Paczkomaty\Model\Config\Source;

class HandlingFeeOptions implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {

        return [
            ['value' => 0, 'label' => __('Fixed')],
            ['value' => 1, 'label' => __('Percent')],
        ];
    }
}