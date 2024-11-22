<?php
declare(strict_types=1);

namespace Valerii\Comment\Model;

use Magento\Framework\Api\SearchResults;
use Valerii\Comment\Api\Data\CommentSearchResultsInterface;

class CommentSearchResults extends SearchResults implements CommentSearchResultsInterface
{
}
