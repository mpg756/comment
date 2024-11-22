<?php
declare(strict_types=1);

namespace Valerii\Comment\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Api\DeleteCommentByIdInterface;

class Delete extends Action implements HttpPostActionInterface, HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Valerii_Comment::management_delete';

    /**
     * @param Context $context
     * @param DeleteCommentByIdInterface $deleteByIdCommand
     */
    public function __construct(
        Context $context,
        private readonly DeleteCommentByIdInterface $deleteByIdCommand
    ) {
        parent::__construct($context);
    }

    /**
     * Delete Comment action.
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var ResultInterface $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/');
        $entityId = (int)$this->getRequest()->getParam(CommentInterface::COMMENT_ID);

        try {
            $this->deleteByIdCommand->execute($entityId);
            $this->messageManager->addSuccessMessage(__('You have successfully deleted comment'));
        } catch (CouldNotDeleteException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $resultRedirect;
    }
}
