<?php

namespace Helix\BugTracker\Model;

/**
 * Helix BugTracker model
 *
 * @method \Helix\BugTracker\Model\ResourceModel\Bug _getResource()
 * @method \Helix\BugTracker\Model\ResourceModel\Bug getResource()
 * @method string getId()
 * @method string getName()
 * @method string getEmail()
 * @method setSortOrder()
 * @method int getSortOrder()
 */
class Bug extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Statuses
     */
    const STATUS_PENDING = 0;
    const STATUS_PROCESSING = 1;
    const STATUS_COMPLETE = 2;

    /**
     * Helix BugTracker cache tag
     */
    const CACHE_TAG = 'helix_bugtracker';

    /**
     * @var string
     */
    protected $_cacheTag = 'helix_bugtracker';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'helix_bugtracker';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Helix\BugTracker\Model\ResourceModel\Bug');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId(), self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Prepare item's statuses
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_PENDING => __('Pending'), self::STATUS_PROCESSING => __('Processing'), self::STATUS_COMPLETE => __('Complete')];
    }

    public function getDefaultValues()
  	{
  		$values = [];
  		return $values;
  	}

}
