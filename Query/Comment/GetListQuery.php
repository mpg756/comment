<?php
declare(strict_types=1);

namespace Valerii\Comment\Query\Comment;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Valerii\Comment\Api\Data\CommentSearchResultsInterface;
use Valerii\Comment\Api\Data\CommentSearchResultsInterfaceFactory;
use Valerii\Comment\Api\GetCommentListInterface;
use Valerii\Comment\Model\ResourceModel\Comment\Collection;
use Valerii\Comment\Model\ResourceModel\Comment\CollectionFactory;

class GetListQuery implements GetCommentListInterface
{
    /**
     * @param CollectionProcessorInterface $collectionProcessor
     * @param CollectionFactory $collectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param CommentSearchResultsInterfaceFactory $searchResultFactory
     */
    public function __construct(
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly CollectionFactory $collectionFactory,
        private readonly SearchCriteriaBuilder $searchCriteriaBuilder,
        private readonly CommentSearchResultsInterfaceFactory $searchResultFactory
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(?SearchCriteriaInterface $searchCriteria = null)
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        if ($searchCriteria === null) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }
        /** @var CommentSearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
