<?php

namespace App\Models;
use Framework\Core\Model;

class Report extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public ?int $width = 800;
    public ?int $height = 600;
    public ?string $visibility = 'private';
}
