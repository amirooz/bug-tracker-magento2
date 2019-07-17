<?php
namespace Helix\BugTracker\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
	public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
		$installer = $setup;

		$installer->startSetup();

		if(version_compare($context->getVersion(), '1.0.0', '<')) {
			if (!$installer->tableExists('helix_bug_tracker')) {
				$table = $installer->getConnection()->newTable(
					$installer->getTable('helix_bug_tracker')
				)
					->addColumn(
						'bug_id',
						\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
						null,
						[
							'identity' => true,
							'nullable' => false,
							'primary'  => true,
							'unsigned' => true,
						],
						'Bug ID'
					)
					->addColumn(
						'name',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						['nullable => false'],
						'Bug Title'
					)
					->addColumn(
						'bug_description',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						'64k',
						[],
						'Bug Description'
					)
					->addColumn(
						'operating_system',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						25,
						[],
						'Operating System'
					)
          ->addColumn(
  					'browser',
  					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
  					25,
  					[],
  					'Browser'
  				)
          ->addColumn(
  					'image',
  					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
  					255,
  					[],
  					'Screenshot'
  				)
          ->addColumn(
  					'assign_to',
  					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
  					25,
  					[],
  					'Assign To'
  				)
          ->addColumn(
  					'priority',
  					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
  					1,
  					[],
  					'Priority'
  				)
  				->addColumn(
  					'status',
  					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
  					1,
  					[],
  					'Bug Status'
  				)
  				->addColumn(
  						'created_at',
  						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
  						null,
  						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
  						'Created At'
  				)->addColumn(
  					'updated_at',
  					\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
  					null,
  					['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
  					'Updated At')
  				->setComment('Bug Tracker Table');
				$installer->getConnection()->createTable($table);

				$installer->getConnection()->addIndex(
					$installer->getTable('helix_bug_tracker'),
					$setup->getIdxName(
						$installer->getTable('helix_bug_tracker'),
						['name','bug_description','operating_system','browser','assign_to'],
						\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
					),
					['name','bug_description','operating_system','browser','assign_to'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				);
			}
		}

		$installer->endSetup();
	}
}
