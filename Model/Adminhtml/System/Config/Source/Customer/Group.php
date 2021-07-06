<?php
namespace Magesture\CountDown\Model\Adminhtml\System\Config\Source\Customer;

class Group implements \Magento\Framework\Option\ArrayInterface
{
    public function __construct(\Magento\Customer\Model\ResourceModel\Group\CollectionFactory $groupCollectionFactory)
    {
        $this->_groupCollectionFactory = $groupCollectionFactory;
    }
    public function toOptionArray()
    {
		$groupOptions = $this->_groupCollectionFactory->create()->toOptionArray();
		return $groupOptions; 
    }
}