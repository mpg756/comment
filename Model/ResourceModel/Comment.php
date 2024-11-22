<?php
declare(strict_types=1);

namespace Valerii\Comment\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Valerii\Comment\Api\Data\CommentInterface;

class Comment extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'comment_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init(CommentInterface::ENTITY, CommentInterface::COMMENT_ID);
    }
}
