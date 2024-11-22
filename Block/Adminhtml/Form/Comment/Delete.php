<?php
declare(strict_types=1);

namespace Valerii\Comment\Block\Adminhtml\Form\Comment;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Valerii\Comment\Api\Data\CommentInterface;

class Delete extends GenericButton implements ButtonProviderInterface
{
    /**
     * Retrieve Delete button settings.
     *
     * @return array
     */
    public function getButtonData(): array
    {
        if (!$this->getCommentId()) {
            return [];
        }

        return $this->wrapButtonSettings(
            __('Delete')->getText(),
            'delete',
            sprintf("deleteConfirm('%s', '%s')",
                __('Are you sure you want to delete this comment?'),
                $this->getUrl(
                    '*/*/delete',
                    [CommentInterface::COMMENT_ID => $this->getCommentId()]
                )
            ),
            [],
            20
        );
    }
}
