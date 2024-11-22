<?php
declare(strict_types=1);

namespace Valerii\Comment\Api\Data;

interface CommentInterface
{
    public const ENTITY = 'comment';
    public const COMMENT_ID = "comment_id";
    public const PRODUCT_ID = 'product_id';
    public const STORE_ID = 'store_id';
    public const CUSTOMER_ID = "customer_id";
    public const EMAIL = "email";
    public const NAME = "name";
    public const MESSAGE = "message";
    public const CREATED_AT = "created_at";
    public const CACHE_TAG = 'comment_block';

    /**
     * Get comment_id.
     *
     * @return int
     */
    public function getCommentId(): int;

    /**
     * Get product_id
     *
     * @return int
     */
    public function getProductId(): int;

    /**
     * Set product_id
     *
     * @param int $productId
     * @return self
     */
    public function setProductId(int $productId): self;

    /**
     * Get store_id
     *
     * @return int
     */
    public function getStoreId(): int;

    /**
     * Set store_id
     *
     * @param int $storeId
     * @return self
     */
    public function setStoreId(int $storeId): self;

    /**
     * Get customer_id.
     *
     * @return int|null
     */
    public function getCustomerId(): ?int;

    /**
     * Set customer_id.
     *
     * @param int|null $customerId
     *
     * @return CommentInterface
     */
    public function setCustomerId(?int $customerId): self;

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail(): string;

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return CommentInterface
     */
    public function setEmail(string $email): self;

    /**
     * Get name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return CommentInterface
     */
    public function setName(string $name): self;

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage(): string;

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return CommentInterface
     */
    public function setMessage(string $message): self;

    /**
     * Get created_at.
     *
     * @return string
     */
    public function getCreatedAt(): string;
}
