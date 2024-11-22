<?php
declare(strict_types=1);

namespace Valerii\Comment\Api;

/**
 * Get Comments by product id Command.
 *
 * @api
 */
interface GetCommentsByProductIdInterface
{
    /**
     * Get Comments by product id
     *
     * @param int $productId
     * @param int|null $storeId
     * @param string $sortOrder
     * @return \Valerii\Comment\Api\Data\CommentSearchResultsInterface
     */
    public function execute(int $productId, ?int $storeId = null, string $sortOrder = 'DESC');
}
