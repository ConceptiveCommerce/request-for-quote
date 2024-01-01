<?php

namespace Conceptive\Requestquote\Model;

/**
 * Requestquote Model
 *
 * @method \Conceptive\Requestquote\Model\Resource\Page _getResource()
 * @method \Conceptive\Requestquote\Model\Resource\Page getResource()
 */
class Requestquote extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Conceptive\Requestquote\Model\ResourceModel\Requestquote');
    }

}
