<?php
/**
 *
 * Goran_ResponsibleUsers Magento 2 extension
 *
 * NOTICE OF LICENSE
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @category Goran
 * @package Goran_ResponsibleUsers
 * @copyright Copyright (c) 2022 Goran
 * @license http://www.magento.com
 * @author Goran Simeunovic
 */

namespace Goran\ResponsibleUsers\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

    /**
     * Create database table
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('goran_responsible_user_list')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('goran_responsible_user_list')
            )
                ->addColumn(
                    'user_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'User ID'
                )
                ->addColumn(
                    'firstname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Firstname'
                )
                ->addColumn(
                    'lastname',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Lastname'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addColumn(
                    'products',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'default' => 0
                    ],
                    'Products'
                )
                ->addColumn(
                    'department',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Department'
                )
                ->setComment('Responsible Users Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('goran_responsible_user_list'),
                $setup->getIdxName(
                    $installer->getTable('goran_responsible_user_list'),
                    ['firstname', 'lastname'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['firstname', 'lastname'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
