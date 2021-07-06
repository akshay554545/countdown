<?php
namespace Magesture\CountDown\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
	
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			'count_down_start_from',
			[
				'type' => 'datetime',
				'backend' => '',
				'frontend' => '',
				'label' => 'Count Down Start From',
				'input' => 'date',
				'class' => '',
				'source' => '',
				'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
				'visible' => true,
				'required' => false,
				'user_defined' => false,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => 'configurable,grouped'
			]
		);
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			'count_down_end_from',
			[
				'type' => 'datetime',
				'backend' => '',
				'frontend' => '',
				'label' => 'Count Down End',
				'input' => 'date',
				'class' => '',
				'source' => '',
				'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
				'visible' => true,
				'required' => false,
				'user_defined' => false,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => 'configurable,grouped'
			]
		);
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			'featured_product_countdown',
			[
				'type' => 'int',
				'backend' => '',
				'frontend' => '',
				'label' => 'Featured Product Countdown',
				'input' => 'boolean',
				'class' => '',
				'source' => '',
				'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
				'visible' => true,
				'required' => false,
				'user_defined' => false,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => ''
			]
		);
		$eavSetup->addAttribute(
			\Magento\Catalog\Model\Product::ENTITY,
			'featured_product_countdown_release_date',
			[
				'type' => 'datetime',
				'backend' => '',
				'frontend' => '',
				'label' => 'Featured Product Release Date',
				'input' => 'date',
				'class' => '',
				'source' => '',
				'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
				'visible' => true,
				'required' => false,
				'user_defined' => false,
				'default' => '',
				'searchable' => false,
				'filterable' => false,
				'comparable' => false,
				'visible_on_front' => false,
				'used_in_product_listing' => true,
				'unique' => false,
				'apply_to' => ''
			]
		);
	}
}