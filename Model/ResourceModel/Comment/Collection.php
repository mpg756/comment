<?php
declare(strict_types=1);

namespace Valerii\Comment\Model\ResourceModel\Comment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Valerii\Comment\Model\Comment;
use Valerii\Comment\Model\ResourceModel\Comment as CommentResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'comment_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Comment::class, CommentResource::class);
    }
}
