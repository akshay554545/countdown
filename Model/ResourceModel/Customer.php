<?php


namespace Magesture\CountDown\Model\ResourceModel;

class Customer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context)
	{
		parent::__construct($context);
	}

    protected function _construct()
    {
        $this->_init('magesture_countdown_customer', 'id');
    }
}