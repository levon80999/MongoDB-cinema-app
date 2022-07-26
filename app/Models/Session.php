<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

/**
 * @property integer $film_id
 * @property integer $hall_id
 * @property mixed $start_date
 * @property mixed $end_date
 */
class Session extends Model
{
    use HasFactory;

    /**
     * Make relationship between films and sessions
     *
     * @return BelongsTo
     */
    public function film() : BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Make relationship between halls and sessions
     *
     * @return BelongsTo
     */
    public function hall() : BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
