<?php

/**
 * Requestquote data helper
 */
namespace Conceptive\Requestquote\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\Area;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\MailException;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    
     const EMAIL_TEMPLATE = 'requestquote/view/email_template';

    const EMAIL_SERVICE_ENABLE = 'requestquote/view/enabled';

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $filesystem;  
    
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    
    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param StoreManagerInterface $storeManager
     * @param TransportBuilder $transportBuilder
     * @param StateInterface $inlineTranslation
     * @param LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\File\Size $fileSize,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        LoggerInterface $logger
    ) {
        $this->_scopeConfig = $scopeConfig;
        $this->filesystem = $filesystem;
       $this->_storeManager = $storeManager;      
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->logger = $logger;
        parent::__construct($context);
    }
     /**
     * Send Mail
     *
     * @return $this
     *
     * @throws LocalizedException
     * @throws MailException
     */
    public function sendMail($name,$email,$phoneno,$comments,$product_id,$product_name)
    {
        $emailsend = 'usla27@gmail.com'; //set receiver mail

       // $this->inlineTranslation->suspend();
        $storeId = $this->getStoreId();

        /* email template */
        $template = $this->scopeConfig->getValue(
            'requestquote/view/email_template',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );


        // set from email
        $sender = $this->scopeConfig->getValue(
            'requestquote/view/sender',
            ScopeInterface::SCOPE_STORE,
            $this->getStoreId()
        );

        $transport = $this->transportBuilder->setTemplateIdentifier("requestquote_view_template")->setTemplateOptions(
            [
                'area' => Area::AREA_FRONTEND,
                'store' => $this->getStoreId()
            ]
        )->setTemplateVars(([
                    'name'  => $name,
                    'email'  => $email,
                    'phoneno'  => $phoneno,
                    'comments'  => $comments,
                    'product_id'  => $product_id,
                    'product_name'  => $product_name
                ]))->setFromByScope(
            $sender
        )->addTo(
            $emailsend
        )->getTransport();

        try {
            $transport->sendMessage();
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
        $this->inlineTranslation->resume();

        return $this;
    }

        /*
     * get Current store id
     */
    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    /*
     * get Current store Info
     */
    public function getStore()
    {
        return $this->_storeManager->getStore();
    }
   
    
    /**
     * Return the base media directory for Requestquote Item images
     *
     * @return string
     */
    public function getBaseDir()
    {
        $path = $this->filesystem->getDirectoryRead(
            DirectoryList::MEDIA
        )->getAbsolutePath(self::MEDIA_PATH);
        return $path;
    }
    
    /**
     * Return the Base URL for Requestquote Item images
     *
     * @return string
     */
    public function getBaseUrl()
    { 
        return $this->_storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ) . '/' . self::MEDIA_PATH;
    }
    
    /**
     * Return the number of items per page
     * @return int
     */
    public function getRequestquotePerPage()
    {
        return abs((int)$this->_scopeConfig->getValue(self::XML_PATH_ITEMS_PER_PAGE, \Magento\Store\Model\ScopeInterface::SCOPE_STORE));
    }
}
