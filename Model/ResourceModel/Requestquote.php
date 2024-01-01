<?php

namespace Conceptive\Requestquote\Model\ResourceModel;

/**
 * Requestquote Resource Model
 */
class Requestquote extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('conceptive_requestquote', 'requestquote_id');
    }
}
