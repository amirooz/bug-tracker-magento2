<?php

namespace Helix\BugTracker\Block\Adminhtml;

class Bug extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_blockGroup = 'Helix_BugTracker';
        $this->_controller = 'adminhtml_bug';
        $this->_headerText = __('Bugs');
        $this->_addButtonLabel = __('Add New Bugs');
        parent::_construct();
    }
}
