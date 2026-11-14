<?php

namespace App\Models;

use Framework\Core\Model;

class User extends Model
{
    public ?int $id = null;
    public ?string $username = null;
    public ?string $role = 'user';

    /**
     * M:N – locations linked to this user through user_locations.
     * @return Location[]
     */
    public function getLocations(): array
    {
        if ($this->id === null) {
            return [];
        }
        return Location::getAll(
            'id IN (SELECT location_id FROM user_locations WHERE user_id = ?)',
            [$this->id],
            'name'
        );
    }

    /**
     * Replaces the user's location links with the given location ids.
     * @param int[] $locationIds
     */
    public function setLocations(array $locationIds): void
    {
        foreach (UserLocation::getAll('user_id = ?', [$this->id]) as $link) {
            $link->delete();
        }
        foreach (array_unique(array_map('intval', $locationIds)) as $locationId) {
            $link = new UserLocation();
            $link->userId = $this->id;
            $link->locationId = $locationId;
            $link->save();
        }
    }
}
