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
            // Get the Store URL
            $store = $this->storeManager->getStore();

            // Append the product URL key to the base URL
            $productUrl = $store->getBaseUrl() . $productUrlKey; // mag.test/marco-lightweight-active-hoodie.html

            // Create a redirect instance
            $resultRedirect = $this->resultRedirectFactory->create();

            // Set the redirect URL
            $resultRedirect->setUrl($productUrl);

            // Route to the Specified URL
            return $resultRedirect;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred while trying to redirect.'));

            // Create a redirect instance
            $resultRedirect = $this->resultRedirectFactory->create();

            // Redirect to homepage on error
            $resultRedirect->setPath('/'); 
            return $resultRedirect;
        }
    }
}