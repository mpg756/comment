<?php
declare(strict_types=1);

namespace Valerii\Comment\Api;

/**
 * Save Comment Command.
 *
 * @api
 */
interface SaveCommentInterface
{
    /**
     * Save Comment
     *
     * @param \Valerii\Comment\Api\Data\CommentInterface $comment
     * @return int
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(\Valerii\Comment\Api\Data\CommentInterface $comment);
}
