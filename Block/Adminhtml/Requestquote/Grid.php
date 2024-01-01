<?php
namespace Conceptive\Requestquote\Block\Adminhtml\Requestquote;

/**
 * Adminhtml Requestquote grid
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Conceptive\Requestquote\Model\ResourceModel\Requestquote\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var \Conceptive\Requestquote\Model\Requestquote
     */
    protected $_requestquote;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Conceptive\Requestquote\Model\Requestquote $requestquotePage
     * @param \Conceptive\Requestquote\Model\ResourceModel\Requestquote\CollectionFactory $collectionFactory
     * @param \Magento\Core\Model\PageLayout\Config\Builder $pageLayoutBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Conceptive\Requestquote\Model\Requestquote $requestquote,
        \Conceptive\Requestquote\Model\ResourceModel\Requestquote\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_requestquote = $requestquote;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('requestquoteGrid');
        $this->setDefaultSort('requestquote_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(false);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        /* @var $collection \Conceptive\Requestquote\Model\ResourceModel\Requestquote\Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn('requestquote_id', [
            'header'    => __('ID'),
            'index'     => 'requestquote_id',
        ]);
        
        $this->addColumn('name', ['header' => __('Name'), 'index' => 'name']);
        $this->addColumn('email', ['header' => __('Email'), 'index' => 'email']);
         $this->addColumn('phoneno', ['header' => __('Phone No'), 'index' => 'phoneno']);
          $this->addColumn('product_id', ['header' => __('Product Id'), 'index' => 'product_id']);
           $this->addColumn('product_name', ['header' => __('Product Name'), 'index' => 'product_name']);
        $this->addColumn('comments', ['header' => __('Comments'), 'index' => 'comments']);
         $this->addColumn('date', ['header' => __('Date'), 'index' => 'date']);
        
        
       
        
        
        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['requestquote_id' => $row->getId()]);
    }

    /**
     * Get grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/index', ['_current' => true]);
    }
}
