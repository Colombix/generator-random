<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


// naming Domain = extension
class Domain extends Model
{
    use HasFactory;


    protected $table = 'domains';

    protected $fillable = [
        'extension',
    ];


    // ne pas oublier le retours de belongstomnay
    public function words(): BelongsToMany
    {
        return $this->belongsToMany(Word::class, 'domain_word')->withPivot('status');
    }


}
