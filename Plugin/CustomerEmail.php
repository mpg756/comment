<?php
declare(strict_types=1);

namespace Valerii\Comment\Plugin;

use Magento\Customer\CustomerData\Customer;
use Magento\Customer\Helper\Session\CurrentCustomer;

class CustomerEmail
{
    /**
     * @param CurrentCustomer $currentCustomer
     */
    public function __construct(private readonly CurrentCustomer $currentCustomer)
    {
    }

    /**
     * @param Customer $subject
     * @param array $result
     * @return array
     */
    public function afterGetSectionData(Customer $subject, array $result): array
    {
        if (!$this->currentCustomer->getCustomerId()) {
            return $result;
        }
        $result['email'] = $this->currentCustomer->getCustomer()->getEmail();

        return $result;
    }
}
