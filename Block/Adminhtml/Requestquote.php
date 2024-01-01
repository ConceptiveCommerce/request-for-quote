<?php
/**
 * Adminhtml requestquote list block
 *
 */
namespace Conceptive\Requestquote\Block\Adminhtml;

class Requestquote extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_requestquote';
        $this->_blockGroup = 'Conceptive_Requestquote';
        $this->_headerText = __('Requestquote');
        $this->_addButtonLabel = __('Add New Requestquote');
        parent::_construct();
        if ($this->_isAllowedAction('Conceptive_Requestquote::save')) {
            $this->buttonList->update('add', 'label', __('Add New Requestquote'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
