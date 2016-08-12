<?php

namespace Flexishore\Paczkomaty\Setup;

use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{

    /**
     * Category setup factory
     *
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * Init
     *
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(CategorySetupFactory $categorySetupFactory)
    {
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\Catalog\Setup\CategorySetup $categorySetup */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $setup]);

        $setup->startSetup();

        //code to upgrade to 0.0.2
        if (version_compare($context->getVersion(), '0.0.2') < 0) {
            $this->addPaczkomatyTable($setup);
        }

        $setup->endSetup();
    }

    private function addPaczkomatyTable($setup)
    {
        $query = "
            CREATE TABLE `flexishore_paczkomaty` (                 
                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,    
                      `name` varchar(255) NOT NULL,             
                      `type` varchar(255) DEFAULT NULL,       
                      `postcode` varchar(6) DEFAULT NULL,            
                      `province` varchar(255) DEFAULT NULL,                  
                      `street` varchar(255) DEFAULT NULL,                                   
                      `number` varchar(255) DEFAULT NULL,
                      `city` varchar(255) DEFAULT NULL, 
                      `latitude` varchar(10) DEFAULT NULL,
                      `longitude` varchar(100) DEFAULT NULL,
                      `paymentavailable` varchar(10) DEFAULT NULL,
                      `status` varchar(100) DEFAULT NULL,
                      `partnerid` int(11) DEFAULT NULL,
                      `paymenttype` int(11) DEFAULT NULL,
                     
                      PRIMARY KEY (`id`)                                
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8
        ";
        $setup->getConnection()->query($query);


    }

}