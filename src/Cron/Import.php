<?php

namespace Flexishore\Paczkomaty\Cron\Import;

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
                    'name' => $ps->name,
                    'type' => $ps->type,
                    'postcode' => $ps->postcode,
                    'province' => $ps->province,
                    'stree' => $ps->stree,
                    'buildingnumber' => $ps->buildingnumber,
                    'town' => $ps->town,
                    'latitude' => $ps->latitude,
                    'longitude' => $ps->longitude,
                    'paymentavailable' => $ps->paymentavailable,
                    'status' => $ps->status,
                    'partnerid' => $ps->partnerid,
                    'paymenttype' => $ps->paymenttype
                ];
                $model->setData($data);
                $model->save();
            }
        }

        return $this;
    }
}

