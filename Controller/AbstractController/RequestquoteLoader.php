<?php

namespace Conceptive\Requestquote\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class RequestquoteLoader implements RequestquoteLoaderInterface
{
    /**
     * @var \Conceptive\Requestquote\Model\RequestquoteFactory
     */
    protected $requestquoteFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Conceptive\Requestquote\Model\RequestquoteFactory $requestquoteFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Conceptive\Requestquote\Model\RequestquoteFactory $requestquoteFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->requestquoteFactory = $requestquoteFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $requestquote = $this->requestquoteFactory->create()->load($id);
        $this->registry->register('current_requestquote', $requestquote);
        return true;
    }
}
