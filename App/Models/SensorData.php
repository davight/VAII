<?php

namespace App\Models;

use Framework\Core\Model;

class SensorData extends Model
{
    protected static ?string $tableName = 'sensor_data';

    public ?int $id = null;
    public ?int $sensorId = null;
    public ?float $value = null;
    public ?string $measuredAt = null;
}
