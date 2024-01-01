<?php

namespace Conceptive\Requestquote\Block;

/**
 * Requestquote content block
 */

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;

class Requestquote extends \Magento\Framework\View\Element\Template
{
    /**
     * Requestquote collection
     *
     * @var Conceptive\Requestquote\Model\ResourceModel\Requestquote\Collection
     */
    protected $_requestquoteCollection = null;
    protected $scopeConfig;
    
    /**
     * Requestquote factory
     *
     * @var \Conceptive\Requestquote\Model\RequestquoteFactory
     */
    protected $_requestquoteCollectionFactory;
    
    /** @var \Conceptive\Requestquote\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Conceptive\Requestquote\Model\ResourceModel\Requestquote\CollectionFactory $requestquoteCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Conceptive\Requestquote\Model\ResourceModel\Requestquote\CollectionFactory $requestquoteCollectionFactory,
        \Conceptive\Requestquote\Helper\Data $dataHelper,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_requestquoteCollectionFactory = $requestquoteCollectionFactory;
        $this->_dataHelper = $dataHelper;
        $this->scopeConfig = $scopeConfig;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve requestquote collection
     *
     * @return Conceptive\Requestquote\Model\ResourceModel\Requestquote\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_requestquoteCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared requestquote collection
     *
     * @return Conceptive\Requestquote\Model\ResourceModel\Requestquote\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_requestquoteCollection)) {
            $this->_requestquoteCollection = $this->_getCollection();
            $this->_requestquoteCollection->setCurPage($this->getCurrentPage());
            $this->_requestquoteCollection->setPageSize($this->_dataHelper->getRequestquotePerPage());
            $this->_requestquoteCollection->setOrder('published_at','asc');
        }

        return $this->_requestquoteCollection;
    }
    
    /**
     * Fetch the current page for the requestquote list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Conceptive\Requestquote\Model\Requestquote $requestquoteItem
     * @return string
     */
    public function getItemUrl($requestquoteItem)
    {
        return $this->getUrl('*/*/view', array('id' => $requestquoteItem->getId()));
    }
    
    /**
     * Return URL for resized Requestquote Item image
     *
     * @param Conceptive\Requestquote\Model\Requestquote $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('requestquote_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $requestquotePerPage = $this->_dataHelper->getRequestquotePerPage();

            $pager->setAvailableLimit([$requestquotePerPage => $requestquotePerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
     public function getFormAction()
    {
            // companymodule is given in routes.xml
            // controller_name is folder name inside controller folder
            // action is php file name inside above controller_name folder
        return $this->getUrl('requestquote/index/index', ['_secure' => true]);
        // here controller_name is index, action is booking
    }

    public function setMail($name,$email,$phoneno,$comments,$product_id,$product_name)
    {
            $this->_dataHelper->sendMail($name,$email,$phoneno,$comments,$product_id,$product_name);
    }
    
    public function getConfigValue($value = '') 
    {
        return $this->scopeConfig->getValue($value, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
