<?php

/**
 * Requestquote Resource Collection
 */
namespace Conceptive\Requestquote\Model\ResourceModel\Requestquote;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Conceptive\Requestquote\Model\Requestquote', 'Conceptive\Requestquote\Model\ResourceModel\Requestquote');
    }
}
