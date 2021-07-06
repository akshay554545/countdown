<?php


namespace Magesture\CountDown\Model;

use Magento\Framework\Model\AbstractModel;

class Customer extends AbstractModel
{
    /**
     * Define resource model
     */
    const CACHE_TAG = 'magesture_countdown_customer';

	protected $_cacheTag = 'magesture_countdown_customer';

	protected $_eventPrefix = 'magesture_countdown_customer';

    protected function _construct()
    {
        $this->_init('Magesture\CountDown\Model\ResourceModel\Customer');
    }
    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}