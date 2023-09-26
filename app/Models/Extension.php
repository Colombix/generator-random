<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Extension extends Model
{
    use HasFactory;

    protected $fillable = [
        'extension',
    ];

    public function domains(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class, 'domain_extension')->withPivot('is_available')->using(DomainExtension::class);
    }
}
