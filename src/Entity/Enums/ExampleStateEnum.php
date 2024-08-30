<?php

namespace App\Entity\Enums;

enum ExampleStateEnum: string
{
    case REJECTED = 'rejected';
    case PENDING = 'pending';
    case PUBLISHED = 'published';
}
