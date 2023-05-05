<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;

    protected $fillable = ['vertices'];

    // deserialize the vertices attribute from a JSON string to an array when the model is retrieved from the DB
    public function getVerticesAttributes(string $value): array
    {
        return json_decode($value, true);
    }
}
