<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Polygon extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'vertices'];

    // Deserialize the vertices attribute from a JSON string to an array when the model is retrieved from the DB
    public function getVerticesAttribute($value)
    {
        return json_decode($value, true);
    }

    // Serialize the vertices attribute from an array to a JSON string before saving the model
    public function setVerticesAttribute($value): void
    {
        $this->attributes['vertices'] = json_encode($value);
    }

    public static function deletePolygonByName($name): int
    {
        return DB::table('polygons',)->where('name', $name)->delete();
    }
}
