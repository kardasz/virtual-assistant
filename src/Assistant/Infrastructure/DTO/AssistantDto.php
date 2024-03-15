<?php

namespace App\Assistant\Infrastructure\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class AssistantDto
{
    #[Assert\NotBlank]
    #[Assert\Uuid]
    #[SerializedName('assistant_id')]
    public string $assistantId;
}
