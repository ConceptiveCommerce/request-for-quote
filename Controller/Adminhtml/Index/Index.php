<?php

namespace Conceptive\Requestquote\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Conceptive_Requestquote::requestquote_manage');
    }

    /**
     * Requestquote List action
     *
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Conceptive_Requestquote::requestquote_manage'
        )->addBreadcrumb(
            __('Requestquote'),
            __('Requestquote')
        )->addBreadcrumb(
            __('Manage Requestquote'),
            __('Manage Requestquote')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Request Quote Grid'));
        return $resultPage;
    }
}
