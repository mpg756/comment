<?php
declare(strict_types=1);

namespace Valerii\Comment\Command\Comment;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Api\Data\CommentInterfaceFactory;
use Valerii\Comment\Api\SaveCommentInterface;
use Valerii\Comment\Command\Validator\DataValidator;
use Valerii\Comment\Model\ResourceModel\Comment as CommentResource;

class SaveCommand implements SaveCommentInterface
{
    /**
     * @param LoggerInterface $logger
     * @param CommentResource $resource
     * @param CustomerRepositoryInterface $customerRepository
     * @param DataValidator $dataValidator
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly CommentResource $resource,
        private readonly CustomerRepositoryInterface $customerRepository,
        private readonly DataValidator $dataValidator
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(CommentInterface $comment)
    {
        $this->dataValidator->validateData($comment);
        try {
            $this->loadRegisteredCustomerData($comment);
            $comment->setHasDataChanges(true);

            if (!$comment->getId()) {
                $comment->isObjectNew(true);
            }
            $this->resource->save($comment);
        } catch (\Exception $e) {
            $this->logger->error(__('Could not save comment. Original message: %1', $e->getMessage()));
            throw new CouldNotSaveException(__('Could not save comment.: %1', $e->getMessage()));
        }

        return (int)$comment->getId();
    }

    /**
     * @param CommentInterface $comment
     * @return void
     */
    private function loadRegisteredCustomerData(CommentInterface $comment): void
    {
        $email = $comment->getEmail();
        try {
            $customer = $this->customerRepository->get($email);
            $comment->setName(sprintf('%s %s', $customer->getFirstname(), $customer->getLastname()));
            $comment->setCustomerId($customer->getId());
        } catch (\Exception $e) {
            // Customer not found
        }
    }
}
