<?php
namespace Wesam\CustomRoute\Controller\Route;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Store\Model\StoreManagerInterface;

class Index extends Action
{
    protected $resultRedirectFactory;
    protected $storeManager;

    public function __construct(
        Context $context,
        RedirectFactory $resultRedirectFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $productUrlKey = 'marco-lightweight-active-hoodie.html'; // The URL key of your product

        try {
            $store = $this->storeManager->getStore();
            $productUrl = $store->getBaseUrl() . $productUrlKey;

            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setUrl($productUrl);
            return $resultRedirect;

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while trying to redirect.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('/'); // Redirect to homepage on error
            return $resultRedirect;
        }
    }
}