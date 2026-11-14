<?php

namespace App\Models;

use Framework\Core\Model;

class UserLocation extends Model
{
    protected static ?string $tableName = 'user_locations';

    public ?int $id = null;
    public ?int $userId = null;
    public ?int $locationId = null;
}
