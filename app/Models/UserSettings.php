<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSettings extends Model
{
    use HasFactory;
    protected $fillable = [

        'license_plate',
        'default_park_time',
        'phone_number',
        'vehicle_make',
        'vehicle_model',
        'phone_number'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function updateCurrentUserZone(int $newZoneId): void
    {
        if ($this->zone_id !== $newZoneId) {
            $newZone = Zone::with('tariffs')->findOrFail($newZoneId);
            $this->zone()->associate($newZone);
            $this->save();
        }
    }
}
