<?php
declare(strict_types=1);

namespace Valerii\Comment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Set items.
     *
     * @param \Valerii\Comment\Api\Data\CommentInterface[] $items
     *
     * @return \Valerii\Comment\Api\Data\CommentSearchResultsInterface
     */
    public function setItems(array $items);

    /**
     * Get items.
     *
     * @return \Valerii\Comment\Api\Data\CommentInterface[]
     */
    public function getItems();
}
