<?php
namespace Magesture\CountDown\Model\Adminhtml\System\Config\Source\Store;

class Group implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $eavConfig;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Store\Model\Website $websiteModel
    )
    {
        $this->_storeManager = $storeManager;
        $this->_websiteModel = $websiteModel;
    }

    public function toOptionArray()
    {
        $storeManagerDataList = $this->_storeManager->getStores();
        $options = array();
        foreach ($storeManagerDataList as $value) {
        	// echo "<pre>";print_r($value->getData());
        	$collection = $this->_websiteModel->load($value['website_id'],'website_id');
        	$websiteName = $collection->getName();
               $options[] = array(
                'value' =>  $value['store_id'],
                'label' => $value['code']." (".$websiteName .")",
            );
        }
        return $options;
    }
}