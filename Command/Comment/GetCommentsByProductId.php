<?php
declare(strict_types=1);

namespace Valerii\Comment\Command\Comment;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Api\GetCommentListInterface;
use Valerii\Comment\Api\GetCommentsByProductIdInterface;

class GetCommentsByProductId implements GetCommentsByProductIdInterface
{
    /**
     * @param GetCommentListInterface $getCommentList
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param StoreManagerInterface $storeManager
     * @param SortOrderBuilder $sortOrderBuilder
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly GetCommentListInterface $getCommentList,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly StoreManagerInterface $storeManager,
        private readonly SortOrderBuilder $sortOrderBuilder,
        private readonly LoggerInterface $logger
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(int $productId, ?int $storeId = null, $sortOrder = 'DESC')
    {
        if (!$storeId) {
            try {
                $storeId = $this->storeManager->getStore()->getId();
            } catch (NoSuchEntityException $e) {
                $this->logger->error(__('Can\'t get current storeId %1', $e->getMessage()));
            }
        }
        $sortOrderEntity = $this->sortOrderBuilder
            ->setField(CommentInterface::CREATED_AT)
            ->setDirection($sortOrder)
            ->create();
        $this->searchCriteriaBuilder
            ->addFilter(CommentInterface::PRODUCT_ID, $productId)
            ->addSortOrder($sortOrderEntity);
        if ($storeId) {
            $this->searchCriteriaBuilder->addFilter(CommentInterface::STORE_ID, $storeId);
        }
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->getCommentList->execute($searchCriteria);
    }
}
