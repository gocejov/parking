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
        'location',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
