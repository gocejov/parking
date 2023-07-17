<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = ['zone_id', 'price', 'time_limit'];


    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
