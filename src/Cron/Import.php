<?php

namespace Flexishore\Paczkomaty\Cron;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Flexishore\Paczkomaty\Model\PaczkomatyFactory;

class Import
{

    protected $_paczkomatyFactory;

    public function __construct(
        PaczkomatyFactory $_paczkomatyFactory
    )
    {
        $this->_paczkomatyFactory = $_paczkomatyFactory;
    }

    /**
     * Import all available paczkomaty
     *
     * @return $this
     */
    public function execute()
    {
        $xml = simplexml_load_file('http://api.paczkomaty.pl/?do=listmachines_xml');

        if ($xml) {
            $counter = 0;
            foreach ($xml as $ps) {
                $data = [];
                $counter++;

                $model = $this->_paczkomatyFactory->create()->getCollection()
                    ->addFieldToFilter('name', $ps->name)->getFirstItem();

                if ($model->getId()) {
                    $data['id'] = $model->getId();
                }

                $data = [
                    'name' => (string) $ps->name,
                    'type' => (string) $ps->type,
                    'postcode' => (string) $ps->postcode,
                    'province' => (string) $ps->province,
                    'street' => (string) $ps->street,
                    'number' => (string) $ps->buildingnumber,
                    'city' => (string) $ps->town,
                    'latitude' => (string) $ps->latitude,
                    'longitude' => (string) $ps->longitude,
                    'paymentavailable' => (string) $ps->paymentavailable,
                    'status' => (string) $ps->status,
                    'partnerid' => (string) $ps->partnerid,
                    'paymenttype' => (string) $ps->paymenttype
                ];
                
                $model->setData($data);
                $model->save();
            }
        }

        return $this;
    }
}

