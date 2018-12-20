<?php
namespace Flexishore\Paczkomaty\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
        
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_paczkomatyHelper;
    
    protected $_resultJsonFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Flexishore\Paczkomaty\Helper\Data $_paczkomatyHelper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->_paczkomatyHelper = $_paczkomatyHelper;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $paczkomaty = $this->_paczkomatyHelper->getPoints();
        $city = $this->_request->getParam('city');
        $paczkomaty->addFieldToFilter('city', $city);
        $paczkomaty->addFieldToFilter('street', ['neq' => 'NULL']);
        
        $result = $this->_resultJsonFactory->create();
        $result->setData($paczkomaty);
        return $result;
    }

}