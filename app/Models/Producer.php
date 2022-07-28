<?php

declare(strict_types = 1);

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;

/**
 * @property string $fullName
 * @property string $description
 * @property integer height
 * @property date dateOfBirth
 * @property string placeOfBirth
 * @property mixed children
 * @property mixed parents
 * @property string image
 */
class Producer extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function films() : HasMany
    {
        return $this->hasMany(Film::class);
    }
}
