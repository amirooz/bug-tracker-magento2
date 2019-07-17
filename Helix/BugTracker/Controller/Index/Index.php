<?php
namespace Helix\BugTracker\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_bugFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Helix\BugTracker\Model\BugFactory $bugFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_bugFactory = $bugFactory;
		return parent::__construct($context);
	}
	public function execute()
	{
		return $this->_pageFactory->create();
	}
}
