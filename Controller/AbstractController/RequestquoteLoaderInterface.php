<?php

namespace Conceptive\Requestquote\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface RequestquoteLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Conceptive\Requestquote\Model\Requestquote
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
