<?php
declare(strict_types=1);

namespace Valerii\Comment\Block;

use Magento\Catalog\Helper\Data;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Api\GetCommentsByProductIdInterface;

class Comment extends Template implements IdentityInterface
{
    /**
     * @param Context $context
     * @param Data $catalogHelper
     * @param GetCommentsByProductIdInterface $commentsByProductId
     * @param UrlInterface $url
     * @param array $data
     */
    public function __construct(
        Context $context,
        private readonly Data $catalogHelper,
        private readonly GetCommentsByProductIdInterface $commentsByProductId,
        private readonly UrlInterface $url,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @inheirtDoc
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTabTitle();
    }

    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $productId = $this->catalogHelper->getProduct()?->getId();
        $totalItems = null;
        if ($productId) {
            $totalItems = $this->commentsByProductId->execute((int)$productId)->getTotalCount();
        }
        $title = $totalItems
            ? __('Comments %1', '<span class="counter">' . $totalItems . '</span>')
            : __('Comments');
        $this->setTitle($title);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [CommentInterface::CACHE_TAG];
    }

    /**
     * @return string
     */
    public function getCommentsUrl(): string
    {
        $productId = $this->catalogHelper->getProduct()?->getId();

        return $this->url->getUrl('rest/V1/comment', ['product_id' => $productId]);
    }
}
