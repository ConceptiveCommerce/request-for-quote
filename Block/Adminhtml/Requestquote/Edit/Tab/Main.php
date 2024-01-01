<?php
namespace Conceptive\Requestquote\Block\Adminhtml\Requestquote\Edit\Tab;

/**
 * Cms page edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /* @var $model \Magento\Cms\Model\Page */
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

        $form->setHtmlIdPrefix('requestquote_main_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Request Quote Information')]);

        if ($model->getId()) {
            $fieldset->addField('requestquote_id', 'hidden', ['name' => 'requestquote_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name'),
                'title' => __('Name'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'phoneno',
            'text',
            [
                'name' => 'phoneno',
                'label' => __('Phone No'),
                'title' => __('Phone NO'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'product_id',
            'text',
            [
                'name' => 'product_id',
                'label' => __('Product Id'),
                'title' => __('Product Id'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

           $fieldset->addField(
            'product_name',
            'text',
            [
                'name' => 'product_name',
                'label' => __('Product Name'),
                'title' => __('Product Name'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );


           $fieldset->addField(
            'comments',
            'text',
            [
                'name' => 'comments',
                'label' => __('Comment'),
                'title' => __('Comment'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
          
       
         $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $fieldset->addField('date', 'date', [
            'name'     => 'date',
            'date_format' => $dateFormat,
            'value' => date('y-m-d'),
            'label'    => __('Date'),
            'title'    => __('Date'),
            'required' => true
        ]);

        
        $this->_eventManager->dispatch('adminhtml_requestquote_edit_tab_main_prepare_form', ['form' => $form]);

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
        return __('Request Quote Information');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Request Quote Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
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
