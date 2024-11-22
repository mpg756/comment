<?php
declare(strict_types=1);

namespace Valerii\Comment\Api;

/**
 * Delete Comment by id Command.
 *
 * @api
 */
interface DeleteCommentByIdInterface
{
    /**
     * Delete Comment
     *
     * @param int $entityId
     * @param int|null $storeId
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function execute(int $entityId, ?int $storeId = null);
}
