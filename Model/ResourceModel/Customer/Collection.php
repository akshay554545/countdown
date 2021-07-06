<?php

namespace Magesture\CountDown\Model\ResourceModel\Customer;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'magesture_countdown_customer_collection';
    protected $_eventObject = 'customer_collection';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Magesture\CountDown\Model\Customer',
            'Magesture\CountDown\Model\ResourceModel\Customer'
        );
    }
}