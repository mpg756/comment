<?php
declare(strict_types=1);

namespace Valerii\Comment\Command\Comment;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Api\DeleteCommentByIdInterface;
use Valerii\Comment\Model\Comment;
use Valerii\Comment\Model\CommentFactory;
use Valerii\Comment\Model\ResourceModel\Comment as CommentResource;

class DeleteByIdCommand implements DeleteCommentByIdInterface
{
    /**
     * @param LoggerInterface $logger
     * @param CommentFactory $commentFactory
     * @param CommentResource $resource
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CommentFactory $commentFactory,
        private readonly CommentResource $resource
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(int $entityId, ?int $storeId = null)
    {
        try {
            /** @var Comment $model */
            $model = $this->commentFactory->create();
            $this->resource->load($model, $entityId, CommentInterface::COMMENT_ID);
            if (!$model->getId()) {
                throw new NoSuchEntityException(__('Could not find comment with id: %1', $entityId));
            }
            $this->resource->delete($model);
        } catch (\Exception $e) {
            $this->logger->error(__('Could not delete comment. %1', $e->getMessage()));
            throw new CouldNotDeleteException(__('Could not delete comment.'));
        }

        return true;
    }
}
