<?php
declare(strict_types=1);

namespace Valerii\Comment\Command\Validator;

use Laminas\Validator\EmailAddress;
use Magento\Framework\Exception\ValidatorException;
use Valerii\Comment\Api\Data\CommentInterface;

class DataValidator
{
    private const FIELDS_TO_VALIDATE = [
        CommentInterface::EMAIL,
        CommentInterface::NAME,
        CommentInterface::MESSAGE,
        CommentInterface::STORE_ID,
        CommentInterface::PRODUCT_ID,
    ];

    /**
     * @param EmailAddress $emailValidator
     */
    public function __construct(private readonly EmailAddress $emailValidator)
    {
    }

    /**
     * @param CommentInterface $comment
     * @return void
     * @throws ValidatorException
     */
    public function validateData(CommentInterface $comment)
    {
        $errors = [];
        $fields = [];
        foreach (self::FIELDS_TO_VALIDATE as $field) {
            if (empty($comment->getData($field))) {
                $fields[] = $field;
            }
        }
        if (!empty($fields)) {
            $errors[] = __('Empty data for necessary fields: ' . implode(', ', $fields));
        }
        if (!$this->emailValidator->isValid($comment->getEmail())) {
            $errors[] = __('Email has not valid format.');
        }

        if (!empty($errors)) {
            throw new ValidatorException(__(implode("\n", $errors)));
        }
    }
}
