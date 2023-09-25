<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Extension extends Model
{
    use HasFactory;


    protected $table = 'domains';

    protected $fillable = [
        'extension',
    ];

    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class, 'domain_word')->withPivot('status');
    }


}
