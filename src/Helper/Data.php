<?php
namespace Flexishore\Paczkomaty\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Flexishore\Paczkomaty\Model\PaczkomatyFactory;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_encryptor;
    protected $_paczkomatyFactory;

    public function __construct(
        Context $context,
        PaczkomatyFactory $_paczkomatyFactory
    )
    {
        $this->_paczkomatyFactory = $_paczkomatyFactory;
        parent::__construct($context);
    }
    
    public function importPaczkomaty()
    {
        $xml = simplexml_load_file('http://api.paczkomaty.pl/?do=listmachines_xml');

        if ($xml) {
            $counter = 0;
            foreach ($xml as $ps) {
                $formData = array();
                $counter++;

                $model = $this->_paczkomatyFactory->create()->getCollection()
                                        ->addFieldToFilter('name', $ps->name)->getFirstItem();

                if ($model->getId()) {
                    $formData['id'] = $model->getId();
                }
                $formData['name'] = $ps->name;
                $formData['type'] = $ps->type;
                $formData['postcode'] = $ps->postcode;
                $formData['province'] = $ps->province;
                $formData['street'] = $ps->street;
                $formData['buildingnumber'] = $ps->buildingnumber;
                $formData['town'] = $ps->town;
                $formData['latitude'] = $ps->latitude;
                $formData['longitude'] = $ps->longitude;
                $formData['paymentavailable'] = $ps->paymentavailable;
                $formData['status'] = $ps->status;
                $formData['partnerid'] = $ps->partnerid;
                $formData['paymenttype'] = $ps->paymenttype;

                $model->setData($formData);
                $model->save();


            }
        }
        echo 'success';
        die;
    }

}