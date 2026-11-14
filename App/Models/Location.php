<?php

namespace App\Models;

use Framework\Core\Model;

class Location extends Model
{
    public ?int $id = null;
    public ?string $name = null;
    public ?float $latitude = 0.0;
    public ?float $longitude = 0.0;

    /**
     * M:N – users linked to this location through user_locations.
     * @return User[]
     */
    public function getUsers(): array
    {
        if ($this->id === null) {
            return [];
        }
        return User::getAll(
            'id IN (SELECT user_id FROM user_locations WHERE location_id = ?)',
            [$this->id],
            'username'
        );
    }
}
