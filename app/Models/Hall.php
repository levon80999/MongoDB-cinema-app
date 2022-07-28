<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @property string $name
 * @property integer $row
 * @property integer $col
 * @property integer $disabledSeats
 */
class Hall extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $primaryKey = '_id';
}
