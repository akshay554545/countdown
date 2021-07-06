<?php
namespace Magesture\CountDown\Controller\CountDown;

use Magento\Framework\Controller\ResultFactory;
use Magesture\CountDown\Model\CustomerFactory;


class Email extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        CustomerFactory $customerFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function execute()
    {          
        $customerEmail = $this->getRequest()->getParam('customer_email');
        $productId = $this->getRequest()->getParam('product_id');
        $data = (array)$this->getRequest()->getPost();
        $model = $this->customerFactory->create();
        $collection = $model->getCollection();
        $customerCollection = $collection->addFieldToFilter('customer_email',$customerEmail)->addFieldToFilter('product_id',$productId);
        $customerCollectionCount = $customerCollection->count();
        // print_r($customerCollectionCount);die;
        if(!$customerCollectionCount == 0){
            foreach($customerCollection as $item){
                $item->setCustomerEmail($customerEmail);
                $item->setProductId($productId);
                $item->setSendMessage(0);
                $item->setSend_mail(0);
                $item->save();
                $this->messageManager->addSuccessMessage(__("Product Update To Notify Successfully."));
            }
        }else{
            if ($customerEmail && $productId) {
                $model->setCustomerEmail($customerEmail);
                $model->setProductId($productId);
                $model->setSendMessage(0);
                $model->setSend_mail(0);
                $model->save();
                $this->messageManager->addSuccessMessage(__("Product Add To Notify Successfully."));
            }else{
                $this->messageManager->addErroMessage(__("Product Can't Add To Notify."));
            }
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl();
        return $resultRedirect;
    }

}
?>
