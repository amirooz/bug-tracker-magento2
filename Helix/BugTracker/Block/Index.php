<?php
namespace Helix\BugTracker\Block;
class Index extends \Magento\Framework\View\Element\Template
{
  protected $_bugFactory;
	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Helix\BugTracker\Model\bugFactory $bugFactory
	)
	{
		$this->_bugFactory = $bugFactory;
		parent::__construct($context);
	}
	public function getbugCollection(){
		$bug = $this->_bugFactory->create();
		return $bug->getCollection();
	}
}
