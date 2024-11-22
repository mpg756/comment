<?php
declare(strict_types=1);

namespace Valerii\Comment\Block;

use Magento\Catalog\Helper\Data;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CommentForm extends Template
{
    /**
     * @param UrlInterface $url
     * @param Context $context
     * @param Data $catalogHelper
     * @param array $data
     */
    public function __construct(
        private readonly UrlInterface $url,
        Context $context,
        private readonly Data $catalogHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * From action url
     *
     * @return string
     */
    public function getFormAction(): string
    {
        return $this->url->getDirectUrl('rest/V1/comment/save/');
    }

    /**
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getStoreId(): int
    {
        return (int)$this->_storeManager->getStore()->getId();
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return (int)$this->catalogHelper->getProduct()->getId();
    }
}
