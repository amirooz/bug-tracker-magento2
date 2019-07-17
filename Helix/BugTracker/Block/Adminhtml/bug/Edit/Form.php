<?php

namespace Helix\BugTracker\Block\Adminhtml\Bug\Edit;

/**
 * Adminhtml Helix Bug edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Magento\Cms\Model\Wysiwyg\Config
     */
    protected $_wysiwygConfig;

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Magento\Store\Model\System\Store $systemStore,
        array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('bug_form');
        $this->setTitle(__('Item Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('bug_item');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('item_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('bug_id', 'hidden', ['name' => 'bug_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'bug_description',
            'textarea',
            [
                'name' => 'bug_description',
                'label' => __('Description'),
                'title' => __('Description'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'operating_system',
            'text',
            [
                'name' => 'operating_system',
                'label' => __('Operating System'),
                'title' => __('Operating System'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'browser',
            'text',
            [
                'name' => 'browser',
                'label' => __('Browser'),
                'title' => __('Browser'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'image',
            'file',
            [
                'label' => __('Screenshot'),
                'title' => __('Screenshot'),
                'name' => 'image',
            ]
        );

        $fieldset->addField(
            'assign_to',
            'text',
            [
                'name' => 'assign_to',
                'label' => __('Assign To'),
                'title' => __('Assign To'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'priority',
            'select',
            [
                'label' => __('Priority'),
                'title' => __('Priority'),
                'name' => 'priority',
                'required' => true,
                'options' => ['0' => __('Low'), '1' => __('Medium'), '2' => __('High')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('priority', '0');
        }

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => ['0' => __('Pending'), '1' => __('Processing'), '2' => __('Complete')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('status', '0');
        }

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
