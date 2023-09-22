<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;


    protected $table = 'domains';

    protected $fillable = [
        'extension',
    ];


    public function words()
    {
        return $this->belongsToMany(Word::class, 'domain_word')->withPivot('status');
    }


}
