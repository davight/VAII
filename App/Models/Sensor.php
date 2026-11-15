<?php

namespace App\Models;

use Framework\Core\Model;

class Sensor extends Model
{
    public ?int $id = null;
    public ?int $locationId = null;
    public ?string $metric = null;
    public ?string $unit = null;
}
