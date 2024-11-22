<?php
declare(strict_types=1);

namespace Valerii\Comment\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Valerii\Comment\Api\DeleteCommentByIdInterface;
use Valerii\Comment\Model\ResourceModel\Comment\CollectionFactory;

class MassDelete extends Action implements HttpPostActionInterface
{
    public const ADMIN_RESOURCE = 'Valerii_Comment::management_delete';

    /**
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param DeleteCommentByIdInterface $deleteByIdCommand
     */
    public function __construct(
        Context $context,
        private readonly Filter $filter,
        private readonly CollectionFactory $collectionFactory,
        private readonly DeleteCommentByIdInterface $deleteByIdCommand
    ) {
        parent::__construct($context);
    }
    /**
     * @inheritDoc
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $countDeleted = 0;
            foreach ($collection->getItems() as $comment) {
                $this->deleteByIdCommand->execute((int)$comment->getId());
                $countDeleted++;
            }
            if ($countDeleted) {
                $this->messageManager->addSuccessMessage(__('%1 comment(s) have been deleted', $countDeleted));
            }
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*/*/');
            return $resultRedirect;
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath('*/*/');
        }
    }
}
