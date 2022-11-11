<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Game.
 *
 * @author Alexander Davis <alexander.davis.098@gmail.com>
 *
 * @OA\Schema(
 *  title="Game",
 *  description="Game model"
 * )
 */
class Game extends Model
{
    use HasFactory;

    /**
     * @OA\Property(format="int64", property="_id")
     * @OA\Property(property="name",type="string")
     * @OA\Property(property="cost",type="number")
     * @OA\Property(property="description",type="string")
     * @OA\Property(format="date-time", property="created_at")
     * @OA\Property(format="date-time", property="updated_at")
     *
     * @return array
     */
    protected $fillable = [
        'name',
        'cost',
        'description'
    ];
}
