<?php

namespace App\Customer\Infrastructure\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerDto
{
    #[Assert\NotBlank]
    #[Assert\Uuid]
    #[SerializedName('customer_id')]
    public string $customerId;
}
