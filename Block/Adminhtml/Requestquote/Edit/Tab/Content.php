<?php
namespace Conceptive\Requestquote\Block\Adminhtml\Requestquote\Edit\Tab;

/**
 * requestquote edit form main tab
 */
class Content extends \Magento\Backend\Block\Widget\Form\Generic implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var $model Conceptive\RequestquoteModel\Requestquote */
        $model = $this->_coreRegistry->registry('requestquote');

        /*
         * Checking if user have permissions to save information
         */
        if ($this->_isAllowedAction('Conceptive_Requestquote::save')) {
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('requestquote_content_');

        $fieldset = $form->addFieldset(
            'content_fieldset',
            ['legend' => __('Content'), 'class' => 'fieldset-wide']
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $contentField = $fieldset->addField(
            'content',
            'editor',
            [
                'name' => 'content',
                'style' => 'height:36em;',
                'required' => true,
                'disabled' => $isElementDisabled,
                'config' => $wysiwygConfig
            ]
        );

        // Setting custom renderer for content field to remove label column
        $renderer = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Form\Renderer\Fieldset\Element'
        )->setTemplate(
            'Magento_Cms::page/edit/form/renderer/content.phtml'
        );
        $contentField->setRenderer($renderer);

        $this->_eventManager->dispatch('adminhtml_requestquote_edit_tab_content_prepare_form', ['form' => $form]);
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Content');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Content');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
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
