<?php

namespace Magesture\CountDown\Controller\Adminhtml\Customer;
 
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magesture\CountDown\Model\ResourceModel\Customer\CollectionFactory;
use Magesture\CountDown\Model\Customer;

 
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter.​_
     * @var Filter
     */
    protected $_filter; 
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;
    protected $customer;
 
    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
         Customer $customer
    ) {
 
        $this->_filter = $filter;
        $this->customer = $customer;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }
 
    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $recordDeleted = 0;
        foreach ($collection as $record) {
            $this->deleteItem($record);
            $recordDeleted++;
        }
        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $recordDeleted));
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/email');
    }
    public function deleteItem($record)
    {
            $this->customer->load($record->getId())->delete();
    }
}
