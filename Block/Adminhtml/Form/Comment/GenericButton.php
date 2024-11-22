<?php
declare(strict_types=1);

namespace Valerii\Comment\Block\Adminhtml\Form\Comment;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\UrlInterface;
use Valerii\Comment\Api\Data\CommentInterface;

class GenericButton
{
    /**
     * @var UrlInterface
     */
    private UrlInterface $urlBuilder;

    /**
     * @param Context $context
     */
    public function __construct(
        private readonly Context $context
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * Get Comment entity id.
     *
     * @return int
     */
    public function getCommentId(): int
    {
        return (int)$this->context->getRequest()->getParam(CommentInterface::COMMENT_ID);
    }

    /**
     * Wrap button specific options to settings array.
     *
     * @param string $label
     * @param string $class
     * @param string $onclick
     * @param array $dataAttribute
     * @param int $sortOrder
     *
     * @return array
     */
    protected function wrapButtonSettings(
        string $label,
        string $class,
        string $onclick = '',
        array  $dataAttribute = [],
        int    $sortOrder = 0
    ): array {
        return [
            'label' => $label,
            'on_click' => $onclick,
            'data_attribute' => $dataAttribute,
            'class' => $class,
            'sort_order' => $sortOrder
        ];
    }

    /**
     * Get url.
     *
     * @param string $route
     * @param array $params
     *
     * @return string
     */
    protected function getUrl(string $route, array $params = []): string
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}
