<?php

namespace Conceptive\Requestquote\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Conceptive\Requestquote\Controller\AbstractController\RequestquoteLoaderInterface
     */
    protected $requestquoteLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, RequestquoteLoaderInterface $requestquoteLoader, PageFactory $resultPageFactory)
    {
        $this->requestquoteLoader = $requestquoteLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Requestquote view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->requestquoteLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
