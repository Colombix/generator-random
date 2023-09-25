<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function extensions(): BelongsToMany
    {
        return $this->belongsToMany(Extension::class, 'domain_word')->withPivot('status');
    }
}
