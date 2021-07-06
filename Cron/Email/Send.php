<?php

namespace Magesture\CountDown\Cron\Email;

use Magento\Contact\Controller\Index\Post as EmailData;
use Zend\Log\Filter\Timestamp;
use Magento\Store\Model\StoreManagerInterface;
use Magesture\CountDown\Model\CustomerFactory;

class Send
{
  protected $_inlineTranslation;
  protected $_transportBuilder;
  protected $storeManager;
  protected $_productRepository;

  public function __construct(
      \Magento\Framework\Controller\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
         CustomerFactory $customerFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository
  ) {
      $this->resultRedirectFactory = $resultRedirectFactory;
      $this->_inlineTranslation = $inlineTranslation;
      $this->_transportBuilder = $transportBuilder;
      $this->storeManager = $storeManager;
      $this->customerFactory = $customerFactory;
      $this->_productRepository = $productRepository;
  }
  
  public function execute()
  {    
    $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/emailFire.log');
    $logger = new \Zend\Log\Logger();
    $logger->addWriter($writer);
    $this->_inlineTranslation->suspend();
    $emailtemplate = "notify_customer_email";
    $model = $this->customerFactory->create();
    $collection = $model->getCollection();
    $customerCollection = $collection->addFieldToFilter('send_mail',0);
    $productId = [];
    foreach ($customerCollection as  $customerCollectionvalue) {
        $productId[] = $customerCollectionvalue->getproductId();
    }
    $productId = array_unique($productId);
    foreach ($productId as  $pId) {
      $productReleaseDate = $this->_productRepository->getById($pId)->getfeatured_product_countdown_release_date();
      $productName = $this->_productRepository->getById($pId)->getName();
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $objDate = $objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
      $currentDate = $objDate->gmtDate();
      $newDate = date("Y-m-d H:i:s",strtotime($currentDate." +1 minutes"));
      if($productReleaseDate){
        $productReleaseDate = $productReleaseDate;
      }else{
        $productReleaseDate = "0000-00-00 00:00:00";
      }
      if(($productReleaseDate >= $currentDate) && ($productReleaseDate <= $newDate)){
          $sendMailproductId = $pId;
          $customerModel = $this->customerFactory->create();
          $customerCollection = $customerModel->getCollection();
          $customerSendMailcustomerIdCollection = $customerCollection->addFieldToFilter('product_id',$sendMailproductId);
          foreach ($customerSendMailcustomerIdCollection as  $value) {
            $customerSendEmail = $value->getcustomer_email();
            $customerSendId = $value->getId();
            $templateId = 'notify_customer_email'; // template id
            $fromSenderEmail = 'info@gmail.com';  // sender Email id
            $fromEmail = ['email' => $fromSenderEmail,'name' => 'support'];
            $toEmail = $value->getcustomer_email(); // receiver email id
            $templateVars = [
              'productName' => $productName,
              'customerEmail' => $customerSendEmail
            ];
            $storeId = $this->storeManager->getStore()->getId();
            $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
            $templateOptions = [
              'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
              'store' => $storeId
            ];
            try{
              $transport = $this->_transportBuilder->setTemplateIdentifier($templateId, $storeScope)
                ->setTemplateOptions($templateOptions)
                ->setTemplateVars($templateVars)
                ->setFrom($fromEmail)
                ->addTo($toEmail)
                ->getTransport();
              $transport->sendMessage();
              $value->setSend_mail(1);
              $value->setSendMessage("Mail Send Successfully!");
              $value->save();
              $logger->info("Mail Send Succesfully!");
              $this->_inlineTranslation->resume();
            }
            catch(Exception $e){
              $logger->info("Mail Not Send Successfully!");
              $this->_inlineTranslation->resume();
              $value->setSend_mail(0);
              $value->setSendMessage($e->getMessage());
              $value->save();
            }
        }
      }
    }
  return true;
  }
}