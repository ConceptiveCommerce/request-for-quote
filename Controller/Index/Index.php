<?php

namespace Conceptive\Requestquote\Controller\Index;

use Magento\Framework\View\Result\PageFactory;


class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    
    /**
     * Default Requestquote Index page
     *
     * @return void
     */
    public function execute()
    {
         $layout = $this->_view->getLayout();
        $block = $layout->createBlock('Conceptive\Requestquote\Block\Requestquote');
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();
        $this->_view->getPage()->getConfig()->getTitle()->set(__('Site Requestquote111'));
        // $post = (array) $this->getRequest()->getPost();
        $data = $this->getRequest()->getPost();
        $model = $this->_objectManager->create('Conceptive\Requestquote\Model\Requestquote');
        //$block->setMail("Arvind Patel");
     if($data){
        $query['name'] = $data['name'];          
        $query['email'] = $data['email'];         
        $query['phoneno'] = $data['phoneno'];       
        $query['comments'] = $data['comments']; 
        $query['product_id'] = $data['product_id']; 
        $query['product_name'] = $data['product_name'];    
        $query['date'] = date('y-m-d h:i:s');       
            $model->setData($query);
            $model->Save();
                    $block->setMail($query['name'],$query['email'],$query['phoneno'],$query['comments'],$query['product_id'],$query['product_name']);
   $this->messageManager->addSuccessMessage('Request quote Form Submitted');
        
        /** @var \Magento\Framework\View\Result\Page $resultPage */
       /* $resultPage = $this->resultPageFactory->create();
        return $resultPage; **/
         $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setRefererOrBaseUrl(); 
        return $resultRedirect; 
        }
    
    }
}
