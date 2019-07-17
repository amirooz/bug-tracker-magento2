<?php

namespace Helix\BugTracker\Model\ResourceModel;

class Bug extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('helix_bug_tracker', 'bug_id');
    }

}
