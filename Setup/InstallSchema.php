<?php
namespace Magesture\CountDown\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
class InstallSchema implements InstallSchemaInterface {
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context){
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('magesture_countdown_customer'))        {
            $table = $installer->getConnection()
                ->newTable($installer->getTable('magesture_countdown_customer'))
                ->addColumn('id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, 10, ['identity' => true, 'nullable' =>  false, 'primary' => true, 'unsigned' => true], 'Id')
                ->addColumn('customer_email', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Customer Email')
                ->addColumn('product_id', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Product Id')
                ->addColumn('send_message', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false], 'Send Message')
                ->addColumn('send_mail', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255, ['nullable' => false, 'default' => '0', ], 'Send Mail')
                ->addColumn('created_date', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null, ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT, ], 'Created Date')
                ->setComment('Row Data Table');
            $installer->getConnection()
                ->createTable($table);
        }
        $setup->endSetup();
    }
}