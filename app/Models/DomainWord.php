<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;


class DomainWord extends Pivot
{
    public array $availability = [
        'available' => 'available',
        'taken' => 'taken'
    ];
}
