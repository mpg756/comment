<?php
declare(strict_types=1);

namespace Valerii\Comment\Api;

/**
 * Get Comment list by search criteria query.
 *
 * @api
 */
interface GetCommentListInterface
{
    /**
     * Get Comment list by search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface|null $searchCriteria
     * @return \Valerii\Comment\Api\Data\CommentSearchResultsInterface
     */
    public function execute(?\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null);
}
