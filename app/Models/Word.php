<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



// naming word = Domain
class Word extends Model
{
    use HasFactory;

    //@TODO: enlever
//    protected $table = 'words';

    protected $fillable = [
        'name',

    ];


    // ne pas oublier le retours de belongtomnay
    public function domains(): BelongsToMany
    {
        return $this->belongsToMany(Domain::class, 'domain_word')->withPivot('status');
    }
}
