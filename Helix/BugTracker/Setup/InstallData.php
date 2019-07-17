<?php

namespace Helix\BugTracker\Setup;

use Helix\BugTracker\Model\Bug;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	private $_bugFactory;

	public function __construct(\Helix\BugTracker\Model\BugFactory $bugFactory)
	{
		$this->_bugFactory = $bugFactory;
	}

	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$bugItems = [
  			[
          'name'             => "How to Create SQL Setup Script in Magento 2",
    			'bug_description'   => "In this article, we will find out how to install and upgrade sql script for module in Magento 2. When you install or upgrade a module, you may need to change the database structure or add some new data for current table. To do this, Magento 2 provide you some classes which you can do all of them.",
    			'operating_system'  => 'Windows',
          'browser'           => 'Chrome',
    			'status'            => 0
        ],
        [
          'name'             => "Advanced Reporting not working",
    			'bug_description'   => "Advanced Reporting is not working in Magento 2.2.4 after following set up steps and verifying that the code change in the patch reported in #21452 (comment) is present in the code base. Preconditions (*) Magento version 2.2.4 PHP 7.0.33 Steps to reproduce (*) Enable Advanced Reporting in Admin Go to System > Integrations > Magento Analytics user > Reauthorize",
    			'operating_system'  => 'Windows',
          'browser'           => 'Firefox',
    			'status'            => 0
        ],
        [
          'name'             => "Custom UI component conditions can't add category",
    			'bug_description'   => "When i Implements custom UI component conditions can't add category from category tree js error.Uncaught TypeError: Cannot read property 'updateElement' of undefined Preconditions (*) magento 2.3.1 Create custom module with ui component admin page.",
    			'operating_system'  => 'Linux',
          'browser'           => 'Chrome',
    			'status'            => 0
        ],
        [
          'name'             => "Paypal buttons disable issue - Magento 2.3.2",
    			'bug_description'   => "Preconditions (*) 2.3.2 Fix implemented from 2.3-develop (#22260) Steps to reproduce (*) Fix implemented from 2.3-develop (#22260) Expected result (*) Hide Paypal Smart buttons on product page Actual result (*) Hide Paypal Smart buttons on product page works as expected Side effect - removes any ability to alter the look of the Paypal Smart Buttons.",
    			'operating_system'  => 'Unix',
          'browser'           => 'Safari',
    			'status'            => 0
        ],
        [
          'name'             => "Downloadable products showing out-of-stock in front end",
    			'bug_description'   => "Magento version 2.3.2 Downloadable products showing out-of-stock in front end and in-stock in back end. i have tried my best, cleared cache, reindex, etc.. but no luck. i have added download file, manage stock is 1000. its showing in-stock in back end.",
    			'operating_system'  => 'Windows',
          'browser'           => 'Opera',
    			'status'            => 0
        ]
		];

    foreach ($bugItems as $data) {
        $this->createBug()->setData($data)->save();
    }

    $setup->endSetup();

	}

  /**
     * Create Bug items
     *
     * @return Bug
     */
    public function createBug()
    {
        return $this->_bugFactory->create();
    }

}
