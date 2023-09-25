<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class DomainWord extends Pivot
{
    public array $availability = [
        'available' => 'available',
        'taken' => 'taken'
    ];
}
