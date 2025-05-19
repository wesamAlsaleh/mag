<?php
namespace Ali\CustomModule\Controller\Route;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class Index extends Action
{
    protected $resultRedirectFactory;

    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // Product URL key from sample data 
        $url = $this->_url->getUrl('marco-lightweight-active-hoodie.html');

        /** @var \Magento\Framework\Controller\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setUrl($url);
    }
}
