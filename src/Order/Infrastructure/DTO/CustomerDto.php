<?php

namespace App\Order\Infrastructure\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class OrderDto
{
    #[Assert\NotBlank]
    #[Assert\Uuid]
    #[SerializedName('order_id')]
    public string $orderId;
}
