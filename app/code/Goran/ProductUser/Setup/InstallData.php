<?php
/**
 *
 * Goran_ProductUser Magento 2 extension
 *
 * NOTICE OF LICENSE
 *
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 *
 * @category Goran
 * @package Goran_ProductUser
 * @copyright Copyright (c) 2022 Goran
 * @license http://www.magento.com
 * @author Goran Simeunovic
 */

namespace Goran\ProductUser\Setup;

use Goran\ProductUser\Model\Attribute\Source\ResponsibleUser as Source;
use Goran\ProductUser\Model\Attribute\Backend\ResponsibleUser as Backend;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Catalog\Model\Product;

class InstallData implements InstallDataInterface
{
    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    ){
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @throws \Zend_Validate_Exception
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'responsible_user', [
                'group' => 'General',
                'type' => 'varchar',
                'label' => 'Responsible User',
                'input' => 'select',
                'source' => Source::class,
                'required' => false,
                'sort_order' => 250,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'used_in_product_listing' => true,
                'visible_on_front' => false,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => true,
            ]);

        $setup->endSetup();
    }
}
