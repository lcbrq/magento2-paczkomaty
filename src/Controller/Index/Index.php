<?php
namespace Flexishore\Paczkomaty\Controller\Index;

use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_paczkomatyHelper;
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Flexishore\Paczkomaty\Helper\Data $_paczkomatyHelper,
        PageFactory $resultPageFactory
    ) {
        $this->_paczkomatyHelper = $_paczkomatyHelper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $paczkomaty = $this->_paczkomatyHelper->importPaczkomaty();

        echo 321;
        die;

        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->renderLayout();
    }
}