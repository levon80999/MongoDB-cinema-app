<?php

declare(strict_types = 1);

namespace App\Rules;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class AvailableForBook implements Rule
{
    /**
     * @var string
     */
    private $hallId;

    /**
     * Create a new rule instance.
     *
     * @param string $hallId
     */
    public function __construct(string $hallId)
    {
        $this->hallId = $hallId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value) : bool
    {
        $exists = Session::where('hall_id', $this->hallId)
            ->where('start_date', '<=',$value)
            ->where('end_date', '>=', $value)
            ->exists();

        return $exists === false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'There is another session on this time.';
    }
}
