<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsToMany;
use Jenssegers\Mongodb\Relations\HasMany;

/**
 * @property string $name
 * @property string $description
 * @property mixed $date
 * @property mixed|string $image
 * @property string $producer_id
 * @property boolean $comingSoon
 * @property boolean $best
 * @property array $actor_ids
 */
class Film extends Model
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
        'name',
        'date',
        'image',
    ];

    /**
     * Make relationship between films and actors
     *
     * @return BelongsToMany
     */
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }

    /**
     * Make relationship between films and producers
     *
     * @return BelongsTo
     */
    public function producer() : BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }

    /**
     * Make relationship between films and sessions
     *
     * @return HasMany
     */
    public function sessions() : HasMany
    {
        return $this->hasMany(Session::class);
    }
}
