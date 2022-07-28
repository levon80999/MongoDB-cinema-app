<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;

/**
 * @property string $fullName
 * @property string $description
 * @property float $height
 * @property array $children
 * @property mixed $dateOfBirth
 * @property string $image
 */
class Actor extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * @var string[]
     */
    protected $fillable = [
        'fullName'
    ];

    /**
     * Make relationship between films and actors
     *
     * @return BelongsToMany
     */
    public function films(): BelongsToMany
    {
        return $this->belongsToMany(Film::class);
    }
}
