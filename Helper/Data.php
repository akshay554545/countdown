<?php
namespace Magesture\CountDown\Helper;

use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_COUNTDOWN = 'countdown/';
    /**
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $backendUrl;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    protected $storeManager;

    /**
     * @param \Magento\Framework\App\Helper\Context   $context
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        parent::__construct($context);
        $this->backendUrl = $backendUrl;
        $this->storeManager = $storeManager;
    }
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeId);
    }
    // product list
    public function getProductListShow($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_list/' . 'product_list_page_show', $storeId);
    }
    public function getProductListSaleStartLabel($storeId = null)
    {
      
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_list/' . 'product_list_page_show_label_start', $storeId);
    }
    public function getProductListSaleEndLabel($storeId = null)
    {
      
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_list/' . 'product_list_page_show_label_end', $storeId);
    }
    // product view
    public function getProductViewShow($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_view/' . 'product_view_page_show', $storeId);
    }
    public function getProductViewSaleStartLabel($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_view/' . 'product_view_page_show_label_start', $storeId);
    }
    public function getProductViewSaleEndLabel($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_view/' . 'product_view_page_show_label_end', $storeId);
    }
    // cross upsell view
    public function getProductUpCrossShow($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_upsell_related/' . 'product_upsell_related_page_show', $storeId);
    }
     public function getProductUpCrossSaleStartLabel($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_upsell_related/' . 'product_upsell_related_show_label_start', $storeId);
    }
    public function getProductUpCrossSaleEndLabel($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'product_upsell_related/' . 'product_upsell_related_page_show_label_end', $storeId);
    }
    public function getCustomerGroup($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'customer_group/' . 'customer_group', $storeId);
    }
     public function getStoreGroup($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'store_group/' . 'store_group', $storeId);
    }
    public function getNotifyAddToCrat($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'notify_add_to_crat/' . 'notify_add_to_crat', $storeId);
    }
    public function getNotifyButtonLabel($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_COUNTDOWN . 'notify_add_to_crat/' . 'notify_add_to_crat_button', $storeId);
    }
}