<?php
declare(strict_types=1);

namespace Valerii\Comment\Model;

use Magento\Framework\Model\AbstractModel;
use Valerii\Comment\Api\Data\CommentInterface;
use Valerii\Comment\Model\ResourceModel\Comment as CommentResource;

class Comment extends AbstractModel implements CommentInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'comment_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(CommentResource::class);
    }

    /**
     * @inheirtDoc
     */
    public function getCommentId(): int
    {
        return (int)$this->getData(self::COMMENT_ID);
    }

    /**
     * @inheirtDoc
     */
    public function getProductId(): int
    {
        return (int)$this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheirtDoc
     */
    public function setProductId(int $productId): self
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheirtDoc
     */
    public function getStoreId(): int
    {
        return (int)$this->getData(self::STORE_ID);
    }

    /**
     * @inheirtDoc
     */
    public function setStoreId(int $storeId): self
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * @inheirtDoc
     */
    public function getCustomerId(): ?int
    {
        $customerId = $this->getData(self::CUSTOMER_ID) ?? null;

        return $customerId ? (int)$customerId : $customerId;
    }

    /**
     * @inheirtDoc
     */
    public function setCustomerId(?int $customerId): CommentInterface
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @inheirtDoc
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * @inheirtDoc
     */
    public function setEmail(string $email): CommentInterface
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * @inheirtDoc
     */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @inheirtDoc
     */
    public function setName(string $name): CommentInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheirtDoc
     */
    public function getMessage(): string
    {
        return (string)$this->getData(self::MESSAGE);
    }

    /**
     * @inheirtDoc
     */
    public function setMessage(string $message): CommentInterface
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * @inheirtDoc
     */
    public function getCreatedAt(): string
    {
        return (string)$this->getData(self::CREATED_AT);
    }
}
